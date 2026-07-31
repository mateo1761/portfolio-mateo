<script setup lang="ts">
import type { PortfolioCopy } from '@/lib/portfolio-translations';

const props = defineProps<{
    copy: PortfolioCopy['achievements'];
}>();
</script>

<template>
    <section
        :aria-label="props.copy.label"
        class="border-y border-portfolio-divider"
    >
        <dl
            class="mx-auto grid max-w-7xl grid-cols-1 px-5 sm:grid-cols-2 sm:px-8 lg:grid-cols-4 lg:px-12"
        >
            <div
                v-for="(achievement, index) in props.copy.items"
                :key="achievement.label"
                class="border-b border-portfolio-divider py-8 sm:px-6 sm:nth-[2n]:border-l lg:border-b-0 lg:px-8 lg:not-first:border-l lg:first:pl-0 lg:last:pr-0"
                :class="{
                    'last:border-b-0': index === props.copy.items.length - 1,
                }"
            >
                <dt class="max-w-56 text-sm leading-6 text-portfolio-muted">
                    {{ achievement.label }}
                </dt>
                <dd class="mt-2 text-3xl font-semibold text-portfolio-text">
                    {{ achievement.value }}
                </dd>
            </div>
        </dl>
    </section>
</template>
