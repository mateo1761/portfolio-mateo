<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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

defineProps<{
    seo: {
        title: string;
        description: string;
    };
}>();
</script>

<template>
    <Head :title="seo.title">
        <meta
            head-key="description"
            name="description"
            :content="seo.description"
        />
        <meta head-key="og:type" property="og:type" content="website" />
        <meta head-key="og:title" property="og:title" :content="seo.title" />
        <meta
            head-key="og:description"
            property="og:description"
            :content="seo.description"
        />
        <meta head-key="og:locale" property="og:locale" content="es_CO" />
    </Head>

    <div
        class="min-h-screen bg-portfolio-background text-portfolio-text selection:bg-portfolio-gold selection:text-portfolio-background"
    >
        <a
            href="#contenido"
            class="fixed top-3 left-3 z-50 -translate-y-20 bg-portfolio-gold px-4 py-2 font-semibold text-portfolio-background transition-transform focus:translate-y-0 focus:outline-none"
        >
            Saltar al contenido
        </a>

        <PublicHeader />

        <main id="contenido">
            <HeroSection />
            <AchievementsStrip />
            <AboutSection />
            <ExperienceSection />
            <ProjectsSection />
            <EducationSection />
            <ContactSection />
        </main>

        <PublicFooter />

        <Toaster theme="dark" position="top-right" rich-colors close-button />
    </div>
</template>
