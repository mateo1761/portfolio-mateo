<?php

use App\Models\Project;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

function validProjectData(array $overrides = []): array
{
    return [
        'title_es' => 'Sistema de reportes dinámicos',
        'title_en' => 'Dynamic reporting system',
        'category_es' => 'Sistema empresarial',
        'category_en' => 'Enterprise system',
        'description_es' => 'Descripción profesional en español.',
        'description_en' => 'Professional description in English.',
        'technologies_es' => 'Laravel · Vue.js · PostgreSQL',
        'technologies_en' => 'Laravel · Vue.js · PostgreSQL',
        'repository_url' => 'https://github.com/mateo1761/portfolio-mateo',
        'is_private' => false,
        'is_published' => true,
        'sort_order' => 1,
        ...$overrides,
    ];
}

test('guests cannot access project administration', function (string $routeName) {
    $project = Project::factory()->create();

    $parameters = str_contains($routeName, 'edit') ? [$project] : [];

    $this->get(route($routeName, $parameters))
        ->assertRedirect(route('login'));
})->with([
    'index' => 'projects.index',
    'create' => 'projects.create',
    'edit' => 'projects.edit',
]);

test('authenticated users can view projects ordered for administration', function () {
    $user = User::factory()->create();
    $laterProject = Project::factory()->create(['sort_order' => 20]);
    $firstProject = Project::factory()->create(['sort_order' => 10]);

    $this->actingAs($user)
        ->get(route('projects.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('projects/Index')
            ->has('projects', 2)
            ->where('projects.0.id', $firstProject->id)
            ->where('projects.1.id', $laterProject->id));
});

test('authenticated users can create bilingual projects', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('projects.store'), validProjectData())
        ->assertRedirect(route('projects.index'));

    $project = Project::query()->first();

    expect($project)
        ->not->toBeNull()
        ->title_es->toBe('Sistema de reportes dinámicos')
        ->title_en->toBe('Dynamic reporting system')
        ->is_published->toBeTrue();
});

test('project input is validated by the backend with readable messages', function (array $overrides, string $field, string $message) {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('projects.store'), validProjectData($overrides))
        ->assertSessionHasErrors([$field => $message]);

    expect(Project::query()->exists())->toBeFalse();
})->with([
    'missing Spanish title' => [
        ['title_es' => ''],
        'title_es',
        'The Spanish title field is required.',
    ],
    'missing English description' => [
        ['description_en' => ''],
        'description_en',
        'The English description field is required.',
    ],
    'invalid repository URL' => [
        ['repository_url' => 'not-a-url'],
        'repository_url',
        'The repository URL must be a valid HTTP or HTTPS URL.',
    ],
    'negative order' => [
        ['sort_order' => -1],
        'sort_order',
        'The sort order must be at least 0.',
    ],
]);

test('authenticated users can update projects', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create();

    $this->actingAs($user)
        ->put(route('projects.update', $project), validProjectData([
            'title_es' => 'Proyecto actualizado',
            'title_en' => 'Updated project',
        ]))
        ->assertRedirect(route('projects.index'));

    expect($project->refresh())
        ->title_es->toBe('Proyecto actualizado')
        ->title_en->toBe('Updated project')
        ->is_published->toBeTrue();
});

test('authenticated users can delete projects', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create();

    $this->actingAs($user)
        ->delete(route('projects.destroy', $project))
        ->assertRedirect(route('projects.index'));

    $this->assertModelMissing($project);
});

test('public portfolio displays only published projects in the configured order', function () {
    Project::factory()->create([
        'title_es' => 'Borrador privado',
        'is_published' => false,
        'sort_order' => 1,
    ]);
    $secondProject = Project::factory()->published()->create([
        'title_es' => 'Segundo proyecto',
        'repository_url' => null,
        'sort_order' => 20,
    ]);
    $firstProject = Project::factory()->published()->create([
        'title_es' => 'Primer proyecto',
        'repository_url' => null,
        'sort_order' => 10,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('projects', 2)
            ->where('projects.0.id', $firstProject->id)
            ->where('projects.0.number', '01')
            ->where('projects.0.title', 'Primer proyecto')
            ->where('projects.0.url', null)
            ->where('projects.1.id', $secondProject->id)
            ->where('projects.1.number', '02'));
});

test('English portfolio receives English project content', function () {
    $project = Project::factory()->published()->create([
        'title_es' => 'Título en español',
        'title_en' => 'English title',
        'category_en' => 'English category',
        'description_en' => 'English description',
        'technologies_en' => 'Laravel · Vue.js',
    ]);

    $this->get(route('home.en'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->where('projects.0.id', $project->id)
            ->where('projects.0.title', 'English title')
            ->where('projects.0.category', 'English category')
            ->where('projects.0.description', 'English description')
            ->where('projects.0.technologies', 'Laravel · Vue.js'));
});
