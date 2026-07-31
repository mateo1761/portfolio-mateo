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

Route::post('contact', ContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
