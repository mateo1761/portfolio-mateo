<?php

test('portfolio pages use the custom brand assets', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertSee('href="/favicon.svg"', false)
        ->assertSee('href="/apple-touch-icon.png"', false)
        ->assertDontSee('href="/favicon.ico"', false);

    $favicon = file_get_contents(public_path('favicon.svg'));

    expect($favicon)
        ->toContain('#09111a')
        ->toContain('#c39a3c')
        ->not->toContain('#FF2D20');
});
