<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome', [
    'seo' => [
        'title' => 'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
        'description' => 'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
    ],
])->name('home');

Route::post('contact', ContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
