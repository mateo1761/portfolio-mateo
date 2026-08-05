<?php

namespace App\Http\Controllers;

use App\Actions\RecordDailySiteMetricAction;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

use function Illuminate\Support\defer;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request, RecordDailySiteMetricAction $recordMetric): RedirectResponse
    {
        $contact = $request->safe()->except(['website', 'locale', 'privacy_consent']);

        Mail::to((string) config('mail.contact_to'))->send(new ContactMessage(
            name: $contact['name'],
            email: $contact['email'],
            contactSubject: $contact['subject'],
            messageBody: $contact['message'],
            consentGrantedAt: now()->utc()->toIso8601String(),
            policyVersion: (string) config('privacy.policy_version'),
            formLocale: $request->string('locale')->toString() === 'en' ? 'en' : 'es',
        ));

        defer(fn () => $recordMetric->recordContactSubmission());

        return back();
    }
}
