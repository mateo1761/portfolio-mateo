<script setup lang="ts">
const experiences = [
    {
        company: 'CRONOS LOGISTICS',
        role: 'Desarrollador Back-end Python | Desarrollo Full Stack',
        period: 'Feb. 2026 - Actualidad',
        location: 'Medellín, Antioquia - Híbrido',
        summary:
            'Desarrollo de soluciones web y back-end, automatización de procesos de cotización logística, PostgreSQL, Docker y desarrollo asistido por inteligencia artificial.',
    },
    {
        company: 'MANPOWERGROUP',
        role: 'Analista de software',
        period: 'Oct. 2022 - Ene. 2026',
        location: 'Medellín, Antioquia - Híbrido',
        summary:
            'Desarrollo y mantenimiento de aplicaciones empresariales con PHP, Laravel, JavaScript, Vue.js y Node.js; integraciones REST y SOAP; SQL Server, MySQL y soporte productivo.',
    },
    {
        company: 'MANPOWERGROUP',
        role: 'Practicante de desarrollo de software',
        period: 'Mar. 2022 - Sept. 2022',
        location: 'Colombia',
        summary:
            'Desarrollo web con PHP, Laravel y JavaScript, implementación de funcionalidades, solución de incidencias, consultas de datos y colaboración mediante Git.',
    },
] as const;
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
                Experiencia
            </p>
            <h2
                id="experience-heading"
                class="mt-5 max-w-3xl text-3xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-5xl"
            >
                Una trayectoria enfocada en aplicaciones empresariales.
            </h2>

            <ol class="mt-16 border-t border-portfolio-divider">
                <li
                    v-for="experience in experiences"
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
