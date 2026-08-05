<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Pencil, Plus } from '@lucide/vue';
import Heading from '@/components/Heading.vue';
import DeleteProjectDialog from '@/components/projects/DeleteProjectDialog.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { create, edit, index } from '@/routes/projects';
import type { Project } from '@/types';

defineProps<{
    projects: Project[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Projects', href: index() }],
    },
});
</script>

<template>
    <Head title="Projects" />

    <div class="flex flex-1 flex-col gap-8 p-5 sm:p-8 lg:p-12">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p
                    class="mb-4 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
                >
                    Portfolio content
                </p>
                <Heading
                    title="Projects"
                    description="Manage bilingual portfolio projects and publication status."
                />
            </div>
            <Button as-child>
                <Link :href="create()">
                    <Plus aria-hidden="true" />
                    Create project
                </Link>
            </Button>
        </div>

        <div
            v-if="projects.length === 0"
            class="rounded-xl border border-dashed border-portfolio-gold/35 bg-portfolio-surface/50 p-10 text-center"
        >
            <p class="font-medium">No projects have been added yet.</p>
            <p class="mt-2 text-sm text-muted-foreground">
                Create the first bilingual project when you are ready.
            </p>
        </div>

        <div v-else class="grid gap-4">
            <article
                v-for="project in projects"
                :key="project.id"
                class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 shadow-lg shadow-black/10 transition-colors hover:border-portfolio-gold/45 motion-reduce:transition-none md:grid-cols-[minmax(0,1fr)_auto] md:items-center"
            >
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="truncate text-lg font-semibold">
                            {{ project.title_es }}
                        </h2>
                        <Badge
                            :variant="
                                project.is_published ? 'default' : 'secondary'
                            "
                        >
                            {{ project.is_published ? 'Published' : 'Draft' }}
                        </Badge>
                        <Badge variant="outline">
                            {{
                                project.is_private
                                    ? 'Private'
                                    : 'Public repository'
                            }}
                        </Badge>
                    </div>
                    <p class="mt-1 truncate text-sm text-muted-foreground">
                        {{ project.title_en }}
                    </p>
                    <p class="mt-3 text-sm text-muted-foreground">
                        Position {{ project.sort_order }} ·
                        {{ project.category_es }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-2 md:justify-end">
                    <Button variant="outline" size="sm" as-child>
                        <Link :href="edit(project.id)">
                            <Pencil aria-hidden="true" />
                            Edit
                        </Link>
                    </Button>
                    <DeleteProjectDialog :project="project" />
                </div>
            </article>
        </div>
    </div>
</template>
