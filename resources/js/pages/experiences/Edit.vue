<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { update } from '@/actions/App/Http/Controllers/ExperienceController';
import AlertError from '@/components/AlertError.vue';
import ExperienceFields from '@/components/experiences/ExperienceFields.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { index } from '@/routes/experiences';
import type { Experience } from '@/types';

const props = defineProps<{ experience: Experience }>();
defineOptions({
    layout: { breadcrumbs: [{ title: 'Experience', href: index() }] },
});
</script>

<template>
    <Head :title="`Edit ${props.experience.role_en}`" />
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
                title="Edit experience"
                description="Keep both language versions accurate and consistent."
            />
        </div>
        <Form
            v-bind="update.form(props.experience.id)"
            class="grid gap-6"
            novalidate
            v-slot="{ errors, hasErrors, processing }"
        >
            <AlertError
                v-if="hasErrors"
                :errors="Object.values(errors)"
                title="Review the experience information."
            />
            <ExperienceFields :errors="errors" :experience="props.experience" />
            <div class="flex justify-end gap-3">
                <Button variant="outline" as-child
                    ><Link :href="index()">Cancel</Link></Button
                ><Button type="submit" :disabled="processing">{{
                    processing ? 'Saving…' : 'Save changes'
                }}</Button>
            </div>
        </Form>
    </div>
</template>
