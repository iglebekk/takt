<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\GenerateIcalFileTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('Calendar Server')]
#[Version('0.1.0')]
#[Instructions('Generate stateless iCalendar files from event details.')]
class CalendarServer extends Server
{
    protected array $tools = [
        GenerateIcalFileTool::class,
    ];

    protected array $resources = [
        //
    ];

    protected array $prompts = [
        //
    ];
}
