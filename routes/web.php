<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome', [
    'locale' => 'es',
    'seo' => [
        'title' => 'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
        'description' => 'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
    ],
])->name('home');

Route::inertia('/en', 'Welcome', [
    'locale' => 'en',
    'seo' => [
        'title' => 'Mateo Quintero Zapata | Full Stack Developer | Portafolio Mateo',
        'description' => 'Mid-Senior Full Stack Developer specializing in PHP, Laravel, JavaScript, and Vue.js, with experience in enterprise applications, integrations, and process automation.',
    ],
])->name('home.en');

Route::inertia('/privacidad', 'PrivacyPolicy', [
    'locale' => 'es',
    'seo' => [
        'title' => 'Política de tratamiento de datos personales | Portafolio Mateo',
        'description' => 'Consulta cómo Portafolio Mateo trata los datos personales enviados mediante el formulario de contacto.',
    ],
])->name('privacy');

Route::inertia('/en/privacy', 'PrivacyPolicy', [
    'locale' => 'en',
    'seo' => [
        'title' => 'Personal Data Processing Policy | Portafolio Mateo',
        'description' => 'Learn how Portafolio Mateo processes personal data submitted through the contact form.',
    ],
])->name('privacy.en');

Route::post('contact', ContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
