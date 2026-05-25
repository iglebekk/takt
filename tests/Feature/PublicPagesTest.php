<?php

it('renders the home page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSeeText(__('public.home.message'));
});
