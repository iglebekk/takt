<?php

use App\Data\CalendarEventData;
use App\Services\IcsGenerator;
use Carbon\CarbonImmutable;
use Tests\TestCase;

uses(TestCase::class);

function calendarEvent(array $overrides = []): CalendarEventData
{
    return new CalendarEventData(
        title: $overrides['title'] ?? 'Board Sync',
        start: $overrides['start'] ?? CarbonImmutable::parse('2026-06-01 08:00:00', 'UTC'),
        end: $overrides['end'] ?? CarbonImmutable::parse('2026-06-01 09:00:00', 'UTC'),
        description: $overrides['description'] ?? null,
        location: $overrides['location'] ?? null,
        url: $overrides['url'] ?? null,
        timezone: $overrides['timezone'] ?? null,
        alarmMinutes: $overrides['alarmMinutes'] ?? null,
        allDay: $overrides['allDay'] ?? false,
    );
}

test('it escapes text fields', function () {
    $content = app(IcsGenerator::class)->contentFor(calendarEvent([
        'title' => "Board, Sync; Q\\A\nLine",
        'description' => "One, two; three\\four\nfive",
        'location' => 'Room, 1; Floor\2',
    ]));

    expect($content)
        ->toContain('SUMMARY:Board\, Sync\; Q\\\\A\nLine')
        ->toContain('DESCRIPTION:One\, two\; three\\\\four\nfive')
        ->toContain('LOCATION:Room\, 1\; Floor\\\\2');
});

test('it folds long lines', function () {
    $content = app(IcsGenerator::class)->contentFor(calendarEvent([
        'title' => str_repeat('A', 100),
    ]));

    expect($content)->toContain("\r\n ");
});

test('it generates a uid and safe filename', function () {
    $generator = app(IcsGenerator::class);
    $content = $generator->contentFor(calendarEvent());

    expect($content)->toMatch('/UID:[0-9a-f-]{36}@/')
        ->and($generator->filenameFor(calendarEvent(['title' => 'Quarterly Review!'])))->toBe('quarterly-review.ics')
        ->and($generator->filenameFor(calendarEvent(['title' => '!!!'])))->toBe('event.ics');
});

test('it only includes alarm blocks when selected', function () {
    $generator = app(IcsGenerator::class);

    expect($generator->contentFor(calendarEvent()))
        ->not->toContain('BEGIN:VALARM')
        ->and($generator->contentFor(calendarEvent(['alarmMinutes' => 15])))
        ->toContain('BEGIN:VALARM')
        ->toContain('TRIGGER:-PT15M')
        ->and($generator->contentFor(calendarEvent(['alarmMinutes' => 0])))
        ->toContain('TRIGGER:PT0M');
});
