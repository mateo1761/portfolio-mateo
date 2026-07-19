<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

test('database seeder creates one configured administrator idempotently', function () {
    config([
        'auth.administrator.name' => 'Portfolio Administrator',
        'auth.administrator.email' => 'admin@example.com',
        'auth.administrator.password' => 'a-secure-test-password',
    ]);

    $this->seed(DatabaseSeeder::class);
    $this->seed(DatabaseSeeder::class);

    expect(User::query()->count())->toBe(1);

    $administrator = User::query()->sole();

    expect($administrator->name)->toBe('Portfolio Administrator')
        ->and($administrator->email)->toBe('admin@example.com')
        ->and(Hash::check('a-secure-test-password', $administrator->password))->toBeTrue();
});
