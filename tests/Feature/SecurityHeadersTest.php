<?php

test('responses include baseline security headers', function () {
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertHeader('X-Content-Type-Options', 'nosniff')
        ->assertHeader('X-Frame-Options', 'DENY')
        ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
        ->assertHeader('Permissions-Policy', 'camera=(), geolocation=(), microphone=(), payment=(), usb=()')
        ->assertHeaderMissing('X-Powered-By');
});

test('production security policies use a nonce', function () {
    config()->set('security.content_security_policy', true);
    config()->set('security.hsts', true);

    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains')
        ->assertHeader('Content-Security-Policy');

    $policy = (string) $response->headers->get('Content-Security-Policy');

    expect($policy)
        ->toContain("default-src 'self'")
        ->toContain("frame-ancestors 'none'")
        ->toMatch("/script-src 'self' 'nonce-[^']+'/")
        ->and($response->getContent())
        ->toMatch('/<script nonce="[^"]+">/')
        ->toMatch('/<style nonce="[^"]+">/');
});
