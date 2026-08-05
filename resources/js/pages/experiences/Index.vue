<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Pencil, Plus } from '@lucide/vue';
import DeleteExperienceDialog from '@/components/experiences/DeleteExperienceDialog.vue';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { create, edit, index } from '@/routes/experiences';
import type { Experience } from '@/types';

defineProps<{ experiences: Experience[] }>();
defineOptions({
    layout: { breadcrumbs: [{ title: 'Experience', href: index() }] },
});
</script>

<template>
    <Head title="Experience" />
    <div class="flex flex-1 flex-col gap-8 p-5 sm:p-8 lg:p-12">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p
                    class="mb-4 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
                >
                    Portfolio content
                </p>
                <Heading
                    title="Experience"
                    description="Manage bilingual professional experience and publication status."
                />
            </div>
            <Button as-child
                ><Link :href="create()"><Plus />Create experience</Link></Button
            >
        </div>
        <div
            v-if="experiences.length === 0"
            class="rounded-xl border border-dashed border-portfolio-gold/35 bg-portfolio-surface/50 p-10 text-center"
        >
            No experience entries have been added yet.
        </div>
        <div v-else class="grid gap-4">
            <article
                v-for="experience in experiences"
                :key="experience.id"
                class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 md:grid-cols-[1fr_auto] md:items-center"
            >
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-lg font-semibold">
                            {{ experience.role_es }}
                        </h2>
                        <Badge
                            :variant="
                                experience.is_published
                                    ? 'default'
                                    : 'secondary'
                            "
                            >{{
                                experience.is_published ? 'Published' : 'Draft'
                            }}</Badge
                        >
                    </div>
                    <p class="mt-1 text-sm text-portfolio-muted">
                        {{ experience.company }} · {{ experience.period_es }}
                    </p>
                    <p class="mt-2 text-sm text-portfolio-muted">
                        {{ experience.role_en }} · Position
                        {{ experience.sort_order }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <Button variant="outline" size="sm" as-child
                        ><Link :href="edit(experience.id)"
                            ><Pencil />Edit</Link
                        ></Button
                    ><DeleteExperienceDialog :experience="experience" />
                </div>
            </article>
        </div>
    </div>
</template>
