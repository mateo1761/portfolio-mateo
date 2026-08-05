<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { SidebarProvider } from '@/components/ui/sidebar';
import type { AppVariant } from '@/types';

type Props = {
    variant?: AppVariant;
};

withDefaults(defineProps<Props>(), {
    variant: 'sidebar',
});

const isOpen = usePage().props.sidebarOpen;
</script>

<template>
    <div v-if="variant === 'header'" class="flex min-h-screen w-full flex-col">
        <slot />
    </div>
    <SidebarProvider
        v-else
        :default-open="isOpen"
        class="bg-portfolio-background text-portfolio-text [--accent-foreground:var(--portfolio-text)] [--accent:var(--portfolio-surface)] [--background:var(--portfolio-background)] [--border:var(--portfolio-divider)] [--card-foreground:var(--portfolio-text)] [--card:var(--portfolio-surface)] [--foreground:var(--portfolio-text)] [--input:var(--portfolio-divider)] [--muted-foreground:var(--portfolio-muted)] [--muted:var(--portfolio-surface)] [--primary-foreground:var(--portfolio-background)] [--primary:var(--portfolio-gold)] [--ring:var(--portfolio-gold)] [--secondary-foreground:var(--portfolio-text)] [--secondary:var(--portfolio-surface)] [--sidebar-accent-foreground:var(--portfolio-text)] [--sidebar-accent:var(--portfolio-surface)] [--sidebar-background:#0a131d] [--sidebar-border:var(--portfolio-divider)] [--sidebar-foreground:var(--portfolio-text)] [--sidebar-primary-foreground:var(--portfolio-background)] [--sidebar-primary:var(--portfolio-gold)] [--sidebar-ring:var(--portfolio-gold)]"
    >
        <slot />
    </SidebarProvider>
</template>
