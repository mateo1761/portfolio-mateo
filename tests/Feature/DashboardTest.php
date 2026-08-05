<?php

use App\Models\Experience;
use App\Models\Project;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    Project::factory()->published()->count(2)->create();
    Project::factory()->create();
    Experience::factory()->published()->create();
    Experience::factory()->count(2)->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Dashboard')
            ->where('contentSummary.projects', [
                'total' => 3,
                'published' => 2,
                'drafts' => 1,
            ])
            ->where('contentSummary.experiences', [
                'total' => 3,
                'published' => 1,
                'drafts' => 2,
            ]));
});
