<?php

use App\Mcp\Servers\CalendarServer;
use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp/calendar', CalendarServer::class)
    ->middleware('throttle:ics');

Mcp::local('calendar', CalendarServer::class);
