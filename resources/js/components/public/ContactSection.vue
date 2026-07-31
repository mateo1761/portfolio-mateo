<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Send } from '@lucide/vue';
import { toast } from 'vue-sonner';
import type {
    PortfolioCopy,
    PortfolioLocale,
} from '@/lib/portfolio-translations';
import { store } from '@/routes/contact';

const props = defineProps<{
    locale: PortfolioLocale;
    copy: PortfolioCopy['contact'];
}>();

const fieldClass =
    'min-h-12 w-full border border-portfolio-divider bg-portfolio-background px-4 text-portfolio-text outline-none transition-colors placeholder:text-portfolio-muted/60 focus:border-portfolio-gold focus:ring-1 focus:ring-portfolio-gold aria-invalid:border-red-400 motion-reduce:transition-none';

function handleSuccess(): void {
    toast.success(props.copy.toastTitle, {
        description: props.copy.toastDescription,
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
            disable-while-processing
            :options="{ preserveScroll: true }"
            v-slot="{ errors, processing, wasSuccessful }"
            class="grid gap-6 inert:pointer-events-none inert:opacity-70"
            @success="handleSuccess"
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
