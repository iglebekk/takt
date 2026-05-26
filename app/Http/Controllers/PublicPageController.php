<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class PublicPageController extends Controller
{
    public function docs(): View
    {
        $baseUrl = rtrim((string) config('app.url'), '/');

        return view('docs.index', [
            'docsLinkExample' => $this->createUrl($baseUrl, [
                'title' => 'Demo Day',
                'start' => '2026-06-10T09:00',
                'end' => '2026-06-10T12:00',
                'timezone' => 'Europe/Oslo',
            ]),
            'docsApiCalendarExample' => $this->apiCurlExample($baseUrl, 'text/calendar'),
            'docsApiJsonExample' => $this->apiCurlExample($baseUrl, 'application/json')."\n\n".__('public.docs.sections.api.json_response'),
            'docsExamples' => [
                [
                    'title' => __('public.docs.examples.simple.title'),
                    'code' => $this->createUrl($baseUrl, [
                        'title' => 'Planning Session',
                        'start' => '2026-06-01T10:00',
                        'end' => '2026-06-01T11:00',
                        'timezone' => 'Europe/Oslo',
                    ]),
                ],
                [
                    'title' => __('public.docs.examples.location.title'),
                    'code' => $this->createUrl($baseUrl, [
                        'title' => 'Workshop',
                        'start' => '2026-06-02T09:00',
                        'end' => '2026-06-02T12:00',
                        'timezone' => 'Europe/Oslo',
                        'location' => 'Oslo',
                        'description' => 'Bring laptop',
                    ]),
                ],
                [
                    'title' => __('public.docs.examples.all_day.title'),
                    'code' => $this->createUrl($baseUrl, [
                        'title' => 'Conference Day',
                        'start' => '2026-06-03',
                        'end' => '2026-06-03',
                        'timezone' => 'UTC',
                        'all_day' => 1,
                    ]),
                ],
                [
                    'title' => __('public.docs.examples.external_link.title'),
                    'code' => $this->createUrl($baseUrl, [
                        'title' => 'Webinar',
                        'start' => '2026-06-04T13:00',
                        'end' => '2026-06-04T14:00',
                        'timezone' => 'Europe/Oslo',
                        'url' => $baseUrl.'/webinar',
                    ]),
                ],
            ],
        ]);
    }

    /**
     * @param  array<string, mixed>  $parameters
     */
    protected function createUrl(string $baseUrl, array $parameters): string
    {
        return $baseUrl.'/create?'.Arr::query($parameters);
    }

    protected function apiCurlExample(string $baseUrl, string $acceptHeader): string
    {
        return "curl -X POST {$baseUrl}/api/ics \\\n"
            ."  -H 'Content-Type: application/json' \\\n"
            ."  -H 'Accept: {$acceptHeader}' \\\n"
            ."  -d '{\"title\":\"Planning Session\",\"start\":\"2026-06-01T10:00:00+02:00\",\"end\":\"2026-06-01T11:00:00+02:00\",\"timezone\":\"Europe/Oslo\"}'";
    }
}
