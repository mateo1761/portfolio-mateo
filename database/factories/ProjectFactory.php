<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_es' => fake()->sentence(3),
            'title_en' => fake()->sentence(3),
            'category_es' => fake()->words(2, true),
            'category_en' => fake()->words(2, true),
            'description_es' => fake()->paragraph(),
            'description_en' => fake()->paragraph(),
            'technologies_es' => 'Laravel · Vue.js · PostgreSQL',
            'technologies_en' => 'Laravel · Vue.js · PostgreSQL',
            'repository_url' => null,
            'is_private' => true,
            'is_published' => false,
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the project is publicly visible.
     */
    public function published(): static
    {
        return $this->state(fn (): array => [
            'is_published' => true,
        ]);
    }
}
