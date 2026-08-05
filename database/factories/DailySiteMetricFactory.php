<?php

namespace Database\Factories;

use App\Models\DailySiteMetric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DailySiteMetric>
 */
class DailySiteMetricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'metric_date' => fake()->unique()->dateTimeBetween('-11 months')->format('Y-m-d'),
            'visits' => fake()->numberBetween(0, 500),
            'contact_submissions' => fake()->numberBetween(0, 20),
        ];
    }
}
