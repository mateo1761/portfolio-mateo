<?php

namespace Database\Factories;

use App\Models\ContactConsent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactConsent>
 */
class ContactConsentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email_hash' => hash('sha256', fake()->unique()->safeEmail()),
            'consented_at' => now(),
            'policy_version' => '1.2',
            'locale' => fake()->randomElement(['es', 'en']),
        ];
    }
}
