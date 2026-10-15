<script setup>
import { onMounted } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import FloatingAiWidget from '@/Components/FloatingAiWidget.vue';
import { useLocale } from '@/composables/useLocale';

const { dir, locale } = useLocale();

onMounted(() => {
    document.documentElement.setAttribute('dir', dir.value);
    document.documentElement.setAttribute('lang', locale.value);
    if (typeof window !== 'undefined') {
        window.scrollTo(0, 0);
    }
});
</script>

<template>
    <div :dir="dir" class="min-h-screen flex flex-col bg-[#F8FAFC] text-slate-900 font-sans selection:bg-[#FAB515] selection:text-[#1B316E] transition-colors duration-200 relative">
        <Navbar />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />

        <!-- Fixed Persistent AI Assistant Floating Circle (No WhatsApp) -->
        <FloatingAiWidget />
    </div>
</template>
