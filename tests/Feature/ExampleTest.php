<?php

use Inertia\Testing\AssertableInertia as Assert;

test('public portfolio homepage is displayed', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertSee(
            'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
        )
        ->assertSee(
            'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
        )
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
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
