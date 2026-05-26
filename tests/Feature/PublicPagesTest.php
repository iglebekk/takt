<?php

it('renders the home page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSeeText(__('public.home.title'));
});

it('renders the docs page', function () {
    config(['app.url' => 'https://takt.test']);

    $this->get(route('docs'))
        ->assertOk()
        ->assertSeeText(__('public.docs.title'))
        ->assertSeeText(__('public.docs.sections.api.title'))
        ->assertSeeText('POST /api/ics')
        ->assertSeeText('https://takt.test/create?title=Demo%20Day')
        ->assertSeeText('curl -X POST https://takt.test/api/ics')
        ->assertDontSee('https://example.com/create')
        ->assertSeeText(__('public.docs.sections.mcp.title'))
        ->assertSeeText('generate_ical_file')
        ->assertSeeText('/mcp/calendar')
        ->assertSeeText('takt-calendar');
});

it('renders the privacy page', function () {
    $this->get(route('privacy'))
        ->assertOk()
        ->assertSeeText(__('public.privacy.title'));
});

it('renders the calendar form on the home page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('name="title"', false)
        ->assertSee('name="start"', false)
        ->assertSee('name="end"', false)
        ->assertSee('name="timezone"', false)
        ->assertSeeText(__('public.form.submit'));
});

it('redirects browser validation errors back to the calendar form', function () {
    $this->get(route('ics.create'))
        ->assertRedirect(route('home').'#calendar-form')
        ->assertSessionHasErrors(['title', 'start', 'end']);
});
