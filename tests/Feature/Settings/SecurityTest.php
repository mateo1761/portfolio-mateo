<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Features;

use function Pest\Laravel\mock;

test('security page is displayed', function () {
    $this->skipUnlessFortifyHas(Features::twoFactorAuthentication());

    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);
    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/Security')
            ->where('canManageTwoFactor', true)
            ->where('twoFactorEnabled', false)
            ->where('requiresConfirmation', true),
        );
});

test('security page requires recent password confirmation', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('security.edit'))
        ->assertRedirect(route('password.confirm'));
});

test('security page renders without two factor when feature is disabled', function () {
    $this->skipUnlessFortifyHas(Features::twoFactorAuthentication());

    config(['fortify.features' => []]);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/Security')
            ->where('canManageTwoFactor', false)
            ->missing('twoFactorEnabled')
            ->missing('requiresConfirmation'),
        );
});

test('security page reports confirmed two factor authentication', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/Security')
            ->where('canManageTwoFactor', true)
            ->where('twoFactorEnabled', true)
            ->where('requiresConfirmation', true),
        );
});

test('two factor authentication can be enabled and confirmed', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->post(route('two-factor.enable'))
        ->assertRedirect();

    $user->refresh();

    expect($user->two_factor_secret)->not->toBeNull()
        ->and($user->two_factor_recovery_codes)->not->toBeNull()
        ->and($user->two_factor_confirmed_at)->toBeNull();

    mock(TwoFactorAuthenticationProvider::class)
        ->shouldReceive('verify')
        ->once()
        ->andReturnTrue();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->post(route('two-factor.confirm'), [
            'code' => '123456',
        ])
        ->assertRedirect()
        ->assertSessionHas('status', 'two-factor-authentication-confirmed');

    expect($user->refresh()->two_factor_confirmed_at)->not->toBeNull();
});

test('two factor recovery codes can be viewed and regenerated', function () {
    $user = User::factory()->withTwoFactor()->create();
    $originalRecoveryCodes = $user->recoveryCodes();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->getJson(route('two-factor.recovery-codes'))
        ->assertOk()
        ->assertExactJson($originalRecoveryCodes);

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->post(route('two-factor.regenerate-recovery-codes'))
        ->assertRedirect();

    expect($user->refresh()->recoveryCodes())
        ->toHaveCount(8)
        ->not->toBe($originalRecoveryCodes);
});

test('two factor management endpoints require recent password confirmation', function (string $method, string $routeName) {
    $user = User::factory()->withTwoFactor()->create();

    $this->actingAs($user)
        ->call($method, route($routeName))
        ->assertRedirect(route('password.confirm'));
})->with([
    'enable' => ['POST', 'two-factor.enable'],
    'disable' => ['DELETE', 'two-factor.disable'],
    'QR code' => ['GET', 'two-factor.qr-code'],
    'secret key' => ['GET', 'two-factor.secret-key'],
    'recovery codes' => ['GET', 'two-factor.recovery-codes'],
    'regenerate recovery codes' => ['POST', 'two-factor.regenerate-recovery-codes'],
]);

test('password can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('security.edit'))
        ->put(route('user-password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('security.edit'));

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('security.edit'))
        ->put(route('user-password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrors('current_password')
        ->assertRedirect(route('security.edit'));
});
