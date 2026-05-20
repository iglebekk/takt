<?php

namespace App\Services;

use App\Data\CalendarEventData;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

class IcsGenerator
{
    /**
     * @return array{filename: string, mime_type: string, content: string}
     */
    public function generate(CalendarEventData $event): array
    {
        return [
            'filename' => $this->filenameFor($event),
            'mime_type' => 'text/calendar; charset=utf-8',
            'content' => $this->contentFor($event),
        ];
    }

    public function filenameFor(CalendarEventData $event): string
    {
        $slug = Str::of($event->title)->slug()->limit(80, '')->toString();

        return ($slug === '' ? 'event' : $slug).'.ics';
    }

    public function contentFor(CalendarEventData $event): string
    {
        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//Takt//iCalendar Generator//EN',
            'CALSCALE:GREGORIAN',
            'METHOD:PUBLISH',
            'BEGIN:VEVENT',
            'UID:'.Str::uuid()->toString().'@'.parse_url((string) config('app.url'), PHP_URL_HOST),
            'DTSTAMP:'.$this->formatTimestamp(CarbonImmutable::now('UTC')),
        ];

        if ($event->allDay) {
            $lines[] = 'DTSTART;VALUE=DATE:'.$event->start->format('Ymd');
            $lines[] = 'DTEND;VALUE=DATE:'.$event->end->addDay()->format('Ymd');
        } else {
            $lines[] = 'DTSTART:'.$this->formatTimestamp($event->start);
            $lines[] = 'DTEND:'.$this->formatTimestamp($event->end);
        }

        $lines[] = 'SUMMARY:'.$this->escapeText($event->title);

        if ($event->description !== null) {
            $lines[] = 'DESCRIPTION:'.$this->escapeText($event->description);
        }

        if ($event->location !== null) {
            $lines[] = 'LOCATION:'.$this->escapeText($event->location);
        }

        if ($event->url !== null) {
            $lines[] = 'URL:'.$event->url;
        }

        if ($event->alarmMinutes !== null) {
            array_push($lines, ...$this->alarmLines($event->alarmMinutes));
        }

        $lines[] = 'END:VEVENT';
        $lines[] = 'END:VCALENDAR';

        return collect($lines)
            ->map(fn (string $line): string => $this->foldLine($line))
            ->implode("\r\n")."\r\n";
    }

    public function escapeText(string $value): string
    {
        return str_replace(
            ["\\", ';', ',', "\r\n", "\r", "\n"],
            ["\\\\", '\;', '\,', '\n', '\n', '\n'],
            $value,
        );
    }

    public function foldLine(string $line): string
    {
        if (strlen($line) <= 75) {
            return $line;
        }

        $folded = [];
        $remaining = $line;
        $limit = 75;

        while ($remaining !== '') {
            $folded[] = mb_strcut($remaining, 0, $limit, 'UTF-8');
            $remaining = mb_strcut($remaining, $limit, null, 'UTF-8');
            $limit = 74;
        }

        return implode("\r\n ", $folded);
    }

    protected function formatTimestamp(CarbonImmutable $timestamp): string
    {
        return $timestamp->utc()->format('Ymd\THis\Z');
    }

    /**
     * @return array<int, string>
     */
    protected function alarmLines(int $minutes): array
    {
        return [
            'BEGIN:VALARM',
            'ACTION:DISPLAY',
            'DESCRIPTION:Reminder',
            'TRIGGER:'.($minutes === 0 ? 'PT0M' : '-PT'.$minutes.'M'),
            'END:VALARM',
        ];
    }
}
