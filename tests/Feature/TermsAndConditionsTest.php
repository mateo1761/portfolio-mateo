<?php

use App\Http\Requests\ContactRequest;
use Inertia\Testing\AssertableInertia as Assert;

test('terms and conditions are available in Spanish and English', function (string $routeName, string $locale, string $title) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee("<html lang=\"{$locale}\"", false)
        ->assertSee($title)
        ->assertInertia(fn (Assert $page) => $page
            ->component('TermsAndConditions')
            ->where('locale', $locale)
            ->where('seo.title', $title),
        );
})->with([
    'Spanish' => [
        'terms',
        'es',
        'Términos y condiciones | Portafolio Mateo',
    ],
    'English' => [
        'terms.en',
        'en',
        'Terms and Conditions | Portafolio Mateo',
    ],
]);

test('terms routes render canonical and language alternates', function (string $routeName, string $canonicalRoute) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee('rel="canonical" href="'.route($canonicalRoute).'"', false)
        ->assertSee('hreflang="es-CO" href="'.route('terms').'"', false)
        ->assertSee('hreflang="en-US" href="'.route('terms.en').'"', false)
        ->assertSee('hreflang="x-default" href="'.route('terms').'"', false);
})->with([
    'Spanish' => ['terms', 'terms'],
    'English' => ['terms.en', 'terms.en'],
]);

test('contact form does not require acceptance of terms', function () {
    $rules = (new ContactRequest)->rules();

    expect($rules)->not->toHaveKey('terms_acceptance');
});
