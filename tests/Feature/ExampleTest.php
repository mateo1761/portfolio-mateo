<?php

use Inertia\Testing\AssertableInertia as Assert;

test('Spanish public portfolio homepage is displayed', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertSee('<html lang="es"', false)
        ->assertSee(
            'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
        )
        ->assertSee(
            'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
        )
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->where('locale', 'es')
            ->where(
                'seo.title',
                'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
            )
            ->where(
                'seo.description',
                'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
            ),
        );
});

test('English public portfolio homepage is displayed', function () {
    $response = $this->get(route('home.en'));

    $response
        ->assertOk()
        ->assertSee('<html lang="en"', false)
        ->assertSee(
            'Mateo Quintero Zapata | Full Stack Developer | Portafolio Mateo',
        )
        ->assertSee(
            'Mid-Senior Full Stack Developer specializing in PHP, Laravel, JavaScript, and Vue.js, with experience in enterprise applications, integrations, and process automation.',
        )
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->where('locale', 'en')
            ->where(
                'seo.title',
                'Mateo Quintero Zapata | Full Stack Developer | Portafolio Mateo',
            )
            ->where(
                'seo.description',
                'Mid-Senior Full Stack Developer specializing in PHP, Laravel, JavaScript, and Vue.js, with experience in enterprise applications, integrations, and process automation.',
            ),
        );
});
