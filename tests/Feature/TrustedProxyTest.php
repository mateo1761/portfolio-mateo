<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

test('trusts HTTPS forwarded by the local Docker proxy', function () {
    config(['session.secure' => true]);

    Route::get('/trusted-proxy-test', function (Request $request) {
        session(['proxy' => 'trusted']);

        return response()->json([
            'secure' => $request->isSecure(),
            'url' => url('/'),
        ]);
    })->middleware('web');

    $response = $this
        ->withServerVariables(['REMOTE_ADDR' => '172.21.0.5'])
        ->withHeaders([
            'Host' => 'laravel.test',
            'X-Forwarded-Host' => 'portfolio-mateo.test',
            'X-Forwarded-Port' => '443',
            'X-Forwarded-Proto' => 'https',
        ])
        ->get('/trusted-proxy-test');

    $response
        ->assertOk()
        ->assertJson([
            'secure' => true,
            'url' => 'https://portfolio-mateo.test',
        ]);

    $sessionCookie = collect($response->headers->getCookies())
        ->first(fn ($cookie) => $cookie->getName() === config('session.cookie'));

    expect($sessionCookie)->not->toBeNull()
        ->and($sessionCookie->isSecure())->toBeTrue();
});
