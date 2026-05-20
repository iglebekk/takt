<?php

use App\Mcp\Servers\CalendarServer;
use App\Mcp\Tools\GenerateIcalFileTool;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

uses(TestCase::class);

test('tool returns generated ical json shape', function () {
    $response = CalendarServer::tool(GenerateIcalFileTool::class, [
        'title' => 'Tool Session',
        'start' => '2026-06-01T10:00:00+02:00',
        'end' => '2026-06-01T11:00:00+02:00',
        'timezone' => 'Europe/Oslo',
    ]);

    $response
        ->assertOk()
        ->assertName('generate_ical_file')
        ->assertStructuredContent(function (AssertableJson $json): void {
            $json
                ->where('filename', 'tool-session.ics')
                ->where('mime_type', 'text/calendar; charset=utf-8')
                ->whereType('content', 'string');
        })
        ->assertSee('SUMMARY:Tool Session');
});

test('tool returns validation errors for invalid input', function () {
    CalendarServer::tool(GenerateIcalFileTool::class, [
        'title' => 'Tool Session',
        'start' => '2026-06-01 10:00',
        'end' => '2026-06-01 11:00',
    ])
        ->assertHasErrors(['timezone field is required']);
});
