<script setup lang="ts">
import adminAvatar from '@/../images/foto-perfil.jpg';
</script>

<template>
    <img
        :src="adminAvatar"
        alt="Mateo Quintero Zapata"
        class="aspect-square size-9 rounded-md border border-portfolio-gold/40 object-cover"
    />
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="truncate leading-tight font-semibold text-portfolio-text">
            Portafolio
        </span>
        <span class="truncate text-xs text-portfolio-muted">
            Administration
        </span>
    </div>
</template>
