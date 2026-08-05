<?php

use App\Actions\RecordDailySiteMetricAction;
use App\Models\DailySiteMetric;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Inertia\Testing\AssertableInertia as Assert;

test('public portfolio visits are counted without visitor identifiers', function () {
    $this->travelTo('2026-08-05 10:00:00');
    $this->withoutDefer();

    $this->get(route('home'))->assertOk();
    $this->get(route('home.en'))->assertOk();

    $this->assertDatabaseHas('daily_site_metrics', [
        'metric_date' => '2026-08-05',
        'visits' => 2,
        'contact_submissions' => 0,
    ]);

    expect(DailySiteMetric::query()->first()?->getAttributes())
        ->not->toHaveKeys(['ip_address', 'email', 'session_id']);
});

test('the application health endpoint is not counted as a portfolio visit', function () {
    $this->withoutDefer();

    $this->get('/up')->assertOk();

    expect(DailySiteMetric::query()->exists())->toBeFalse();
});

test('only successful contact email delivery increments the submission counter', function () {
    Mail::fake();
    $this->withoutDefer();

    $this->post(route('contact.store'), [
        'name' => 'Portfolio Visitor',
        'email' => 'visitor@example.com',
        'subject' => 'Laravel opportunity',
        'message' => 'I would like to discuss a Laravel and Vue opportunity.',
        'website' => '',
        'privacy_consent' => '1',
    ])->assertSessionHasNoErrors();

    $this->post(route('contact.store'), [
        'name' => '',
        'email' => 'invalid',
        'subject' => '',
        'message' => 'Too short',
        'privacy_consent' => '1',
    ])->assertSessionHasErrors();

    $this->assertDatabaseHas('daily_site_metrics', [
        'contact_submissions' => 1,
    ]);
});

test('dashboard provides a complete thirty day anonymous metric series', function () {
    $this->travelTo('2026-08-05 10:00:00');
    $user = User::factory()->create();

    DailySiteMetric::factory()->create([
        'metric_date' => '2026-08-04',
        'visits' => 12,
        'contact_submissions' => 2,
    ]);
    app(RecordDailySiteMetricAction::class)->recordVisit();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->has('analytics.series', 30)
            ->where('analytics.retentionMonths', 12)
            ->where('analytics.totals.visits', 13)
            ->where('analytics.totals.contactSubmissions', 2)
            ->where('analytics.series.28.date', '2026-08-04')
            ->where('analytics.series.28.visits', 12)
            ->where('analytics.series.29.date', '2026-08-05')
            ->where('analytics.series.29.visits', 1));
});

test('daily metrics older than twelve months are prunable', function () {
    $this->travelTo('2026-08-05 10:00:00');
    $expired = DailySiteMetric::factory()->create(['metric_date' => '2025-08-04']);
    $retained = DailySiteMetric::factory()->create(['metric_date' => '2025-08-05']);

    expect((new DailySiteMetric)->prunable()->pluck('id')->all())
        ->toBe([$expired->id])
        ->not->toContain($retained->id);
});
