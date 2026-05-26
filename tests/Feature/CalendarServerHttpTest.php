<?php

test('the public http mcp server can initialize without authentication', function (): void {
    $this->postJson('/mcp/calendar', [
        'jsonrpc' => '2.0',
        'id' => 'test-request',
        'method' => 'initialize',
        'params' => [
            'protocolVersion' => '2025-11-25',
            'capabilities' => [],
            'clientInfo' => [
                'name' => 'Pest',
                'version' => '1.0.0',
            ],
        ],
    ])
        ->assertOk()
        ->assertHeader('MCP-Session-Id')
        ->assertJsonPath('result.serverInfo.name', 'Calendar Server');
});

test('the public http mcp server lists the calendar tool', function (): void {
    $initializeResponse = $this->postJson('/mcp/calendar', [
        'jsonrpc' => '2.0',
        'id' => 'test-request',
        'method' => 'initialize',
        'params' => [
            'protocolVersion' => '2025-11-25',
            'capabilities' => [],
            'clientInfo' => [
                'name' => 'Pest',
                'version' => '1.0.0',
            ],
        ],
    ]);

    $this->postJson('/mcp/calendar', [
        'jsonrpc' => '2.0',
        'id' => 'tools-request',
        'method' => 'tools/list',
    ], [
        'MCP-Session-Id' => $initializeResponse->headers->get('MCP-Session-Id'),
    ])
        ->assertOk()
        ->assertJsonPath('result.tools.0.name', 'generate_ical_file');
});
