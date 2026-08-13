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
    $content = $response->getContent();

    preg_match("/style-src 'self' 'nonce-([^']+)'/", $policy, $headerNonceMatches);
    preg_match('/<meta property="csp-nonce" nonce="([^"]+)">/', $content, $metaNonceMatches);

    expect($policy)
        ->toContain("default-src 'self'")
        ->toContain("frame-ancestors 'none'")
        ->toMatch("/script-src 'self' 'nonce-[^']+'/")
        ->not->toContain("'unsafe-inline'")
        ->and($content)
        ->toMatch('/<script nonce="[^"]+">/')
        ->toMatch('/<style nonce="[^"]+">/')
        ->and($headerNonceMatches[1] ?? null)
        ->not->toBeEmpty()
        ->toBe($metaNonceMatches[1] ?? null);
});

test('separate responses use different content security policy nonces', function () {
    config()->set('security.content_security_policy', true);

    $firstResponse = $this->get('/');
    $secondResponse = $this->get('/');

    preg_match(
        "/style-src 'self' 'nonce-([^']+)'/",
        (string) $firstResponse->headers->get('Content-Security-Policy'),
        $firstNonceMatches,
    );
    preg_match(
        "/style-src 'self' 'nonce-([^']+)'/",
        (string) $secondResponse->headers->get('Content-Security-Policy'),
        $secondNonceMatches,
    );

    expect($firstNonceMatches[1] ?? null)
        ->not->toBeEmpty()
        ->not->toBe($secondNonceMatches[1] ?? null);
});
