<?php

test('public CV exists and is linked from the portfolio', function () {
    $cvPath = public_path(
        'documents/Hoja_de_vida_Mateo_Quintero_2026.pdf',
    );
    $heroComponent = file_get_contents(
        resource_path('js/components/public/HeroSection.vue'),
    );

    expect($cvPath)
        ->toBeFile()
        ->and(file_get_contents($cvPath, false, null, 0, 4))
        ->toBe('%PDF')
        ->and($heroComponent)
        ->toContain(
            'href="/documents/Hoja_de_vida_Mateo_Quintero_2026.pdf"',
            'download="Hoja-de-vida-Mateo-Quintero.pdf"',
            'aria-label="Descargar hoja de vida de Mateo Quintero en formato PDF"',
        );
});
