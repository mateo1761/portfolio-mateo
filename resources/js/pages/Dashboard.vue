<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    BriefcaseBusiness,
    Eye,
    FilePenLine,
    FolderKanban,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import MetricChart from '@/components/dashboard/MetricChart.vue';
import type { MetricPoint } from '@/components/dashboard/MetricChart.vue';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';
import { index as experiencesIndex } from '@/routes/experiences';
import { index as projectsIndex } from '@/routes/projects';

type ContentCount = {
    total: number;
    published: number;
    drafts: number;
};

const props = defineProps<{
    analytics: {
        retentionMonths: number;
        series: MetricPoint[];
        totals: {
            visits: number;
            contactSubmissions: number;
        };
    };
    contentSummary: {
        projects: ContentCount;
        experiences: ContentCount;
    };
}>();

const selectedDays = ref<7 | 30>(30);
const periodOptions = [7, 30] as const;
const visibleMetrics = computed(() =>
    props.analytics.series.slice(-selectedDays.value),
);
const visibleTotals = computed(() => ({
    visits: visibleMetrics.value.reduce((total, point) => total + point.visits, 0),
    contactSubmissions: visibleMetrics.value.reduce(
        (total, point) => total + point.contactSubmissions,
        0,
    ),
}));

const contentSections = [
    {
        title: 'Projects',
        description: 'Bilingual projects displayed in the public portfolio.',
        href: projectsIndex(),
        icon: FolderKanban,
        summary: props.contentSummary.projects,
    },
    {
        title: 'Experience',
        description: 'Professional roles and their publication status.',
        href: experiencesIndex(),
        icon: BriefcaseBusiness,
        summary: props.contentSummary.experiences,
    },
];

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex flex-1 flex-col gap-8 p-5 sm:p-8 lg:p-12">
        <div>
            <p
                class="mb-4 text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                Portfolio administration
            </p>
            <Heading
                title="Dashboard"
                description="Review your portfolio content and continue managing each section."
            />
        </div>

        <section aria-labelledby="content-summary-heading">
            <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2
                        id="content-summary-heading"
                        class="text-xl font-semibold text-portfolio-text"
                    >
                        Content summary
                    </h2>
                    <p class="mt-1 text-sm text-portfolio-muted">
                        Publication status for database-managed sections.
                    </p>
                </div>
                <Badge variant="outline">
                    {{ contentSections.length }} sections
                </Badge>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                <article
                    v-for="section in contentSections"
                    :key="section.title"
                    class="rounded-2xl border border-portfolio-divider bg-portfolio-surface p-5 shadow-lg shadow-black/10 sm:p-6"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div
                            class="flex size-11 shrink-0 items-center justify-center rounded-xl border border-portfolio-gold/30 bg-portfolio-gold/10 text-portfolio-gold"
                        >
                            <component
                                :is="section.icon"
                                class="size-5"
                                aria-hidden="true"
                            />
                        </div>
                        <Badge
                            :variant="
                                section.summary.drafts > 0
                                    ? 'secondary'
                                    : 'default'
                            "
                        >
                            {{
                                section.summary.drafts > 0
                                    ? `${section.summary.drafts} draft${section.summary.drafts === 1 ? '' : 's'}`
                                    : 'Up to date'
                            }}
                        </Badge>
                    </div>

                    <div class="mt-5">
                        <h3 class="text-lg font-semibold text-portfolio-text">
                            {{ section.title }}
                        </h3>
                        <p class="mt-1 text-sm text-portfolio-muted">
                            {{ section.description }}
                        </p>
                    </div>

                    <dl class="mt-6 grid grid-cols-3 gap-3">
                        <div class="rounded-xl bg-portfolio-navy/45 p-3">
                            <dt class="text-xs text-portfolio-muted">Total</dt>
                            <dd
                                class="mt-1 text-2xl font-bold text-portfolio-text"
                            >
                                {{ section.summary.total }}
                            </dd>
                        </div>
                        <div class="rounded-xl bg-portfolio-navy/45 p-3">
                            <dt
                                class="flex items-center gap-1 text-xs text-portfolio-muted"
                            >
                                <Eye class="size-3.5" aria-hidden="true" />
                                Published
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-bold text-portfolio-text"
                            >
                                {{ section.summary.published }}
                            </dd>
                        </div>
                        <div class="rounded-xl bg-portfolio-navy/45 p-3">
                            <dt
                                class="flex items-center gap-1 text-xs text-portfolio-muted"
                            >
                                <FilePenLine
                                    class="size-3.5"
                                    aria-hidden="true"
                                />
                                Drafts
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-bold text-portfolio-text"
                            >
                                {{ section.summary.drafts }}
                            </dd>
                        </div>
                    </dl>

                    <Button
                        variant="outline"
                        class="mt-6 w-full sm:w-auto"
                        as-child
                    >
                        <Link :href="section.href">
                            Manage {{ section.title.toLowerCase() }}
                            <ArrowRight aria-hidden="true" />
                        </Link>
                    </Button>
                </article>
            </div>
        </section>

        <section aria-labelledby="analytics-heading">
            <div class="mb-4 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2
                        id="analytics-heading"
                        class="text-xl font-semibold text-portfolio-text"
                    >
                        Privacy-friendly insights
                    </h2>
                    <p class="mt-1 max-w-3xl text-sm text-portfolio-muted">
                        Anonymous daily counters retained for
                        {{ analytics.retentionMonths }} months. Visits represent
                        page loads, not unique people.
                    </p>
                </div>
                <div
                    class="flex rounded-lg border border-portfolio-divider p-1"
                    aria-label="Analytics period"
                >
                    <button
                        v-for="days in periodOptions"
                        :key="days"
                        type="button"
                        class="rounded-md px-3 py-2 text-sm font-semibold outline-none transition-colors focus-visible:ring-2 focus-visible:ring-portfolio-gold motion-reduce:transition-none"
                        :class="
                            selectedDays === days
                                ? 'bg-portfolio-gold text-portfolio-background'
                                : 'text-portfolio-muted hover:text-portfolio-text'
                        "
                        :aria-pressed="selectedDays === days"
                        @click="selectedDays = days"
                    >
                        {{ days }} days
                    </button>
                </div>
            </div>

            <dl class="mb-5 grid gap-4 sm:grid-cols-2">
                <div
                    class="rounded-xl border border-portfolio-divider bg-portfolio-surface/70 p-4"
                >
                    <dt class="text-sm text-portfolio-muted">
                        Visits in selected period
                    </dt>
                    <dd class="mt-1 text-3xl font-bold text-portfolio-text">
                        {{ visibleTotals.visits }}
                    </dd>
                </div>
                <div
                    class="rounded-xl border border-portfolio-divider bg-portfolio-surface/70 p-4"
                >
                    <dt class="text-sm text-portfolio-muted">
                        Successful form submissions
                    </dt>
                    <dd class="mt-1 text-3xl font-bold text-portfolio-text">
                        {{ visibleTotals.contactSubmissions }}
                    </dd>
                </div>
            </dl>

            <div class="grid gap-5 xl:grid-cols-2">
                <MetricChart
                    title="Portfolio visits"
                    description="Daily page loads across the Spanish and English portfolio routes."
                    :points="visibleMetrics"
                    metric="visits"
                    kind="line"
                />
                <MetricChart
                    title="Contact submissions"
                    description="Messages counted only after the email is sent successfully."
                    :points="visibleMetrics"
                    metric="contactSubmissions"
                    kind="bar"
                />
            </div>
        </section>
    </div>
</template>
