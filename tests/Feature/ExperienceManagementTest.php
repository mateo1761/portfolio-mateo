<?php

use App\Models\Experience;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

function validExperienceData(array $overrides = []): array
{
    return [
        'company' => 'CRONOS LOGISTICS',
        'role_es' => 'Desarrollador Full Stack',
        'role_en' => 'Full Stack Developer',
        'period_es' => 'Feb. 2026 - Actualidad',
        'period_en' => 'Feb. 2026 - Present',
        'location_es' => 'Medellín, Antioquia - Híbrido',
        'location_en' => 'Medellín, Antioquia - Hybrid',
        'summary_es' => 'Descripción profesional en español.',
        'summary_en' => 'Professional description in English.',
        'is_published' => true,
        'sort_order' => 10,
        ...$overrides,
    ];
}

test('guests cannot access experience administration', function () {
    $this->get(route('experiences.index'))->assertRedirect(route('login'));
});

test('authenticated users can create update and delete experience', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('experiences.store'), validExperienceData())
        ->assertRedirect(route('experiences.index'));

    $experience = Experience::query()->sole();
    expect($experience->role_en)->toBe('Full Stack Developer');

    $this->actingAs($user)->put(route('experiences.update', $experience), validExperienceData([
        'role_en' => 'Senior Full Stack Developer',
    ]))->assertRedirect(route('experiences.index'));

    expect($experience->refresh()->role_en)->toBe('Senior Full Stack Developer');

    $this->actingAs($user)->delete(route('experiences.destroy', $experience))
        ->assertRedirect(route('experiences.index'));
    $this->assertModelMissing($experience);
});

test('experience validation messages come from the backend', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('experiences.store'), validExperienceData([
        'role_es' => '',
    ]))->assertSessionHasErrors([
        'role_es' => 'The Spanish role field is required.',
    ]);
});

test('public portfolio displays localized published experience in order', function () {
    Experience::factory()->create(['is_published' => false, 'sort_order' => 1]);
    $second = Experience::factory()->published()->create(['company' => 'SECOND', 'sort_order' => 20]);
    $first = Experience::factory()->published()->create([
        'company' => 'FIRST',
        'role_es' => 'Rol español',
        'role_en' => 'English role',
        'sort_order' => 10,
    ]);

    $this->get(route('home'))->assertInertia(fn (Assert $page) => $page
        ->has('experiences', 2)
        ->where('experiences.0.id', $first->id)
        ->where('experiences.0.role', 'Rol español')
        ->where('experiences.1.id', $second->id));

    $this->get(route('home.en'))->assertInertia(fn (Assert $page) => $page
        ->where('experiences.0.role', 'English role'));
});
