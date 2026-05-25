<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PublicPageController extends Controller
{
    public function home(): View
    {
        return view('welcome', $this->pageData());
    }

    public function docs(): View
    {
        return view('docs', $this->pageData());
    }

    public function about(): View
    {
        return view('about', $this->pageData());
    }

    /**
     * @return array{generatorUrl: string, repositoryUrl: string}
     */
    protected function pageData(): array
    {
        return [
            'generatorUrl' => route('ics.create', [
                'title' => 'Demo Day',
                'start' => '2026-06-03T12:00:00+02:00',
                'end' => '2026-06-03T15:00:00+02:00',
                'location' => 'Kristiansand',
                'alarm_minutes' => 30,
            ]),
            'repositoryUrl' => 'https://github.com/iglebekk/takt',
        ];
    }
}
