<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 48 48"
        :class="className"
        v-bind="$attrs"
    >
        <path
            fill="currentColor"
            d="M8 10h7.25L24 24.25 32.75 10H40v28h-6V19.5L24 35 14 19.5V38H8V10Z"
        />
    </svg>
</template>
