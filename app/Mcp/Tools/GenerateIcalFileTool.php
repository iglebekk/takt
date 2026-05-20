<?php

namespace App\Mcp\Tools;

use App\Services\CalendarEventNormalizer;
use App\Services\IcsGenerator;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('generate_ical_file')]
#[Title('Generate iCalendar File')]
#[Description('Generate a stateless .ics calendar file from a single event payload.')]
class GenerateIcalFileTool extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request, CalendarEventNormalizer $normalizer, IcsGenerator $generator): Response|ResponseFactory
    {
        $event = $normalizer->validate($request->all());

        return Response::structured($generator->generate($event));
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title' => $schema->string()
                ->description('Event title.')
                ->required(),
            'start' => $schema->string()
                ->description('Start date/time. Include an offset or provide timezone.')
                ->required(),
            'end' => $schema->string()
                ->description('End date/time. Include an offset or provide timezone.')
                ->required(),
            'description' => $schema->string()
                ->description('Optional event description.'),
            'location' => $schema->string()
                ->description('Optional event location.'),
            'url' => $schema->string()
                ->description('Optional https URL for the event.'),
            'timezone' => $schema->string()
                ->description('IANA timezone required when start or end has no offset.'),
            'alarm_minutes' => $schema->integer()
                ->enum([0, 5, 10, 15, 30, 60, 1440])
                ->description('Optional reminder minutes before the event.'),
            'all_day' => $schema->boolean()
                ->description('Whether to generate all-day VALUE=DATE fields.')
                ->default(false),
        ];
    }
}
