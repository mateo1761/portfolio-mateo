<script setup lang="ts">
import type { PortfolioCopy } from '@/lib/portfolio-translations';

const props = defineProps<{
    copy: PortfolioCopy['about'];
}>();
</script>

<template>
    <section
        id="sobre-mi"
        aria-labelledby="about-heading"
        class="mx-auto grid max-w-7xl gap-12 px-5 py-24 sm:px-8 sm:py-32 lg:grid-cols-[0.75fr_1.25fr] lg:px-12"
    >
        <div>
            <p
                class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                {{ props.copy.eyebrow }}
            </p>
            <h2
                id="about-heading"
                class="mt-5 max-w-lg text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
            >
                {{ props.copy.heading }}
            </h2>
        </div>

        <div class="lg:pt-9">
            <p class="max-w-2xl text-lg leading-8 text-portfolio-muted">
                {{ props.copy.description }}
            </p>

            <ul
                class="mt-10 divide-y divide-portfolio-divider border-y border-portfolio-divider"
                :aria-label="props.copy.technologiesLabel"
            >
                <li
                    v-for="group in props.copy.technologies"
                    :key="group"
                    class="py-4 text-base font-medium text-portfolio-text"
                >
                    {{ group }}
                </li>
            </ul>
        </div>
    </section>
</template>
