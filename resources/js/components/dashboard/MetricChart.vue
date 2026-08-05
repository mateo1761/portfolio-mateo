<script setup lang="ts">
import { computed } from 'vue';

export type MetricPoint = {
    date: string;
    label: string;
    visits: number;
    contactSubmissions: number;
};

const props = defineProps<{
    title: string;
    description: string;
    points: MetricPoint[];
    metric: 'visits' | 'contactSubmissions';
    kind: 'line' | 'bar';
}>();

const width = 600;
const height = 220;
const chartTop = 20;
const chartBottom = 180;
const chartHeight = chartBottom - chartTop;

const maximum = computed(() =>
    Math.max(1, ...props.points.map((point) => point[props.metric])),
);
const horizontalStep = computed(() =>
    props.points.length > 1 ? width / (props.points.length - 1) : width,
);
const yPosition = (value: number): number =>
    chartBottom - (value / maximum.value) * chartHeight;
const linePoints = computed(() =>
    props.points
        .map(
            (point, index) =>
                `${index * horizontalStep.value},${yPosition(point[props.metric])}`,
        )
        .join(' '),
);
const barWidth = computed(() =>
    Math.max(4, Math.min(24, width / Math.max(props.points.length, 1) - 4)),
);
const labelIndexes = computed(() => {
    if (props.points.length < 3) {
        return props.points.map((_, index) => index);
    }

    return [
        0,
        Math.floor((props.points.length - 1) / 2),
        props.points.length - 1,
    ];
});
</script>

<template>
    <article
        class="rounded-2xl border border-portfolio-divider bg-portfolio-surface p-5 shadow-lg shadow-black/10 sm:p-6"
    >
        <h3 class="text-lg font-semibold text-portfolio-text">{{ title }}</h3>
        <p class="mt-1 text-sm text-portfolio-muted">{{ description }}</p>

        <div class="mt-6 overflow-hidden">
            <svg
                :viewBox="`0 0 ${width} ${height}`"
                class="h-auto w-full overflow-visible"
                role="img"
                :aria-label="`${title}. ${description}`"
            >
                <line
                    x1="0"
                    :y1="chartBottom"
                    :x2="width"
                    :y2="chartBottom"
                    class="stroke-portfolio-divider"
                />
                <line
                    x1="0"
                    :y1="chartTop + chartHeight / 2"
                    :x2="width"
                    :y2="chartTop + chartHeight / 2"
                    class="stroke-portfolio-divider/60"
                    stroke-dasharray="5 7"
                />

                <template v-if="kind === 'bar'">
                    <rect
                        v-for="(point, index) in points"
                        :key="point.date"
                        :x="index * horizontalStep - barWidth / 2"
                        :y="yPosition(point[metric])"
                        :width="barWidth"
                        :height="chartBottom - yPosition(point[metric])"
                        rx="3"
                        class="fill-portfolio-gold"
                    >
                        <title>{{ point.label }}: {{ point[metric] }}</title>
                    </rect>
                </template>
                <template v-else>
                    <polyline
                        :points="linePoints"
                        fill="none"
                        class="stroke-portfolio-gold"
                        stroke-width="4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <circle
                        v-for="(point, index) in points"
                        :key="point.date"
                        :cx="index * horizontalStep"
                        :cy="yPosition(point[metric])"
                        r="4"
                        class="fill-portfolio-background stroke-portfolio-gold"
                        stroke-width="3"
                    >
                        <title>{{ point.label }}: {{ point[metric] }}</title>
                    </circle>
                </template>

                <text
                    v-for="index in labelIndexes"
                    :key="points[index]?.date"
                    :x="index * horizontalStep"
                    y="210"
                    :text-anchor="
                        index === 0
                            ? 'start'
                            : index === points.length - 1
                              ? 'end'
                              : 'middle'
                    "
                    class="fill-portfolio-muted text-[12px]"
                >
                    {{ points[index]?.label }}
                </text>
            </svg>
        </div>
    </article>
</template>
