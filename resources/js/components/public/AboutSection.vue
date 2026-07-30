<script setup lang="ts">
const technologyGroups = [
    'PHP · Laravel · Vue.js',
    'Node.js · Python',
    'PostgreSQL · SQL Server · MySQL',
    'Docker · AWS',
    'APIs REST · SOAP',
] as const;
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
                Sobre mí
            </p>
            <h2
                id="about-heading"
                class="mt-5 max-w-lg text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
            >
                Experiencia técnica con comprensión del negocio.
            </h2>
        </div>

        <div class="lg:pt-9">
            <p class="max-w-2xl text-lg leading-8 text-portfolio-muted">
                He participado en el desarrollo de aplicaciones empresariales,
                automatización de procesos e integración de plataformas. Mi
                principal fortaleza está en Laravel y Vue.js, complementada con
                Node.js, Python, Docker y bases de datos relacionales.
            </p>

            <ul
                class="mt-10 divide-y divide-portfolio-divider border-y border-portfolio-divider"
                aria-label="Tecnologías principales y complementarias"
            >
                <li
                    v-for="group in technologyGroups"
                    :key="group"
                    class="py-4 text-base font-medium text-portfolio-text"
                >
                    {{ group }}
                </li>
            </ul>
        </div>
    </section>
</template>
