<script setup lang="ts">
import { ArrowDown, MapPin } from '@lucide/vue';
import mateoPortrait from '@/../images/mateo-quintero.webp';
import type { PortfolioCopy } from '@/lib/portfolio-translations';

const props = defineProps<{
    copy: PortfolioCopy['hero'];
}>();
</script>

<template>
    <section
        aria-labelledby="hero-heading"
        class="mx-auto grid max-w-7xl gap-16 px-5 py-20 sm:px-8 sm:py-28 lg:grid-cols-[minmax(0,1.35fr)_minmax(18rem,0.65fr)] lg:items-center lg:px-12 lg:py-36"
    >
        <div>
            <p
                class="mb-7 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                {{ props.copy.eyebrow }}
            </p>

            <h1
                id="hero-heading"
                class="max-w-4xl text-4xl leading-[1.08] font-semibold tracking-[-0.04em] text-balance sm:text-6xl lg:text-7xl"
            >
                {{ props.copy.headline }}
                <span class="text-portfolio-gold">
                    {{ props.copy.headlineHighlight }}
                </span>
            </h1>

            <p
                class="mt-8 max-w-2xl text-lg leading-8 text-portfolio-muted sm:text-xl"
            >
                {{ props.copy.introduction }}
            </p>

            <p
                class="mt-6 flex items-center gap-2 text-sm text-portfolio-muted"
            >
                <MapPin class="size-4 text-portfolio-gold" aria-hidden="true" />
                {{ props.copy.location }}
            </p>

            <div class="mt-10 flex flex-wrap items-center gap-4">
                <a
                    href="#proyectos"
                    class="inline-flex min-h-12 items-center gap-2 bg-portfolio-gold px-6 font-semibold text-portfolio-background transition-colors outline-none hover:bg-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-text focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background motion-reduce:transition-none"
                >
                    {{ props.copy.viewProjects }}
                    <ArrowDown class="size-4" aria-hidden="true" />
                </a>

                <a
                    href="/documents/Hoja_de_vida_Mateo_Quintero_2026.pdf"
                    download="Hoja-de-vida-Mateo-Quintero.pdf"
                    :aria-label="props.copy.downloadCvLabel"
                    class="inline-flex min-h-12 items-center border border-portfolio-divider px-6 font-medium text-portfolio-text transition-colors outline-none hover:border-portfolio-gold hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                >
                    {{ props.copy.downloadCv }}
                </a>

                <a
                    href="https://www.linkedin.com/in/mateo-quintero-zapata-114235204"
                    target="_blank"
                    rel="noreferrer"
                    class="inline-flex min-h-12 items-center gap-2 px-2 font-medium text-portfolio-text transition-colors outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                >
                    LinkedIn
                    <span class="sr-only">
                        ({{ props.copy.linkedInNewTab }})
                    </span>
                </a>
            </div>
        </div>

        <div class="flex justify-center lg:justify-end">
            <img
                :src="mateoPortrait"
                :alt="props.copy.portraitAlt"
                width="800"
                height="800"
                loading="eager"
                fetchpriority="high"
                decoding="async"
                class="aspect-square w-full max-w-80 rounded-full border border-portfolio-divider bg-portfolio-surface object-cover"
            />
        </div>
    </section>
</template>
