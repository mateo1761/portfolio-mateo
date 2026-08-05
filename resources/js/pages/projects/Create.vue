<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/ProjectController';
import AlertError from '@/components/AlertError.vue';
import Heading from '@/components/Heading.vue';
import ProjectFields from '@/components/projects/ProjectFields.vue';
import { Button } from '@/components/ui/button';
import { create, index } from '@/routes/projects';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Projects', href: index() },
            { title: 'Create', href: create() },
        ],
    },
});
</script>

<template>
    <Head title="Create project" />

    <div
        class="mx-auto flex w-full max-w-5xl flex-col gap-8 p-5 sm:p-8 lg:p-12"
    >
        <div>
            <p
                class="mb-4 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                Project administration
            </p>
            <Heading
                title="Create project"
                description="Add the Spanish and English content before publishing."
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
                title="Review the project information."
            />
            <ProjectFields :errors="errors" />

            <div class="flex flex-wrap justify-end gap-3">
                <Button variant="outline" as-child>
                    <Link :href="index()">Cancel</Link>
                </Button>
                <Button type="submit" :disabled="processing">
                    {{ processing ? 'Saving…' : 'Create project' }}
                </Button>
            </div>
        </Form>
    </div>
</template>
