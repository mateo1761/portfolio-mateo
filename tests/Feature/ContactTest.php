<?php

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    config(['mail.contact_to' => 'portfolio@example.com']);
});

test('contact form validates its public fields', function (array $invalidData, string $field) {
    Mail::fake();

    $response = $this
        ->from(route('home'))
        ->post(route('contact.store'), [
            'name' => 'Mateo Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Project opportunity',
            'message' => 'I would like to discuss a new Laravel project.',
            'privacy_consent' => '1',
            ...$invalidData,
        ]);

    $response
        ->assertRedirect(route('home'))
        ->assertSessionHasErrors($field);

    Mail::assertNothingSent();
})->with([
    'name is required' => [['name' => ''], 'name'],
    'email must be valid' => [['email' => 'invalid-email'], 'email'],
    'subject is required' => [['subject' => ''], 'subject'],
    'message has a minimum length' => [['message' => 'Too short'], 'message'],
]);

test('contact form rejects honeypot submissions', function () {
    Mail::fake();

    $response = $this
        ->from(route('home'))
        ->post(route('contact.store'), [
            'name' => 'Automated Visitor',
            'email' => 'bot@example.com',
            'subject' => 'Automated message',
            'message' => 'This automated message should never be delivered.',
            'company' => 'Spam Company',
            'privacy_consent' => '1',
        ]);

    $response
        ->assertRedirect(route('home'))
        ->assertSessionHasErrors('company');

    Mail::assertNothingSent();
});

test('contact form returns validation messages in English', function () {
    Mail::fake();

    $response = $this
        ->from(route('home.en'))
        ->post(route('contact.store'), [
            'locale' => 'en',
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => 'Too short',
            'company' => '',
            'privacy_consent' => '1',
        ]);

    $response
        ->assertRedirect(route('home.en'))
        ->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'email' => 'Please enter a valid email address.',
            'subject' => 'The subject field is required.',
            'message' => 'The message must contain at least 20 characters.',
        ]);

    Mail::assertNothingSent();
});

test('contact form returns validation messages in Spanish', function () {
    Mail::fake();

    $response = $this
        ->from(route('home'))
        ->post(route('contact.store'), [
            'locale' => 'es',
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => 'Muy corto',
            'company' => '',
            'privacy_consent' => '1',
        ]);

    $response
        ->assertRedirect(route('home'))
        ->assertSessionHasErrors([
            'name' => 'El campo nombre es obligatorio.',
            'email' => 'Ingresa una dirección de correo válida.',
            'subject' => 'El campo asunto es obligatorio.',
            'message' => 'El mensaje debe contener al menos 20 caracteres.',
        ]);

    Mail::assertNothingSent();
});

test('contact form sends a message to the configured recipient', function () {
    Mail::fake();

    $response = $this
        ->from(route('home'))
        ->post(route('contact.store'), [
            'name' => 'Portfolio Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Laravel opportunity',
            'message' => 'I would like to discuss a Laravel and Vue opportunity.',
            'company' => '',
            'privacy_consent' => '1',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));

    Mail::assertSent(ContactMessage::class, function (ContactMessage $message) {
        return $message->hasTo('portfolio@example.com')
            && $message->name === 'Portfolio Visitor'
            && $message->email === 'visitor@example.com'
            && $message->contactSubject === 'Laravel opportunity'
            && $message->policyVersion === '1.0'
            && $message->formLocale === 'es';
    });
});

test('contact mailable renders escaped content and reply information', function () {
    $message = new ContactMessage(
        name: 'Ana & Asociados',
        email: 'visitor@example.com',
        contactSubject: 'Proyecto <Laravel>',
        messageBody: "Primera línea\nSegunda línea <script>alert('test')</script>",
        consentGrantedAt: '2026-08-04T18:30:00+00:00',
        policyVersion: '1.0',
        formLocale: 'es',
    );

    $message
        ->assertHasReplyTo('visitor@example.com', 'Ana & Asociados')
        ->assertHasSubject('Nuevo mensaje desde el portafolio')
        ->assertSeeInHtml('Ana & Asociados')
        ->assertSeeInHtml('Proyecto <Laravel>')
        ->assertSeeInHtml("Segunda línea <script>alert('test')</script>")
        ->assertDontSeeInHtml("<script>alert('test')</script>", escape: false)
        ->assertSeeInHtml('Autorización aceptada: Sí')
        ->assertSeeInHtml('2026-08-04T18:30:00+00:00')
        ->assertSeeInHtml('Versión de la política: 1.0')
        ->assertSeeInHtml(
            'mailto:visitor@example.com?subject=Re%3A%20Proyecto%20%3CLaravel%3E',
            escape: false,
        );
});

test('contact form is rate limited', function () {
    Mail::fake();

    $data = [
        'name' => 'Portfolio Visitor',
        'email' => 'visitor@example.com',
        'subject' => 'Laravel opportunity',
        'message' => 'I would like to discuss a Laravel and Vue opportunity.',
        'company' => '',
        'privacy_consent' => '1',
    ];

    foreach (range(1, 5) as $attempt) {
        $this->post(route('contact.store'), $data)->assertRedirect();
    }

    $this->post(route('contact.store'), $data)->assertTooManyRequests();

    Mail::assertSentCount(5);
});

test('contact form requires express privacy authorization in both languages', function (string $locale, string $referrer, string $message) {
    Mail::fake();

    $this
        ->from($referrer)
        ->post(route('contact.store'), [
            'locale' => $locale,
            'name' => 'Portfolio Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Laravel opportunity',
            'message' => 'I would like to discuss a Laravel and Vue opportunity.',
            'company' => '',
        ])
        ->assertRedirect($referrer)
        ->assertSessionHasErrors([
            'privacy_consent' => $message,
        ]);

    Mail::assertNothingSent();
})->with([
    'Spanish' => [
        'es',
        fn () => route('home'),
        'Debes autorizar el tratamiento de tus datos personales para enviar el mensaje.',
    ],
    'English' => [
        'en',
        fn () => route('home.en'),
        'You must authorize the processing of your personal data to send the message.',
    ],
]);
