<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
</script>

<template>
    <div
        class="flex aspect-square size-9 items-center justify-center rounded-md border border-portfolio-gold/40 bg-portfolio-gold/10 text-portfolio-gold"
    >
        <AppLogoIcon class="size-6" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="truncate leading-tight font-semibold text-portfolio-text">
            Portfolio Mateo
        </span>
        <span class="truncate text-xs text-portfolio-muted">
            Administration
        </span>
    </div>
</template>
