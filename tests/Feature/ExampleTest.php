<?php

use Inertia\Testing\AssertableInertia as Assert;

test('public portfolio homepage is displayed', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome'),
        );
});
