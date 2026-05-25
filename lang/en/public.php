<?php

return [
    'brand' => 'Takt',
    'repository_url' => 'https://github.com/iglebekk/takt',
    'meta' => [
        'home_title' => 'Takt | Create downloadable calendar files',
        'home_description' => 'Create a free .ics calendar file for an event without signing in.',
        'docs_title' => 'Documentation | Takt',
        'docs_description' => 'Learn how to create .ics files with Takt using form fields and URL parameters.',
        'privacy_title' => 'Privacy | Takt',
        'privacy_description' => 'A short explanation of how Takt handles calendar file data.',
    ],
    'nav' => [
        'primary' => 'Primary navigation',
        'mobile' => 'Mobile navigation',
        'menu' => 'Menu',
        'create' => 'Create calendar file',
        'docs' => 'Documentation',
        'privacy' => 'Privacy',
        'github' => 'GitHub',
    ],
    'footer' => [
        'tagline' => 'A small free tool for creating downloadable .ics files.',
        'navigation' => 'Footer navigation',
    ],
    'home' => [
        'eyebrow' => 'Free .ics generator',
        'title' => 'Create a calendar file. Share it anywhere.',
        'description' => 'Create an .ics file for your event. Free, simple, and without an account.',
        'primary_cta' => 'Create file',
        'secondary_cta' => 'Read docs',
        'steps_title' => 'Three simple steps',
        'steps' => [
            [
                'label' => '01',
                'title' => 'Fill in the event',
                'body' => 'Add the title, time, timezone, and any optional details you want in the calendar file.',
            ],
            [
                'label' => '02',
                'title' => 'Download the file',
                'body' => 'Submit the form and Takt returns a standards-based .ics file immediately.',
            ],
            [
                'label' => '03',
                'title' => 'Share or import it',
                'body' => 'Send the file to attendees, publish the generated link, or open it in your own calendar.',
            ],
        ],
        'docs_title' => 'Use it from a website or system',
        'docs_body' => 'The documentation shows the supported fields, URL parameters, API usage, MCP usage, examples, and privacy limits.',
        'docs_primary' => 'Read documentation',
        'docs_secondary' => 'See examples',
        'about_title' => 'One job, no extra account',
        'about_body' => 'Takt only creates calendar files. It does not manage attendees, store events, or connect directly to your calendar.',
        'about_notice' => 'You download the file and decide where it goes next.',
    ],
    'form' => [
        'title' => 'Event details',
        'description' => 'Required fields are the event title, start, end, and timezone.',
        'error_summary' => 'Some fields need attention before the calendar file can be created.',
        'submit' => 'Download calendar file',
        'link_help' => 'How URL links work',
        'fields' => [
            'title' => 'Event title',
            'start' => 'Start date and time',
            'end' => 'End date and time',
            'timezone' => 'Timezone',
            'alarm' => 'Reminder',
            'location' => 'Location',
            'description' => 'Description',
            'url' => 'Event link',
            'all_day' => 'All-day event',
            'all_day_description' => 'Start and end times are ignored when this is selected.',
        ],
        'placeholders' => [
            'url' => 'https://example.com/event',
        ],
        'timezone_options' => [
            'Europe/Oslo' => 'Europe/Oslo',
            'UTC' => 'UTC',
            'Europe/London' => 'Europe/London',
            'Europe/Berlin' => 'Europe/Berlin',
            'America/New_York' => 'America/New_York',
            'America/Los_Angeles' => 'America/Los_Angeles',
        ],
        'alarm_options' => [
            '' => 'No reminder',
            '0' => 'At start time',
            '5' => '5 minutes before',
            '10' => '10 minutes before',
            '15' => '15 minutes before',
            '30' => '30 minutes before',
            '60' => '1 hour before',
            '1440' => '1 day before',
        ],
    ],
    'docs' => [
        'navigation_label' => 'Documentation sections',
        'contents' => 'Contents',
        'eyebrow' => 'Documentation',
        'title' => 'Create calendar files with form fields or URL parameters.',
        'description' => 'Takt accepts event data, validates it, and returns a downloadable .ics file that can be imported into common calendar applications.',
        'nav' => [
            'getting-started' => 'Getting started',
            'fields' => 'Fields',
            'link' => 'Use with a link',
            'api' => 'API',
            'mcp' => 'MCP',
            'examples' => 'Examples',
            'privacy' => 'Limits and privacy',
        ],
        'sections' => [
            'getting_started' => [
                'title' => 'Getting started',
                'body' => 'Use the form on the front page for manual creation. For websites and systems, build a link to the same generator endpoint.',
                'notice' => 'A .ics file is a plain calendar file. Takt creates the file; the user still chooses where to open or import it.',
            ],
            'fields' => [
                'title' => 'Fields',
                'body' => 'These fields are accepted by the generator.',
            ],
            'link' => [
                'title' => 'Use with a link',
                'body' => 'Any extra route parameters passed to the named create route are encoded as query parameters.',
                'example' => 'https://example.com/create?title=Demo+Day&start=2026-06-10T09:00&end=2026-06-10T12:00&timezone=Europe%2FOslo',
            ],
            'api' => [
                'title' => 'API',
                'body' => 'Send the same event fields to POST /api/ics. By default, the endpoint returns a downloadable text/calendar response.',
                'notice' => 'Use Accept: application/json when you want filename, MIME type, and calendar content in a JSON object instead of a file response.',
                'calendar_response_title' => 'Calendar file response',
                'calendar_example' => "curl -X POST https://example.com/api/ics \\\n  -H 'Content-Type: application/json' \\\n  -H 'Accept: text/calendar' \\\n  -d '{\"title\":\"Planning Session\",\"start\":\"2026-06-01T10:00:00+02:00\",\"end\":\"2026-06-01T11:00:00+02:00\",\"timezone\":\"Europe/Oslo\"}'",
                'json_response_title' => 'JSON response',
                'json_example' => "curl -X POST https://example.com/api/ics \\\n  -H 'Content-Type: application/json' \\\n  -H 'Accept: application/json' \\\n  -d '{\"title\":\"Planning Session\",\"start\":\"2026-06-01T10:00:00+02:00\",\"end\":\"2026-06-01T11:00:00+02:00\",\"timezone\":\"Europe/Oslo\"}'\n\n{\n  \"filename\": \"planning-session.ics\",\n  \"mime_type\": \"text/calendar; charset=utf-8\",\n  \"content\": \"BEGIN:VCALENDAR...\"\n}",
            ],
            'mcp' => [
                'title' => 'MCP',
                'body' => 'Takt registers an MCP server for clients that can call tools directly.',
                'example_title' => 'Tool input',
                'example' => "{\n  \"title\": \"Tool Session\",\n  \"start\": \"2026-06-01T10:00:00+02:00\",\n  \"end\": \"2026-06-01T11:00:00+02:00\",\n  \"timezone\": \"Europe/Oslo\"\n}",
                'notice' => 'The MCP tool returns structured content with filename, mime_type, and content.',
            ],
            'examples' => [
                'title' => 'Examples',
                'body' => 'Use URL encoding for spaces, slashes, and special characters.',
            ],
            'privacy' => [
                'title' => 'Limits and privacy',
                'body' => 'The service is intentionally small and only creates calendar file responses.',
            ],
        ],
        'table' => [
            'field' => 'Field',
            'required' => 'Required',
            'notes' => 'Notes',
        ],
        'fields' => [
            [
                'name' => 'title',
                'required' => 'Yes',
                'notes' => 'Event title, maximum 255 characters.',
            ],
            [
                'name' => 'start',
                'required' => 'Yes',
                'notes' => 'Date/time string. Add timezone when no offset is included.',
            ],
            [
                'name' => 'end',
                'required' => 'Yes',
                'notes' => 'Must be after start, except all-day events where the same date is allowed.',
            ],
            [
                'name' => 'timezone',
                'required' => 'Usually',
                'notes' => 'Required when start or end does not include a timezone offset.',
            ],
            [
                'name' => 'location',
                'required' => 'No',
                'notes' => 'Optional text, maximum 1000 characters.',
            ],
            [
                'name' => 'description',
                'required' => 'No',
                'notes' => 'Optional text, maximum 5000 characters.',
            ],
            [
                'name' => 'url',
                'required' => 'No',
                'notes' => 'Must start with https://.',
            ],
            [
                'name' => 'alarm_minutes',
                'required' => 'No',
                'notes' => 'Allowed values: 0, 5, 10, 15, 30, 60, 1440.',
            ],
            [
                'name' => 'all_day',
                'required' => 'No',
                'notes' => 'Use 1 or true for all-day events.',
            ],
        ],
        'mcp_details' => [
            [
                'label' => 'Web server',
                'value' => '/mcp/calendar',
            ],
            [
                'label' => 'Local server',
                'value' => 'calendar',
            ],
            [
                'label' => 'Tool',
                'value' => 'generate_ical_file',
            ],
            [
                'label' => 'Output',
                'value' => 'filename, mime_type, content',
            ],
        ],
        'examples' => [
            [
                'title' => 'Simple event',
                'code' => 'https://example.com/create?title=Planning+Session&start=2026-06-01T10:00&end=2026-06-01T11:00&timezone=Europe%2FOslo',
            ],
            [
                'title' => 'Event with location and description',
                'code' => 'https://example.com/create?title=Workshop&start=2026-06-02T09:00&end=2026-06-02T12:00&timezone=Europe%2FOslo&location=Oslo&description=Bring+laptop',
            ],
            [
                'title' => 'All-day event',
                'code' => 'https://example.com/create?title=Conference+Day&start=2026-06-03&end=2026-06-03&timezone=UTC&all_day=1',
            ],
            [
                'title' => 'Event with external link',
                'code' => 'https://example.com/create?title=Webinar&start=2026-06-04T13:00&end=2026-06-04T14:00&timezone=Europe%2FOslo&url=https%3A%2F%2Fexample.com%2Fwebinar',
            ],
        ],
        'privacy_points' => [
            'Takt does not create a user account for calendar file generation.',
            'Takt does not connect to Google Calendar, Outlook, Apple Calendar, or any other calendar account.',
            'The generated file must be downloaded, opened, imported, or shared by the user.',
            'GET links contain event data in the URL, so avoid putting sensitive information in public links.',
            'The request URL may not be greater than 4096 characters.',
        ],
    ],
    'privacy' => [
        'eyebrow' => 'Privacy',
        'title' => 'Short version: this tool creates a file.',
        'description' => 'Takt is designed for simple calendar file generation without accounts or direct calendar access.',
        'sections' => [
            [
                'title' => 'No account',
                'body' => 'You do not need to sign in to create a calendar file.',
            ],
            [
                'title' => 'No calendar access',
                'body' => 'Takt does not connect to your calendar provider. You decide where to open or import the downloaded .ics file.',
            ],
            [
                'title' => 'URL data',
                'body' => 'When you use a generated link, the event details are part of that URL. Do not put private or sensitive information in links you share publicly.',
            ],
        ],
    ],
];
