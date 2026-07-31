<script setup lang="ts">
import type { PortfolioCopy } from '@/lib/portfolio-translations';

const props = defineProps<{
    copy: PortfolioCopy['experience'];
}>();
</script>

<template>
    <section
        id="experiencia"
        aria-labelledby="experience-heading"
        class="bg-portfolio-surface"
    >
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32 lg:px-12">
            <p
                class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                {{ props.copy.eyebrow }}
            </p>
            <h2
                id="experience-heading"
                class="mt-5 max-w-3xl text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
            >
                {{ props.copy.heading }}
            </h2>

            <ol class="mt-16 border-t border-portfolio-divider">
                <li
                    v-for="experience in props.copy.items"
                    :key="`${experience.company}-${experience.period}`"
                    class="grid gap-5 border-b border-portfolio-divider py-9 md:grid-cols-[0.55fr_0.9fr_1.55fr] md:gap-10"
                >
                    <div>
                        <p class="font-semibold text-portfolio-text">
                            {{ experience.company }}
                        </p>
                        <p class="mt-2 text-sm text-portfolio-gold">
                            {{ experience.period }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-medium text-portfolio-text">
                            {{ experience.role }}
                        </h3>
                        <p class="mt-2 text-sm text-portfolio-muted">
                            {{ experience.location }}
                        </p>
                    </div>

                    <p class="leading-7 text-portfolio-muted">
                        {{ experience.summary }}
                    </p>
                </li>
            </ol>
        </div>
    </section>
</template>
