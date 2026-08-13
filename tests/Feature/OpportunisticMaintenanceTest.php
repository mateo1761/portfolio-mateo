<?php

use App\Models\ContactConsent;
use App\Models\DailySiteMetric;
use Illuminate\Support\Facades\Cache;

test('expired portfolio data is pruned opportunistically at most once per day', function () {
    $this->travelTo('2026-08-12 10:00:00');
    $this->withoutDefer();
    config()->set('maintenance.opportunistic_pruning', true);

    $expiredConsent = ContactConsent::factory()->create([
        'consented_at' => '2025-08-11 10:00:00',
    ]);
    $retainedConsent = ContactConsent::factory()->create([
        'consented_at' => '2025-08-12 10:00:00',
    ]);
    $expiredMetric = DailySiteMetric::factory()->create([
        'metric_date' => '2025-08-11',
    ]);
    $retainedMetric = DailySiteMetric::factory()->create([
        'metric_date' => '2025-08-12',
    ]);

    $this->get(route('home'))->assertOk();

    $this->assertModelMissing($expiredConsent);
    $this->assertModelExists($retainedConsent);
    $this->assertModelMissing($expiredMetric);
    $this->assertModelExists($retainedMetric);
    expect(Cache::has('portfolio-maintenance:pruned'))->toBeTrue();

    $anotherExpiredMetric = DailySiteMetric::factory()->create([
        'metric_date' => '2025-08-10',
    ]);

    $this->get(route('home'))->assertOk();

    $this->assertModelExists($anotherExpiredMetric);
});
