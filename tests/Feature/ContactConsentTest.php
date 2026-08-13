<?php

use App\Actions\RecordContactConsentAction;
use App\Models\ContactConsent;

test('contact consent stores only minimal pseudonymized evidence', function () {
    config([
        'privacy.consent_hash_key' => 'test-consent-key',
        'privacy.policy_version' => '1.2',
    ]);

    $consent = app(RecordContactConsentAction::class)->execute(
        ' Visitor@Example.COM ',
        'en',
    );

    expect($consent->id)->toBeString()
        ->and($consent->email_hash)->toBe(hash_hmac(
            'sha256',
            'visitor@example.com',
            'test-consent-key',
        ))
        ->and($consent->policy_version)->toBe('1.2')
        ->and($consent->locale)->toBe('en')
        ->and($consent->getAttributes())->not->toHaveKeys([
            'email',
            'name',
            'subject',
            'message',
            'ip_address',
            'user_agent',
            'updated_at',
        ]);
});

test('contact consent evidence is pruned after twelve months', function () {
    $expiredConsent = ContactConsent::factory()->create([
        'consented_at' => now()->subMonthsNoOverflow(12)->subDay(),
    ]);
    $retainedConsent = ContactConsent::factory()->create([
        'consented_at' => now()->subMonthsNoOverflow(12)->addDay(),
    ]);

    $this->artisan('model:prune', [
        '--model' => [ContactConsent::class],
    ])->assertSuccessful();

    $this->assertModelMissing($expiredConsent);
    $this->assertModelExists($retainedConsent);
});
