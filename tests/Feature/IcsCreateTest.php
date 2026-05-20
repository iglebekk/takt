<?php

test('create returns an ics attachment', function () {
    $response = $this->get(route('ics.create', [
        'title' => 'Planning Session',
        'start' => '2026-06-01 10:00',
        'end' => '2026-06-01 11:00',
        'timezone' => 'Europe/Oslo',
        'description' => 'Discuss roadmap',
        'location' => 'Oslo',
        'url' => 'https://example.com/events/planning',
        'alarm_minutes' => 15,
    ]));

    $response->assertOk()
        ->assertHeader('Content-Disposition', 'attachment; filename="planning-session.ics"');

    expect($response->headers->get('Content-Type'))->toBe('text/calendar; charset=utf-8');
    expect($response->getContent())
        ->toContain('BEGIN:VCALENDAR')
        ->toContain('BEGIN:VEVENT')
        ->toContain('DTSTART:20260601T080000Z')
        ->toContain('DTEND:20260601T090000Z')
        ->toContain('SUMMARY:Planning Session')
        ->toContain('URL:https://example.com/events/planning')
        ->toContain('BEGIN:VALARM')
        ->toContain('TRIGGER:-PT15M');
});

test('create rejects missing required fields', function () {
    $this->getJson(route('ics.create'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['title', 'start', 'end']);
});

test('create rejects invalid optional fields', function (string $field, mixed $value) {
    $payload = [
        'title' => 'Planning Session',
        'start' => '2026-06-01 10:00',
        'end' => '2026-06-01 11:00',
        'timezone' => 'Europe/Oslo',
        $field => $value,
    ];

    $this->getJson(route('ics.create', $payload))
        ->assertUnprocessable()
        ->assertJsonValidationErrors([$field]);
})->with([
    'url must be https' => ['url', 'http://example.com/event'],
    'timezone must be IANA' => ['timezone', 'Mars/Olympus'],
    'alarm must be whitelisted' => ['alarm_minutes', 7],
]);

test('create rejects naive date times without timezone', function () {
    $this->getJson(route('ics.create', [
        'title' => 'Planning Session',
        'start' => '2026-06-01 10:00',
        'end' => '2026-06-01 11:00',
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['timezone']);
});

test('create generates all day events with exclusive dtend', function () {
    $response = $this->get(route('ics.create', [
        'title' => 'Conference Day',
        'start' => '2026-06-01',
        'end' => '2026-06-01',
        'timezone' => 'UTC',
        'all_day' => true,
    ]));

    $response->assertOk();

    expect($response->getContent())
        ->toContain('DTSTART;VALUE=DATE:20260601')
        ->toContain('DTEND;VALUE=DATE:20260602');
});
