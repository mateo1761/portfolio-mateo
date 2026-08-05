<script setup lang="ts">
import { ExternalLink } from '@lucide/vue';
import type { PortfolioCopy } from '@/lib/portfolio-translations';
import type { PublicProject } from '@/types';

const props = defineProps<{
    copy: PortfolioCopy['projects'];
    projects: PublicProject[];
}>();
</script>

<template>
    <section
        id="proyectos"
        aria-labelledby="projects-heading"
        class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32 lg:px-12"
    >
        <p
            class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
        >
            {{ props.copy.eyebrow }}
        </p>
        <h2
            id="projects-heading"
            class="mt-5 max-w-3xl text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
        >
            {{ props.copy.heading }}
        </h2>

        <div class="mt-16 border-t border-portfolio-divider">
            <article
                v-for="project in props.projects"
                :key="project.id"
                class="grid gap-6 border-b border-portfolio-divider py-12 sm:grid-cols-[4rem_1fr] sm:gap-8 lg:grid-cols-[5rem_0.8fr_1.2fr] lg:gap-12"
            >
                <p
                    class="font-mono text-2xl font-semibold text-portfolio-gold"
                    aria-hidden="true"
                >
                    {{ project.number }}
                </p>

                <div>
                    <p
                        class="text-xs font-semibold tracking-[0.14em] text-portfolio-gold uppercase"
                    >
                        {{ project.category }}
                    </p>
                    <h3
                        class="mt-4 text-2xl font-semibold tracking-[-0.02em] text-portfolio-text sm:text-3xl"
                    >
                        {{ project.title }}
                    </h3>
                </div>

                <div class="sm:col-start-2 lg:col-start-3">
                    <p class="mt-5 max-w-2xl leading-7 text-portfolio-muted">
                        {{ project.description }}
                    </p>
                    <p class="mt-7 text-sm font-medium text-portfolio-text">
                        {{ project.technologies }}
                    </p>

                    <p
                        v-if="!project.url"
                        class="mt-7 text-sm text-portfolio-muted"
                    >
                        {{
                            project.private
                                ? props.copy.privateLabel
                                : props.copy.noRepositoryLabel
                        }}
                    </p>
                    <a
                        v-else
                        :href="project.url"
                        target="_blank"
                        rel="noreferrer"
                        class="mt-7 inline-flex w-fit items-center gap-2 font-medium text-portfolio-text transition-colors outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                    >
                        {{ props.copy.repositoryLabel }}
                        <ExternalLink class="size-4" aria-hidden="true" />
                        <span class="sr-only">
                            ({{ props.copy.newTabLabel }})
                        </span>
                    </a>
                </div>
            </article>
        </div>
    </section>
</template>
