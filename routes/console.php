<?php

use App\Models\ContactConsent;
use App\Models\DailySiteMetric;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('model:prune', [
    '--model' => [ContactConsent::class, DailySiteMetric::class],
])->daily()->withoutOverlapping();
