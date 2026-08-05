<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/ExperienceController';
import AlertError from '@/components/AlertError.vue';
import ExperienceFields from '@/components/experiences/ExperienceFields.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { create, index } from '@/routes/experiences';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Experience', href: index() },
            { title: 'Create', href: create() },
        ],
    },
});
</script>

<template>
    <Head title="Create experience" />
    <div
        class="mx-auto flex w-full max-w-5xl flex-col gap-8 p-5 sm:p-8 lg:p-12"
    >
        <div>
            <p
                class="mb-4 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                Experience administration
            </p>
            <Heading
                title="Create experience"
                description="Add accurate Spanish and English professional information."
            />
        </div>
        <Form
            v-bind="store.form()"
            class="grid gap-6"
            novalidate
            v-slot="{ errors, hasErrors, processing }"
        >
            <AlertError
                v-if="hasErrors"
                :errors="Object.values(errors)"
                title="Review the experience information."
            />
            <ExperienceFields :errors="errors" />
            <div class="flex justify-end gap-3">
                <Button variant="outline" as-child
                    ><Link :href="index()">Cancel</Link></Button
                ><Button type="submit" :disabled="processing">{{
                    processing ? 'Saving…' : 'Create experience'
                }}</Button>
            </div>
        </Form>
    </div>
</template>
