<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->defaults('locale', 'es')
    ->name('home');

Route::get('/en', HomeController::class)
    ->defaults('locale', 'en')
    ->name('home.en');

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

Route::inertia('/terminos', 'TermsAndConditions', [
    'locale' => 'es',
    'seo' => [
        'title' => 'Términos y condiciones | Portafolio Mateo',
        'description' => 'Consulta las condiciones de acceso y uso de Portafolio Mateo y de su formulario de contacto.',
    ],
])->name('terms');

Route::inertia('/en/terms', 'TermsAndConditions', [
    'locale' => 'en',
    'seo' => [
        'title' => 'Terms and Conditions | Portafolio Mateo',
        'description' => 'Review the conditions governing access to and use of Portafolio Mateo and its contact form.',
    ],
])->name('terms.en');

Route::post('contact', ContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('experiences', ExperienceController::class)->except('show');
});

require __DIR__.'/settings.php';
