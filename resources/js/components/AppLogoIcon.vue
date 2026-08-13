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
        viewBox="0 0 64 64"
        :class="className"
        v-bind="$attrs"
    >
        <rect
            x="3"
            y="3"
            width="58"
            height="58"
            rx="15"
            fill="#09111a"
            stroke="#c39a3c"
            stroke-width="3"
        />
        <path
            d="M16 44V20l16 17 16-17v24"
            fill="none"
            stroke="#c39a3c"
            stroke-width="6"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
    </svg>
</template>
