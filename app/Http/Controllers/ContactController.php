<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request): RedirectResponse
    {
        $contact = $request->safe()->except(['company', 'locale']);

        Mail::to((string) config('mail.contact_to'))->send(new ContactMessage(
            name: $contact['name'],
            email: $contact['email'],
            contactSubject: $contact['subject'],
            messageBody: $contact['message'],
        ));

        return back();
    }
}
