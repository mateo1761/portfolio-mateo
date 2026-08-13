<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, ShieldCheck } from '@lucide/vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="relative min-h-svh overflow-hidden bg-portfolio-background text-portfolio-text"
    >
        <div
            aria-hidden="true"
            class="pointer-events-none absolute -top-48 -right-40 size-96 rounded-full bg-portfolio-gold/10 blur-3xl"
        />
        <div
            aria-hidden="true"
            class="pointer-events-none absolute -bottom-48 -left-40 size-96 rounded-full bg-sky-900/20 blur-3xl"
        />

        <main class="relative mx-auto min-h-svh w-full max-w-7xl">
            <section class="flex min-h-svh flex-col px-5 py-6 sm:px-10 lg:p-12">
                <div class="flex items-center justify-between gap-4">
                    <Link
                        :href="home()"
                        class="inline-flex items-center gap-2 text-sm font-medium text-portfolio-muted transition-colors hover:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold focus-visible:outline-none"
                    >
                        <ArrowLeft class="size-4" aria-hidden="true" />
                        Back to portfolio
                    </Link>

                    <div
                        class="flex items-center gap-2 text-xs font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
                    >
                        <ShieldCheck class="size-4" aria-hidden="true" />
                        Secure access
                    </div>
                </div>

                <div class="flex flex-1 items-center justify-center py-10">
                    <div class="w-full max-w-md">
                        <div class="mb-9 grid gap-4">
                            <div
                                class="flex size-12 items-center justify-center rounded-xl border border-portfolio-gold/30 bg-portfolio-gold/10 text-portfolio-gold"
                            >
                                <ShieldCheck
                                    class="size-6"
                                    aria-hidden="true"
                                />
                            </div>
                            <div class="grid gap-2">
                                <p
                                    class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
                                >
                                    Portafolio
                                </p>
                                <h1
                                    v-if="title"
                                    class="text-3xl font-semibold tracking-[-0.03em] text-portfolio-text sm:text-4xl"
                                >
                                    {{ title }}
                                </h1>
                                <p
                                    v-if="description"
                                    class="max-w-sm text-sm leading-6 text-portfolio-muted"
                                >
                                    {{ description }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="rounded-2xl border border-portfolio-divider bg-portfolio-surface/80 p-6 shadow-2xl shadow-black/20 backdrop-blur sm:p-8"
                        >
                            <slot />
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
