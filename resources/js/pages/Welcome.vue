<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import AboutSection from '@/components/public/AboutSection.vue';
import AchievementsStrip from '@/components/public/AchievementsStrip.vue';
import ContactSection from '@/components/public/ContactSection.vue';
import EducationSection from '@/components/public/EducationSection.vue';
import ExperienceSection from '@/components/public/ExperienceSection.vue';
import HeroSection from '@/components/public/HeroSection.vue';
import ProjectsSection from '@/components/public/ProjectsSection.vue';
import PublicFooter from '@/components/public/PublicFooter.vue';
import PublicHeader from '@/components/public/PublicHeader.vue';
import { Toaster } from '@/components/ui/sonner';
import { portfolioCopy } from '@/lib/portfolio-translations';
import type { PortfolioLocale } from '@/lib/portfolio-translations';

const props = defineProps<{
    locale: PortfolioLocale;
    seo: {
        title: string;
        description: string;
    };
}>();

const copy = computed(() => portfolioCopy[props.locale]);
</script>

<template>
    <Head :title="props.seo.title">
        <meta
            head-key="description"
            name="description"
            :content="props.seo.description"
        />
        <meta head-key="og:type" property="og:type" content="website" />
        <meta
            head-key="og:title"
            property="og:title"
            :content="props.seo.title"
        />
        <meta
            head-key="og:description"
            property="og:description"
            :content="props.seo.description"
        />
        <meta
            head-key="og:locale"
            property="og:locale"
            :content="props.locale === 'es' ? 'es_CO' : 'en_US'"
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

        <PublicHeader :locale="props.locale" :copy="copy.header" />

        <main id="contenido">
            <HeroSection :copy="copy.hero" />
            <AchievementsStrip :copy="copy.achievements" />
            <AboutSection :copy="copy.about" />
            <ExperienceSection :copy="copy.experience" />
            <ProjectsSection :copy="copy.projects" />
            <EducationSection :copy="copy.education" />
            <ContactSection :locale="props.locale" :copy="copy.contact" />
        </main>

        <PublicFooter :locale="props.locale" :copy="copy.footer" />

        <Toaster theme="dark" position="top-right" rich-colors close-button />
    </div>
</template>
