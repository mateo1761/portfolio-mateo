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
        ]);

    $response
        ->assertRedirect(route('home'))
        ->assertSessionHasErrors('company');

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
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));

    Mail::assertSent(ContactMessage::class, function (ContactMessage $message) {
        return $message->hasTo('portfolio@example.com')
            && $message->name === 'Portfolio Visitor'
            && $message->email === 'visitor@example.com'
            && $message->contactSubject === 'Laravel opportunity';
    });
});

test('contact mailable renders escaped content and reply information', function () {
    $message = new ContactMessage(
        name: 'Ana & Asociados',
        email: 'visitor@example.com',
        contactSubject: 'Proyecto <Laravel>',
        messageBody: "Primera línea\nSegunda línea <script>alert('test')</script>",
    );

    $message
        ->assertHasReplyTo('visitor@example.com', 'Ana & Asociados')
        ->assertHasSubject('Nuevo mensaje desde el portafolio')
        ->assertSeeInHtml('Ana & Asociados')
        ->assertSeeInHtml('Proyecto <Laravel>')
        ->assertSeeInHtml("Segunda línea <script>alert('test')</script>")
        ->assertDontSeeInHtml("<script>alert('test')</script>", escape: false)
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
    ];

    foreach (range(1, 5) as $attempt) {
        $this->post(route('contact.store'), $data)->assertRedirect();
    }

    $this->post(route('contact.store'), $data)->assertTooManyRequests();

    Mail::assertSentCount(5);
});
