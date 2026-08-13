<?php

namespace App\Actions;

use App\Models\ContactConsent;
use Illuminate\Support\Str;

class RecordContactConsentAction
{
    public function execute(string $email, string $locale): ContactConsent
    {
        $normalizedEmail = Str::of($email)->trim()->lower()->toString();

        return ContactConsent::query()->create([
            'email_hash' => hash_hmac(
                'sha256',
                $normalizedEmail,
                (string) config('privacy.consent_hash_key'),
            ),
            'consented_at' => now()->utc(),
            'policy_version' => (string) config('privacy.policy_version'),
            'locale' => $locale === 'en' ? 'en' : 'es',
        ]);
    }
}
