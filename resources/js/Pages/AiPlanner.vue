<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import AiAssistantSection from '@/Components/AiAssistantSection.vue';
import { useLocale } from '@/composables/useLocale';
import { Sparkles, Bot, ShieldCheck, Cpu, Code2 } from 'lucide-vue-next';

const { isAr } = useLocale();
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'مساعد السفر الذكي - أجنحة السعودية' : 'AI Trip Planner - SaudiWings'" />

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
                            ? 'نموذج محاكاة ذكي يعتمد على بنية خدمية متطورة في Laravel مهيأة للتكامل مع OpenAI لإنشاء مسارات يومية دقيقة تناسب ميزانيتك وذوقك.' 
                            : 'An intelligent planning engine designed with a clean Laravel service abstraction, ready for future OpenAI production integration.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Interactive AI Section -->
        <div class="py-6">
            <AiAssistantSection />
        </div>

        <!-- Technical Architecture Card (Requirement 7) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="bg-white rounded-3xl p-8 card-soft-shadow border border-slate-100 space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#1E6BFF] flex items-center justify-center">
                        <Cpu class="w-5 h-5" />
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-black text-slate-900">
                            {{ isAr ? 'معمارية الذكاء الاصطناعي وجاهزية OpenAI' : 'OpenAI-Ready Backend Architecture' }}
                        </h3>
                        <span class="text-xs text-slate-400">{{ isAr ? 'فصل منطق العرض عن الخدمة وحماية مفاتيح API' : 'Strict Separation of Concerns & Security' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-slate-600">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                        <span class="font-bold text-slate-900 block flex items-center gap-1.5">
                            <Code2 class="w-4 h-4 text-[#1E6BFF]" />
                            1. Service Abstraction
                        </span>
                        <p class="leading-relaxed">
                            {{ isAr 
                                ? 'يتم الاعتماد على `AiTravelPlannerInterface` في Laravel، مما يتيح التبديل الفوري بين الخدمة التجريبية وخدمة OpenAI المباشرة.' 
                                : 'Built upon `AiTravelPlannerInterface`, enabling seamless runtime switching between mock responses and live OpenAI calls.' }}
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                        <span class="font-bold text-slate-900 block flex items-center gap-1.5">
                            <ShieldCheck class="w-4 h-4 text-emerald-600" />
                            2. Zero Secret Leaks
                        </span>
                        <p class="leading-relaxed">
                            {{ isAr 
                                ? 'مفاتيح API لا يتم تضمينها نهائياً في كود Vue.js أو الواجهات الأمامية، وتتم إدارة الاستدعاءات حصرياً عبر خادم Laravel الخلفي.' 
                                : 'API credentials are never exposed to Vue 3 clientside code. All calls are routed securely through Laravel endpoints.' }}
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                        <span class="font-bold text-slate-900 block flex items-center gap-1.5">
                            <Sparkles class="w-4 h-4 text-amber-500" />
                            3. Phase 1 Reliability
                        </span>
                        <p class="leading-relaxed">
                            {{ isAr 
                                ? 'البيانات المعروضة حالياً تعتمد على ردود محلية غنية ومحسوبة بدقة لضمان استقرار العرض التقديمي 100% وبدون تأخير.' 
                                : 'Phase One delivers zero-latency localized Saudi travel data with guaranteed reliability during investor and stakeholder demos.' }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
