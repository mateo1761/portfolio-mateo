<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\DailySiteMetricFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property CarbonImmutable $metric_date
 * @property int $visits
 * @property int $contact_submissions
 */
#[Fillable(['metric_date', 'visits', 'contact_submissions'])]
class DailySiteMetric extends Model
{
    /** @use HasFactory<DailySiteMetricFactory> */
    use HasFactory, MassPrunable;

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'metric_date' => 'immutable_date',
            'visits' => 'integer',
            'contact_submissions' => 'integer',
        ];
    }

    /** @return Builder<static> */
    public function prunable(): Builder
    {
        return static::query()->where('metric_date', '<', today()->subMonthsNoOverflow(12));
    }
}
