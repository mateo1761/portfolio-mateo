<?php

use App\Providers\AppServiceProvider;
use Illuminate\Http\Middleware\TrustHosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

test('trusts only the configured application and internal health check hosts', function () {
    config(['app.url' => 'https://portfolio.example']);

    expect(app(TrustHosts::class)->hosts())->toBe([
        '^portfolio\\.example$',
        '^127\\.0\\.0\\.1$',
        '^localhost$',
    ]);
});

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

test('forces generated HTTPS URLs when the production URL uses HTTPS', function () {
    $originalEnvironment = app()->environment();

    try {
        app()->detectEnvironment(fn (): string => 'production');
        config(['app.url' => 'https://portfolio.example']);

        (new AppServiceProvider(app()))->boot();

        expect(url('/build/app.js'))->toBe('https://localhost/build/app.js');
    } finally {
        URL::forceScheme(null);
        app()->detectEnvironment(fn (): string => $originalEnvironment);
    }
});
