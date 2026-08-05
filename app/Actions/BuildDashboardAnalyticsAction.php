<?php

namespace App\Actions;

use App\Models\DailySiteMetric;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class BuildDashboardAnalyticsAction
{
    /**
     * @return array{
     *     retentionMonths: int,
     *     series: array<int, array{date: string, label: string, visits: int, contactSubmissions: int}>,
     *     totals: array{visits: int, contactSubmissions: int}
     * }
     */
    public function handle(int $days = 30): array
    {
        $endDate = today();
        $startDate = $endDate->copy()->subDays($days - 1);

        /** @var Collection<string, DailySiteMetric> $metrics */
        $metrics = DailySiteMetric::query()
            ->whereBetween('metric_date', [$startDate, $endDate])
            ->get()
            ->keyBy(fn (DailySiteMetric $metric): string => $metric->metric_date->toDateString());

        $series = collect(range(0, $days - 1))->map(function (int $offset) use ($startDate, $metrics): array {
            $date = $startDate->copy()->addDays($offset);
            $metric = $metrics->get($date->toDateString());
            $visits = $metric instanceof DailySiteMetric ? $metric->visits : 0;
            $contactSubmissions = $metric instanceof DailySiteMetric ? $metric->contact_submissions : 0;

            return [
                'date' => $date->toDateString(),
                'label' => Carbon::parse($date)->format('M j'),
                'visits' => $visits,
                'contactSubmissions' => $contactSubmissions,
            ];
        })->all();

        return [
            'retentionMonths' => 12,
            'series' => $series,
            'totals' => [
                'visits' => array_sum(array_column($series, 'visits')),
                'contactSubmissions' => array_sum(array_column($series, 'contactSubmissions')),
            ],
        ];
    }
}
