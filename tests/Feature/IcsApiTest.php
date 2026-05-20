<?php

function validIcsPayload(array $overrides = []): array
{
    return [
        ...[
            'title' => 'API Planning Session',
            'start' => '2026-06-01T10:00:00+02:00',
            'end' => '2026-06-01T11:00:00+02:00',
            'description' => 'Discuss roadmap',
            'timezone' => 'Europe/Oslo',
        ],
        ...$overrides,
    ];
}

test('api returns an ics response by default', function () {
    $response = $this->call(
        'POST',
        '/api/ics',
        server: [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'text/calendar',
        ],
        content: json_encode(validIcsPayload(), JSON_THROW_ON_ERROR),
    );

    $response->assertOk()
        ->assertHeader('Content-Disposition', 'attachment; filename="api-planning-session.ics"');

    expect($response->headers->get('Content-Type'))->toBe('text/calendar; charset=utf-8');
    expect($response->getContent())
        ->toContain('BEGIN:VCALENDAR')
        ->toContain('DTSTART:20260601T080000Z');
});

test('api returns json when json is accepted', function () {
    $response = $this->postJson('/api/ics', validIcsPayload([
        'title' => 'JSON Session',
    ]));

    $response->assertOk()
        ->assertJsonStructure(['filename', 'mime_type', 'content'])
        ->assertJson([
            'filename' => 'json-session.ics',
            'mime_type' => 'text/calendar; charset=utf-8',
        ]);

    expect($response->json('content'))->toContain('SUMMARY:JSON Session');
});

test('api validation errors are json', function () {
    $this->postJson('/api/ics', validIcsPayload([
        'title' => '',
        'url' => 'http://example.com',
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['title', 'url']);
});
