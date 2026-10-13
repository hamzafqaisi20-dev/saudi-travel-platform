<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import AiAssistantSection from '@/Components/AiAssistantSection.vue';
import { useLocale } from '@/composables/useLocale';
import { Bot } from 'lucide-vue-next';

const { isAr } = useLocale();
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'مساعد السفر الذكي - InfoTravel' : 'AI Trip Planner - InfoTravel'" />

        <!-- Header -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold border border-blue-500/30">
                        <Bot class="w-3.5 h-3.5" />
                        {{ isAr ? 'الجيل القادم من تخطيط السفر' : 'NEXT-GEN AI TRAVEL CONCIERGE' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
                        {{ isAr ? 'مساعدك الشخصي لتصميم رحلات استثنائية' : 'Curate Complete Journeys in Seconds' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium leading-relaxed">
                        {{ isAr 
                            ? 'خطط لرحلتك القادمة عبر مساعد السفر الذكي؛ صمم جدول أيامك بحرية واستكشف أرقى الوجهات والأنشطة المناسبة لاهتماماتك وميزانيتك.' 
                            : 'Curate your next journey with our AI travel concierge: customize your daily itinerary, discover top destinations, and travel with ease.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Interactive AI Section -->
        <div class="py-10">
            <AiAssistantSection />
        </div>
    </AppLayout>
</template>
