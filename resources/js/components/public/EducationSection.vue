<script setup lang="ts">
import type { PortfolioCopy } from '@/lib/portfolio-translations';

const props = defineProps<{
    copy: PortfolioCopy['education'];
}>();
</script>

<template>
    <section aria-labelledby="education-heading" class="bg-portfolio-surface">
        <div
            class="mx-auto grid max-w-7xl gap-10 px-5 py-20 sm:px-8 lg:grid-cols-[0.65fr_1.35fr] lg:px-12"
        >
            <div>
                <p
                    class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
                >
                    {{ props.copy.eyebrow }}
                </p>
                <h2
                    id="education-heading"
                    class="mt-4 text-3xl font-semibold tracking-[-0.03em]"
                >
                    {{ props.copy.heading }}
                </h2>
            </div>

            <dl class="border-t border-portfolio-divider">
                <div
                    v-for="item in props.copy.items"
                    :key="item.institution"
                    class="grid gap-2 border-b border-portfolio-divider py-6 sm:grid-cols-[0.55fr_1.15fr_0.4fr] sm:gap-8"
                >
                    <dt class="font-semibold text-portfolio-text">
                        {{ item.institution }}
                    </dt>
                    <dd class="text-portfolio-muted">{{ item.program }}</dd>
                    <dd class="text-sm text-portfolio-gold sm:text-right">
                        {{ item.period }}
                    </dd>
                </div>
            </dl>
        </div>
    </section>
</template>
