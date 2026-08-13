<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\ContactConsentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $email_hash
 * @property CarbonImmutable $consented_at
 * @property string $policy_version
 * @property string $locale
 * @property CarbonImmutable $created_at
 */
#[Fillable(['email_hash', 'consented_at', 'policy_version', 'locale'])]
class ContactConsent extends Model
{
    /** @use HasFactory<ContactConsentFactory> */
    use HasFactory, HasUuids, MassPrunable;

    public const UPDATED_AT = null;

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'consented_at' => 'immutable_datetime',
            'created_at' => 'immutable_datetime',
        ];
    }

    /** @return Builder<static> */
    public function prunable(): Builder
    {
        return static::query()->where('consented_at', '<', now()->subMonthsNoOverflow(12));
    }
}
