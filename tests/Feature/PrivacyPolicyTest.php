<?php

use Inertia\Testing\AssertableInertia as Assert;

test('privacy policy is available in Spanish and English', function (string $routeName, string $locale, string $title) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee("<html lang=\"{$locale}\"", false)
        ->assertSee($title)
        ->assertInertia(fn (Assert $page) => $page
            ->component('PrivacyPolicy')
            ->where('locale', $locale)
            ->where('policyVersion', '1.2')
            ->where('seo.title', $title),
        );
})->with([
    'Spanish' => [
        'privacy',
        'es',
        'Política de tratamiento de datos personales | Portafolio Mateo',
    ],
    'English' => [
        'privacy.en',
        'en',
        'Personal Data Processing Policy | Portafolio Mateo',
    ],
]);

test('privacy routes render canonical and language alternates', function (string $routeName, string $canonicalRoute) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee('rel="canonical" href="'.route($canonicalRoute).'"', false)
        ->assertSee('hreflang="es-CO" href="'.route('privacy').'"', false)
        ->assertSee('hreflang="en-US" href="'.route('privacy.en').'"', false)
        ->assertSee('hreflang="x-default" href="'.route('privacy').'"', false);
})->with([
    'Spanish' => ['privacy', 'privacy'],
    'English' => ['privacy.en', 'privacy.en'],
]);

test('privacy policy discloses minimal consent evidence and its retention period', function () {
    $policyCopy = file_get_contents(resource_path('js/lib/privacy-policy-translations.ts'));

    expect($policyCopy)
        ->toContain('huella HMAC-SHA256 no reversible')
        ->toContain('non-reversible HMAC-SHA256 fingerprint')
        ->toContain('se conservará durante 12 meses')
        ->toContain('will be retained for 12 months');
});
