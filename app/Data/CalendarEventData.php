<?php

namespace App\Data;

use Carbon\CarbonImmutable;

class CalendarEventData
{
    public function __construct(
        public readonly string $title,
        public readonly CarbonImmutable $start,
        public readonly CarbonImmutable $end,
        public readonly ?string $description = null,
        public readonly ?string $location = null,
        public readonly ?string $url = null,
        public readonly ?string $timezone = null,
        public readonly ?int $alarmMinutes = null,
        public readonly bool $allDay = false,
    ) {
    }
}
