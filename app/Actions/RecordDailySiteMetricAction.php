<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class RecordDailySiteMetricAction
{
    public function recordVisit(): void
    {
        $this->increment('visits');
    }

    public function recordContactSubmission(): void
    {
        $this->increment('contact_submissions');
    }

    private function increment(string $column): void
    {
        $now = now();
        $metricDate = $now->toDateString();

        DB::table('daily_site_metrics')->insertOrIgnore([
            'metric_date' => $metricDate,
            'visits' => 0,
            'contact_submissions' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('daily_site_metrics')
            ->where('metric_date', $metricDate)
            ->increment($column, 1, ['updated_at' => $now]);
    }
}
