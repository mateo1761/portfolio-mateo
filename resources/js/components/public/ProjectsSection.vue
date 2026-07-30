<script setup lang="ts">
import { ExternalLink } from '@lucide/vue';

const projects = [
    {
        number: '01',
        category: 'Sistema empresarial · Proyecto privado',
        title: 'Sistema de reportes dinámicos',
        description:
            'Plataforma utilizada por más de 600 usuarios que redujo aproximadamente un 50% el tiempo de generación de informes mediante filtros avanzados y conexiones dinámicas con bases de datos.',
        technologies: 'Laravel · Vue.js · SQL Server · APIs',
        private: true,
    },
    {
        number: '02',
        category: 'Logística · Automatización',
        title: 'Cotización y procesamiento inteligente',
        description:
            'Solución enfocada en transformar necesidades operativas del sector logístico en procesos digitales mantenibles, contenerizados e integrados con datos empresariales.',
        technologies: 'Python · PostgreSQL · Docker · IA aplicada',
        private: true,
    },
    {
        number: '03',
        category: 'Proyecto personal · Código público',
        title: 'Portafolio Mateo',
        description:
            'Portafolio profesional desarrollado con Laravel 13, Vue 3 e Inertia, con PostgreSQL, Docker, Laravel Sail, Nginx, HTTPS local, autenticación TOTP, correo y CI/CD.',
        technologies: 'Laravel 13 · Vue 3 · Inertia · PostgreSQL · Docker',
        private: false,
        url: 'https://github.com/mateo1761/portfolio-mateo',
    },
] as const;
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
            Proyectos
        </p>
        <h2
            id="projects-heading"
            class="mt-5 max-w-3xl text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
        >
            Soluciones donde el código produjo resultados medibles.
        </h2>

        <div class="mt-16 border-t border-portfolio-divider">
            <article
                v-for="project in projects"
                :key="project.number"
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
                        v-if="project.private"
                        class="mt-7 text-sm text-portfolio-muted"
                    >
                        Proyecto profesional privado. Información presentada sin
                        datos confidenciales.
                    </p>
                    <a
                        v-else
                        :href="project.url"
                        target="_blank"
                        rel="noreferrer"
                        class="mt-7 inline-flex w-fit items-center gap-2 font-medium text-portfolio-text transition-colors outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                    >
                        Ver repositorio
                        <ExternalLink class="size-4" aria-hidden="true" />
                        <span class="sr-only">(abre en una pestaña nueva)</span>
                    </a>
                </div>
            </article>
        </div>
    </section>
</template>
