<script setup lang="ts">
import { Menu, X } from '@lucide/vue';
import { onMounted, onUnmounted, ref } from 'vue';

const navigation = [
    { label: 'Sobre mí', href: '#sobre-mi' },
    { label: 'Experiencia', href: '#experiencia' },
    { label: 'Proyectos', href: '#proyectos' },
    { label: 'Contacto', href: '#contacto' },
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
                aria-label="Ir al inicio"
                @click="closeMobileMenu"
            >
                <span aria-hidden="true" class="text-portfolio-gold">&lt;</span>
                Mateo Quintero Zapata
                <span aria-hidden="true" class="text-portfolio-gold">
                    /&gt;
                </span>
            </a>

            <nav aria-label="Navegación principal" class="hidden md:block">
                <ul class="flex items-center gap-8">
                    <li v-for="item in navigation" :key="item.href">
                        <a
                            :href="item.href"
                            class="text-sm text-portfolio-muted transition-colors hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold focus-visible:ring-offset-4 focus-visible:ring-offset-portfolio-background focus-visible:outline-none motion-reduce:transition-none"
                        >
                            {{ item.label }}
                        </a>
                    </li>
                </ul>
            </nav>

            <button
                ref="mobileMenuButton"
                type="button"
                class="inline-flex size-11 items-center justify-center text-portfolio-text outline-none focus-visible:ring-2 focus-visible:ring-portfolio-gold md:hidden"
                :aria-expanded="mobileMenuOpen"
                aria-controls="mobile-navigation"
                aria-label="Alternar menú de navegación"
                @click="mobileMenuOpen = !mobileMenuOpen"
            >
                <X v-if="mobileMenuOpen" class="size-5" aria-hidden="true" />
                <Menu v-else class="size-5" aria-hidden="true" />
            </button>
        </div>

        <nav
            v-if="mobileMenuOpen"
            id="mobile-navigation"
            aria-label="Navegación móvil"
            class="border-t border-portfolio-divider px-5 py-5 md:hidden"
        >
            <ul class="mx-auto grid max-w-7xl grid-cols-2 gap-x-6 gap-y-4">
                <li v-for="item in navigation" :key="item.href">
                    <a
                        :href="item.href"
                        class="block py-1 text-sm text-portfolio-muted outline-none hover:text-portfolio-text focus-visible:text-portfolio-text focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                        @click="closeMobileMenu"
                    >
                        {{ item.label }}
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</template>
