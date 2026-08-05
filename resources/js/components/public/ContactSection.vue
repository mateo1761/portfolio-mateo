<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { CircleAlert, Send } from '@lucide/vue';
import { nextTick } from 'vue';
import { toast } from 'vue-sonner';
import type {
    PortfolioCopy,
    PortfolioLocale,
} from '@/lib/portfolio-translations';
import { privacy } from '@/routes';
import { store } from '@/routes/contact';
import { en as privacyEn } from '@/routes/privacy';

const props = defineProps<{
    locale: PortfolioLocale;
    copy: PortfolioCopy['contact'];
}>();

const fieldClass =
    'min-h-12 w-full border border-portfolio-divider bg-portfolio-background px-4 text-portfolio-text outline-none transition-colors placeholder:text-portfolio-muted/60 focus:border-portfolio-gold focus:ring-1 focus:ring-portfolio-gold aria-invalid:border-red-400 aria-invalid:bg-red-950/20 motion-reduce:transition-none';

const fieldIds: Record<string, string> = {
    name: 'name',
    email: 'email',
    subject: 'subject',
    message: 'message',
    privacy_consent: 'privacy-consent',
};

function handleSuccess(): void {
    toast.success(props.copy.toastTitle, {
        description: props.copy.toastDescription,
    });
}

function handleError(errors: Record<string, string>): void {
    const firstInvalidFieldId = Object.entries(fieldIds).find(
        ([field]) => errors[field],
    )?.[1];

    if (!firstInvalidFieldId) {
        return;
    }

    void nextTick(() => {
        document.getElementById(firstInvalidFieldId)?.focus();
    });
}
</script>

<template>
    <section
        id="contacto"
        aria-labelledby="contact-heading"
        class="mx-auto grid max-w-7xl gap-14 px-5 py-24 sm:px-8 sm:py-32 lg:grid-cols-[0.8fr_1.2fr] lg:px-12"
    >
        <div>
            <p
                class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                {{ props.copy.eyebrow }}
            </p>
            <h2
                id="contact-heading"
                class="mt-5 text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
            >
                {{ props.copy.heading }}
            </h2>
            <p class="mt-6 max-w-lg text-lg leading-8 text-portfolio-muted">
                {{ props.copy.description }}
            </p>
        </div>

        <Form
            v-bind="store.form()"
            reset-on-success
            novalidate
            disable-while-processing
            :options="{ preserveScroll: true }"
            v-slot="{ errors, hasErrors, processing, wasSuccessful }"
            class="grid gap-6 inert:pointer-events-none inert:opacity-70"
            @success="handleSuccess"
            @error="handleError"
        >
            <input type="hidden" name="locale" :value="props.locale" />

            <div
                class="absolute -left-[9999px] size-px overflow-hidden"
                aria-hidden="true"
            >
                <label for="company">{{ props.copy.honeypotLabel }}</label>
                <input
                    id="company"
                    type="text"
                    name="company"
                    tabindex="-1"
                    autocomplete="off"
                />
            </div>

            <div
                v-if="hasErrors"
                role="alert"
                aria-live="assertive"
                class="border border-red-400/50 bg-red-950/20 p-4 text-sm text-red-100"
            >
                <div class="flex items-start gap-3">
                    <CircleAlert
                        class="mt-0.5 size-5 shrink-0 text-red-300"
                        aria-hidden="true"
                    />
                    <div>
                        <p class="font-semibold">
                            {{ props.copy.errorsTitle }}
                        </p>
                        <p class="mt-1 text-red-200">
                            {{ props.copy.errorsDescription }}
                        </p>
                        <ul class="mt-2 grid list-disc gap-1 pl-5">
                            <li v-for="error in errors" :key="error">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="grid gap-2">
                    <label for="name" class="text-sm font-medium">
                        {{ props.copy.nameLabel }}
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        required
                        autocomplete="name"
                        :class="fieldClass"
                        :aria-invalid="Boolean(errors.name)"
                        :aria-describedby="
                            errors.name ? 'name-error' : undefined
                        "
                    />
                    <p
                        v-if="errors.name"
                        id="name-error"
                        class="text-sm text-red-300"
                    >
                        {{ errors.name }}
                    </p>
                </div>

                <div class="grid gap-2">
                    <label for="email" class="text-sm font-medium">
                        {{ props.copy.emailLabel }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                        :class="fieldClass"
                        :aria-invalid="Boolean(errors.email)"
                        :aria-describedby="
                            errors.email ? 'email-error' : undefined
                        "
                    />
                    <p
                        v-if="errors.email"
                        id="email-error"
                        class="text-sm text-red-300"
                    >
                        {{ errors.email }}
                    </p>
                </div>
            </div>

            <div class="grid gap-2">
                <label for="subject" class="text-sm font-medium">
                    {{ props.copy.subjectLabel }}
                </label>
                <input
                    id="subject"
                    type="text"
                    name="subject"
                    required
                    :class="fieldClass"
                    :aria-invalid="Boolean(errors.subject)"
                    :aria-describedby="
                        errors.subject ? 'subject-error' : undefined
                    "
                />
                <p
                    v-if="errors.subject"
                    id="subject-error"
                    class="text-sm text-red-300"
                >
                    {{ errors.subject }}
                </p>
            </div>

            <div class="grid gap-2">
                <label for="message" class="text-sm font-medium">
                    {{ props.copy.messageLabel }}
                </label>
                <textarea
                    id="message"
                    name="message"
                    required
                    rows="6"
                    :class="[fieldClass, 'resize-y py-3']"
                    :aria-invalid="Boolean(errors.message)"
                    :aria-describedby="
                        errors.message ? 'message-error' : 'message-help'
                    "
                />
                <p id="message-help" class="text-sm text-portfolio-muted">
                    {{ props.copy.messageHelp }}
                </p>
                <p
                    v-if="errors.message"
                    id="message-error"
                    class="text-sm text-red-300"
                >
                    {{ errors.message }}
                </p>
            </div>

            <div
                v-if="wasSuccessful"
                role="status"
                aria-live="polite"
                class="border-l-2 border-portfolio-gold pl-4 text-sm text-portfolio-text"
            >
                {{ props.copy.successMessage }}
            </div>

            <div class="grid gap-2">
                <div class="flex items-start gap-3">
                    <input
                        id="privacy-consent"
                        type="checkbox"
                        name="privacy_consent"
                        value="1"
                        required
                        class="mt-1 size-5 shrink-0 accent-portfolio-gold outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold focus-visible:ring-offset-2 focus-visible:ring-offset-portfolio-background"
                        :aria-invalid="Boolean(errors.privacy_consent)"
                        :aria-describedby="
                            errors.privacy_consent
                                ? 'privacy-consent-error'
                                : undefined
                        "
                    />
                    <label
                        for="privacy-consent"
                        class="text-sm leading-6 text-portfolio-muted"
                    >
                        {{ props.copy.privacyConsentPrefix }}
                        <Link
                            :href="
                                props.locale === 'es' ? privacy() : privacyEn()
                            "
                            class="font-semibold text-portfolio-text underline decoration-portfolio-gold underline-offset-4 outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        >
                            {{ props.copy.privacyConsentLink }}
                        </Link>
                        {{ props.copy.privacyConsentSuffix }}
                    </label>
                </div>
                <p
                    v-if="errors.privacy_consent"
                    id="privacy-consent-error"
                    class="text-sm text-red-300"
                >
                    {{ errors.privacy_consent }}
                </p>
            </div>

            <button
                type="submit"
                :disabled="processing"
                :aria-busy="processing"
                class="inline-flex min-h-12 w-fit items-center justify-center gap-2 bg-portfolio-gold px-6 font-semibold text-portfolio-background transition-colors outline-none hover:bg-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-text focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background disabled:cursor-wait disabled:opacity-60 motion-reduce:transition-none"
            >
                <Send class="size-4" aria-hidden="true" />
                {{
                    processing
                        ? props.copy.sendingLabel
                        : props.copy.submitLabel
                }}
            </button>
        </Form>
    </section>
</template>
