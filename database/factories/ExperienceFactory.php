<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => fake()->company(),
            'role_es' => fake()->jobTitle(),
            'role_en' => fake()->jobTitle(),
            'period_es' => 'Ene. 2024 - Actualidad',
            'period_en' => 'Jan. 2024 - Present',
            'location_es' => 'Medellín, Antioquia - Híbrido',
            'location_en' => 'Medellín, Antioquia - Hybrid',
            'summary_es' => fake()->paragraph(),
            'summary_en' => fake()->paragraph(),
            'is_published' => false,
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (): array => ['is_published' => true]);
    }
}
