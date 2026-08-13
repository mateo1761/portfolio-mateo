<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Features;

use function Pest\Laravel\mock;

test('login screen can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
});

test('login uses the private portfolio design', function () {
    $loginPage = file_get_contents(resource_path('js/pages/auth/Login.vue'));
    $authLayout = file_get_contents(resource_path('js/layouts/auth/AuthSimpleLayout.vue'));

    expect($loginPage)
        ->toContain('Welcome back')
        ->toContain('Sign in securely')
        ->and($authLayout)
        ->toContain('ShieldCheck')
        ->not->toContain('Private administration')
        ->not->toContain('adminPortrait');
});

test('public registration and email verification routes are disabled', function () {
    expect(Route::has('register'))->toBeFalse()
        ->and(Route::has('register.store'))->toBeFalse()
        ->and(Route::has('verification.notice'))->toBeFalse()
        ->and(Route::has('verification.verify'))->toBeFalse()
        ->and(Route::has('verification.send'))->toBeFalse();
});

test('password confirmation screen can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('password.confirm'))
        ->assertOk();
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users with two factor enabled are redirected to two factor challenge', function () {
    $this->skipUnlessFortifyHas(Features::twoFactorAuthentication());

    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);

    $user = User::factory()->withTwoFactor()->create();

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('two-factor.login'));
    $response->assertSessionHas('login.id', $user->id);
    $this->assertGuest();
});

test('two factor challenge screen can be rendered for a challenged user', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->withSession(['login.id' => $user->id])
        ->get(route('two-factor.login'))
        ->assertOk();
});

test('users can complete the two factor challenge with a valid authenticator code', function () {
    $user = User::factory()->withTwoFactor()->create();

    mock(TwoFactorAuthenticationProvider::class)
        ->shouldReceive('verify')
        ->once()
        ->with('test-two-factor-secret', '123456')
        ->andReturnTrue();

    $response = $this
        ->withSession(['login.id' => $user->id])
        ->post(route('two-factor.login.store'), [
            'code' => '123456',
        ]);

    $response
        ->assertRedirect(route('dashboard', absolute: false))
        ->assertSessionMissing('login.id');
    $this->assertAuthenticatedAs($user);
});

test('users remain guests when the authenticator code is invalid', function () {
    $user = User::factory()->withTwoFactor()->create();

    mock(TwoFactorAuthenticationProvider::class)
        ->shouldReceive('verify')
        ->once()
        ->andReturnFalse();

    $this
        ->withSession(['login.id' => $user->id])
        ->from(route('two-factor.login'))
        ->post(route('two-factor.login.store'), [
            'code' => '000000',
        ])
        ->assertRedirect(route('two-factor.login'))
        ->assertSessionHasErrors('code')
        ->assertSessionHas('login.id', $user->id);

    $this->assertGuest();
});

test('recovery codes authenticate once and are then consumed', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this
        ->withSession(['login.id' => $user->id])
        ->post(route('two-factor.login.store'), [
            'recovery_code' => 'test-recovery-code',
        ])
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticatedAs($user);
    expect($user->refresh()->recoveryCodes())->not->toContain('test-recovery-code');

    $this->post(route('logout'));

    $this
        ->withSession(['login.id' => $user->id])
        ->from(route('two-factor.login'))
        ->post(route('two-factor.login.store'), [
            'recovery_code' => 'test-recovery-code',
        ])
        ->assertRedirect(route('two-factor.login'))
        ->assertSessionHasErrors('recovery_code');

    $this->assertGuest();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('home'));

    $this->assertGuest();
});

test('users are rate limited', function () {
    $user = User::factory()->create();

    RateLimiter::increment(md5('login'.implode('|', [$user->email, '127.0.0.1'])), amount: 5);

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertTooManyRequests();
});
