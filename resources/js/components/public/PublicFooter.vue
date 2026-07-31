<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import type { PortfolioCopy } from '@/lib/portfolio-translations';
import { login } from '@/routes';

const props = defineProps<{
    copy: PortfolioCopy['footer'];
}>();

const currentYear = new Date().getFullYear();
</script>

<template>
    <footer class="border-t border-portfolio-divider">
        <div
            class="mx-auto flex max-w-7xl flex-col gap-7 px-5 py-10 text-sm text-portfolio-muted sm:px-8 md:flex-row md:items-center md:justify-between lg:px-12"
        >
            <div>
                <p class="font-medium text-portfolio-text">
                    Mateo Quintero Zapata
                </p>
                <p class="mt-1">
                    © {{ currentYear }} · {{ props.copy.builtWith }}
                </p>
            </div>

            <nav :aria-label="props.copy.navigationLabel">
                <ul class="flex flex-wrap items-center gap-5">
                    <li>
                        <a
                            href="https://github.com/mateo1761"
                            target="_blank"
                            rel="noreferrer"
                            class="inline-flex items-center gap-2 outline-none hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        >
                            GitHub
                            <span class="sr-only">
                                ({{ props.copy.newTabLabel }})
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="https://www.linkedin.com/in/mateo-quintero-zapata-114235204"
                            target="_blank"
                            rel="noreferrer"
                            class="inline-flex items-center gap-2 outline-none hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        >
                            LinkedIn
                            <span class="sr-only">
                                ({{ props.copy.newTabLabel }})
                            </span>
                        </a>
                    </li>
                    <li>
                        <Link
                            :href="login()"
                            class="text-xs outline-none hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        >
                            {{ props.copy.administrationLabel }}
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </footer>
</template>
