<?php

it('renders the public pages', function (string $routeName, string $expectedText) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSeeText($expectedText);
})->with([
    ['home', 'Generate iCalendar links, files, and integrations without the usual friction.'],
    ['docs', 'Three integration paths, one calendar pipeline.'],
    ['about', 'A small, focused tool for clean calendar interoperability.'],
]);

it('links the primary public navigation', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(route('docs'), false)
        ->assertSee(route('about'), false)
        ->assertSee(route('ics.create'), false);
});
