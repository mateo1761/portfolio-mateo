<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicFooter from '@/components/public/PublicFooter.vue';
import { portfolioCopy } from '@/lib/portfolio-translations';
import type { PortfolioLocale } from '@/lib/portfolio-translations';
import { termsAndConditionsCopy } from '@/lib/terms-and-conditions-translations';
import { home, terms } from '@/routes';
import { en as homeEn } from '@/routes/home';
import { en as termsEn } from '@/routes/terms';

const props = defineProps<{
    locale: PortfolioLocale;
    seo: {
        title: string;
        description: string;
    };
}>();

const copy = computed(() => termsAndConditionsCopy[props.locale]);
const portfolioUrl = computed(() =>
    props.locale === 'es' ? home() : homeEn(),
);
const alternateTermsUrl = computed(() =>
    props.locale === 'es' ? termsEn() : terms(),
);
const canonicalUrl = computed(() =>
    props.locale === 'es' ? terms.url() : termsEn.url(),
);
</script>

<template>
    <Head :title="props.seo.title">
        <meta
            head-key="description"
            name="description"
            :content="props.seo.description"
        />
        <link head-key="canonical" rel="canonical" :href="canonicalUrl" />
        <link
            head-key="alternate-es"
            rel="alternate"
            hreflang="es-CO"
            :href="terms.url()"
        />
        <link
            head-key="alternate-en"
            rel="alternate"
            hreflang="en-US"
            :href="termsEn.url()"
        />
        <link
            head-key="alternate-default"
            rel="alternate"
            hreflang="x-default"
            :href="terms.url()"
        />
    </Head>

    <div
        class="min-h-screen bg-portfolio-background text-portfolio-text selection:bg-portfolio-gold selection:text-portfolio-background"
    >
        <a
            href="#contenido"
            class="fixed top-3 left-3 z-50 -translate-y-20 bg-portfolio-gold px-4 py-2 font-semibold text-portfolio-background transition-transform focus:translate-y-0 focus:outline-none"
        >
            {{ copy.skipToContent }}
        </a>

        <header class="border-b border-portfolio-divider">
            <div
                class="mx-auto flex max-w-4xl flex-wrap items-center justify-between gap-4 px-5 py-6 sm:px-8"
            >
                <Link
                    :href="portfolioUrl"
                    class="font-semibold outline-none hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                >
                    ← {{ copy.backToPortfolio }}
                </Link>

                <Link
                    :href="alternateTermsUrl"
                    :aria-label="copy.languageLabel"
                    class="border border-portfolio-divider px-4 py-2 text-sm font-semibold outline-none hover:border-portfolio-gold hover:text-portfolio-gold focus-visible:ring-2 focus-visible:ring-portfolio-gold"
                >
                    {{ copy.alternateLanguage }}
                </Link>
            </div>
        </header>

        <main
            id="contenido"
            class="mx-auto max-w-4xl px-5 py-16 sm:px-8 sm:py-24"
        >
            <p
                class="text-sm font-semibold tracking-[0.16em] text-portfolio-gold uppercase"
            >
                {{ copy.eyebrow }}
            </p>
            <h1
                class="mt-4 text-4xl leading-tight font-semibold tracking-[-0.03em] text-balance sm:text-6xl"
            >
                {{ copy.title }}
            </h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-portfolio-muted">
                {{ copy.introduction }}
            </p>
            <p class="mt-6 text-sm text-portfolio-muted">
                {{ copy.versionLabel }} 1.0 · {{ copy.effectiveDateLabel }}
                {{ copy.effectiveDate }}
            </p>

            <div class="mt-14 grid gap-12">
                <section
                    v-for="section in copy.sections"
                    :key="section.heading"
                    class="grid gap-4"
                >
                    <h2 class="text-2xl font-semibold text-portfolio-text">
                        {{ section.heading }}
                    </h2>
                    <p
                        v-for="paragraph in section.paragraphs"
                        :key="paragraph"
                        class="leading-7 text-portfolio-muted"
                    >
                        {{ paragraph }}
                    </p>
                    <ul
                        v-if="section.items"
                        class="grid list-disc gap-3 pl-6 leading-7 text-portfolio-muted marker:text-portfolio-gold"
                    >
                        <li v-for="item in section.items" :key="item">
                            {{ item }}
                        </li>
                    </ul>
                </section>
            </div>

            <p
                class="mt-14 border-l-2 border-portfolio-gold pl-5 text-sm leading-6 text-portfolio-muted"
            >
                {{ copy.reviewNotice }}
            </p>
        </main>

        <PublicFooter
            :locale="props.locale"
            :copy="portfolioCopy[props.locale].footer"
        />
    </div>
</template>
