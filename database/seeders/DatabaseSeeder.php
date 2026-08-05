<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $name = config('auth.administrator.name');
        $email = config('auth.administrator.email');
        $password = config('auth.administrator.password');

        if (
            ! is_string($name) || $name === ''
            || ! is_string($email) || $email === ''
            || ! is_string($password) || $password === ''
        ) {
            throw new RuntimeException('ADMIN_NAME, ADMIN_EMAIL, and ADMIN_PASSWORD must be configured before seeding.');
        }

        User::query()->firstOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => Hash::make($password),
        ]);

        $this->call(ProjectSeeder::class);
        $this->call(ExperienceSeeder::class);
    }
}
