<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;

test('login returns a clear message for invalid credentials', function () {
    $user = User::factory()->create();

    $this->from(route('login'))
        ->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'incorrect-password',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors([
            'email' => 'El correo o la contraseña no son correctos.',
        ]);
});

test('login required fields use readable validation messages', function () {
    $this->from(route('login'))
        ->post(route('login.store'))
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors([
            'email' => 'El campo correo electrónico es obligatorio.',
            'password' => 'El campo contraseña es obligatorio.',
        ]);
});

test('password reset requests use readable status messages', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->from(route('password.request'))
        ->post(route('password.email'), ['email' => $user->email])
        ->assertRedirect(route('password.request'))
        ->assertSessionHas('status', 'Te enviamos un enlace para restablecer tu contraseña.');

    $this->from(route('password.request'))
        ->post(route('password.email'), ['email' => 'missing@example.com'])
        ->assertRedirect(route('password.request'))
        ->assertSessionHasErrors([
            'email' => 'No encontramos una cuenta asociada con ese correo.',
        ]);
});

test('invalid recovery credentials use readable messages', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->withSession(['login.id' => $user->id])
        ->from(route('two-factor.login'))
        ->post(route('two-factor.login.store'), [
            'recovery_code' => 'invalid-code',
        ])
        ->assertRedirect(route('two-factor.login'))
        ->assertSessionHasErrors([
            'recovery_code' => 'El código de recuperación no es válido.',
        ]);
});

test('authentication translations never expose unresolved keys', function () {
    expect(__('validation.required', ['attribute' => 'correo electrónico']))
        ->not->toBe('validation.required')
        ->and(__('auth.failed'))->not->toBe('auth.failed')
        ->and(__('passwords.token'))->not->toBe('passwords.token');
});
