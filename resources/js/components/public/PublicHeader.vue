<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Menu, X } from '@lucide/vue';
import { onMounted, onUnmounted, ref } from 'vue';
import type {
    PortfolioCopy,
    PortfolioLocale,
} from '@/lib/portfolio-translations';
import { home } from '@/routes';
import { en as englishHome } from '@/routes/home';

const props = defineProps<{
    locale: PortfolioLocale;
    copy: PortfolioCopy['header'];
}>();

const navigation = [
    { key: 'about', href: '#sobre-mi' },
    { key: 'experience', href: '#experiencia' },
    { key: 'projects', href: '#proyectos' },
    { key: 'contact', href: '#contacto' },
] as const;

const mobileMenuOpen = ref(false);
const mobileMenuButton = ref<HTMLButtonElement | null>(null);

function closeMobileMenu(): void {
    mobileMenuOpen.value = false;
}

function handleKeydown(event: KeyboardEvent): void {
    if (event.key !== 'Escape' || !mobileMenuOpen.value) {
        return;
    }

    closeMobileMenu();
    mobileMenuButton.value?.focus();
}

onMounted(() => {
    document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    document.removeEventListener('keydown', handleKeydown);
});
</script>

<template>
    <header
        class="sticky top-0 z-40 border-b border-portfolio-divider bg-portfolio-background"
    >
        <div
            class="mx-auto flex min-h-20 max-w-7xl items-center justify-between gap-6 px-5 sm:px-8 lg:px-12"
        >
            <a
                href="#contenido"
                class="font-mono text-sm font-semibold tracking-tight text-portfolio-text outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background"
                :aria-label="props.copy.homeLabel"
                @click="closeMobileMenu"
            >
                <span aria-hidden="true" class="text-portfolio-gold">&lt;</span>
                Mateo Quintero Zapata
                <span aria-hidden="true" class="text-portfolio-gold">
                    /&gt;
                </span>
            </a>

            <nav
                :aria-label="props.copy.navigationLabel"
                class="hidden lg:block"
            >
                <ul class="flex items-center gap-6 xl:gap-8">
                    <li v-for="item in navigation" :key="item.href">
                        <a
                            :href="item.href"
                            class="text-sm text-portfolio-muted transition-colors hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background focus-visible:outline-none motion-reduce:transition-none"
                        >
                            {{ props.copy.navigation[item.key] }}
                        </a>
                    </li>
                    <li
                        class="flex items-center gap-2 border-l border-portfolio-divider pl-6"
                        :aria-label="props.copy.languageLabel"
                    >
                        <Link
                            :href="home()"
                            preserve-scroll
                            hreflang="es"
                            lang="es"
                            class="text-sm outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                            :class="
                                props.locale === 'es'
                                    ? 'font-semibold text-portfolio-gold'
                                    : 'text-portfolio-muted hover:text-portfolio-text'
                            "
                            :aria-current="
                                props.locale === 'es' ? 'page' : undefined
                            "
                        >
                            ES
                        </Link>
                        <span class="text-portfolio-divider" aria-hidden="true">
                            /
                        </span>
                        <Link
                            :href="englishHome()"
                            preserve-scroll
                            hreflang="en"
                            lang="en"
                            class="text-sm outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                            :class="
                                props.locale === 'en'
                                    ? 'font-semibold text-portfolio-gold'
                                    : 'text-portfolio-muted hover:text-portfolio-text'
                            "
                            :aria-current="
                                props.locale === 'en' ? 'page' : undefined
                            "
                        >
                            EN
                        </Link>
                    </li>
                </ul>
            </nav>

            <button
                ref="mobileMenuButton"
                type="button"
                class="inline-flex size-11 items-center justify-center text-portfolio-text outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold lg:hidden"
                :aria-expanded="mobileMenuOpen"
                aria-controls="mobile-navigation"
                :aria-label="
                    mobileMenuOpen
                        ? props.copy.closeMenuLabel
                        : props.copy.menuLabel
                "
                @click="mobileMenuOpen = !mobileMenuOpen"
            >
                <X v-if="mobileMenuOpen" class="size-5" aria-hidden="true" />
                <Menu v-else class="size-5" aria-hidden="true" />
            </button>
        </div>

        <nav
            v-if="mobileMenuOpen"
            id="mobile-navigation"
            :aria-label="props.copy.mobileNavigationLabel"
            class="border-t border-portfolio-divider px-5 py-5 lg:hidden"
        >
            <ul class="mx-auto grid max-w-7xl grid-cols-2 gap-x-6 gap-y-4">
                <li v-for="item in navigation" :key="item.href">
                    <a
                        :href="item.href"
                        class="block py-1 text-sm text-portfolio-muted outline-none hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        @click="closeMobileMenu"
                    >
                        {{ props.copy.navigation[item.key] }}
                    </a>
                </li>
                <li
                    class="col-span-2 flex items-center gap-3 border-t border-portfolio-divider pt-4"
                    :aria-label="props.copy.languageLabel"
                >
                    <Link
                        :href="home()"
                        preserve-scroll
                        hreflang="es"
                        lang="es"
                        class="min-h-11 px-2 py-3 text-sm outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        :class="
                            props.locale === 'es'
                                ? 'font-semibold text-portfolio-gold'
                                : 'text-portfolio-muted'
                        "
                        :aria-current="
                            props.locale === 'es' ? 'page' : undefined
                        "
                        @click="closeMobileMenu"
                    >
                        ES
                    </Link>
                    <span class="text-portfolio-divider" aria-hidden="true">
                        /
                    </span>
                    <Link
                        :href="englishHome()"
                        preserve-scroll
                        hreflang="en"
                        lang="en"
                        class="min-h-11 px-2 py-3 text-sm outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        :class="
                            props.locale === 'en'
                                ? 'font-semibold text-portfolio-gold'
                                : 'text-portfolio-muted'
                        "
                        :aria-current="
                            props.locale === 'en' ? 'page' : undefined
                        "
                        @click="closeMobileMenu"
                    >
                        EN
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
</template>
