<?php

namespace App\Http\Controllers;

use App\Actions\RecordContactConsentAction;
use App\Actions\RecordDailySiteMetricAction;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Illuminate\Support\defer;

class ContactController extends Controller
{
    public function __invoke(
        ContactRequest $request,
        RecordContactConsentAction $recordConsent,
        RecordDailySiteMetricAction $recordMetric,
    ): RedirectResponse {
        $contact = $request->safe()->except(['website', 'locale', 'privacy_consent']);
        $formLocale = $request->string('locale')->toString() === 'en' ? 'en' : 'es';

        DB::transaction(function () use ($contact, $formLocale, $recordConsent): void {
            $consent = $recordConsent->execute($contact['email'], $formLocale);

            Mail::to((string) config('mail.contact_to'))->send(new ContactMessage(
                name: $contact['name'],
                email: $contact['email'],
                contactSubject: $contact['subject'],
                messageBody: $contact['message'],
                consentGrantedAt: $consent->consented_at->toIso8601String(),
                policyVersion: $consent->policy_version,
                formLocale: $consent->locale,
            ));
        });

        defer(fn () => $recordMetric->recordContactSubmission());

        return back();
    }
}
