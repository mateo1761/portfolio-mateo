<script setup lang="ts">
import { ArrowDown, MapPin } from '@lucide/vue';
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
                Desarrollador Full Stack Mid-Senior
            </p>

            <h1
                id="hero-heading"
                class="max-w-4xl text-4xl leading-[1.08] font-semibold tracking-[-0.04em] text-balance sm:text-6xl lg:text-7xl"
            >
                Construyo soluciones web que mejoran
                <span class="text-portfolio-gold">procesos reales.</span>
            </h1>

            <p
                class="mt-8 max-w-2xl text-lg leading-8 text-portfolio-muted sm:text-xl"
            >
                Soy Mateo, desarrollador especializado en PHP, Laravel,
                JavaScript y Vue.js. Transformo necesidades de negocio en
                aplicaciones mantenibles, integraciones y automatizaciones.
            </p>

            <p
                class="mt-6 flex items-center gap-2 text-sm text-portfolio-muted"
            >
                <MapPin class="size-4 text-portfolio-gold" aria-hidden="true" />
                Sabaneta, Antioquia, Colombia
            </p>

            <div class="mt-10 flex flex-wrap items-center gap-4">
                <a
                    href="#proyectos"
                    class="inline-flex min-h-12 items-center gap-2 bg-portfolio-gold px-6 font-semibold text-portfolio-background transition-colors outline-none hover:bg-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-text focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background motion-reduce:transition-none"
                >
                    Ver proyectos
                    <ArrowDown class="size-4" aria-hidden="true" />
                </a>

                <span
                    class="inline-flex min-h-12 cursor-not-allowed items-center border border-portfolio-divider px-6 font-medium text-portfolio-muted opacity-70"
                    aria-disabled="true"
                    title="El archivo público del CV está pendiente"
                >
                    Descargar CV
                </span>

                <a
                    href="https://www.linkedin.com/in/mateo-quintero-zapata-114235204"
                    target="_blank"
                    rel="noreferrer"
                    class="inline-flex min-h-12 items-center gap-2 px-2 font-medium text-portfolio-text transition-colors outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                >
                    LinkedIn
                    <span class="sr-only">(abre en una pestaña nueva)</span>
                </a>
            </div>
        </div>

        <div class="flex justify-center lg:justify-end">
            <div
                class="relative flex aspect-square w-full max-w-80 items-center justify-center rounded-full border border-portfolio-divider bg-portfolio-surface"
                role="img"
                aria-label="Monograma MQ; fotografía profesional pendiente"
            >
                <span
                    class="font-mono text-7xl font-semibold tracking-[-0.08em] text-portfolio-gold sm:text-8xl"
                    aria-hidden="true"
                >
                    MQ
                </span>
                <span
                    class="absolute right-8 bottom-8 size-3 rounded-full bg-portfolio-gold"
                    aria-hidden="true"
                />
            </div>
        </div>
    </section>
</template>
