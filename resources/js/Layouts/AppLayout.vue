<script setup>
import { onMounted } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import { useLocale } from '@/composables/useLocale';

const { dir, locale } = useLocale();

onMounted(() => {
    document.documentElement.setAttribute('dir', dir.value);
    document.documentElement.setAttribute('lang', locale.value);
});
</script>

<template>
    <div :dir="dir" class="min-h-screen flex flex-col bg-[#F8FAFC] text-slate-900 font-sans selection:bg-[#1E6BFF] selection:text-white transition-colors duration-200">
        <Navbar />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
    </div>
</template>
