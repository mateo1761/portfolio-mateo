<?php

namespace App\Actions;

use App\Models\ContactConsent;
use App\Models\DailySiteMetric;
use Illuminate\Support\Facades\Cache;

class PruneExpiredPortfolioDataAction
{
    public function handle(): void
    {
        Cache::lock('portfolio-maintenance:prune', 300)->get(function (): void {
            if (Cache::has('portfolio-maintenance:pruned')) {
                return;
            }

            ContactConsent::query()
                ->where('consented_at', '<', now()->subMonthsNoOverflow(12))
                ->delete();

            DailySiteMetric::query()
                ->where('metric_date', '<', today()->subMonthsNoOverflow(12))
                ->delete();

            Cache::put('portfolio-maintenance:pruned', true, now()->addDay());
        });
    }
}
