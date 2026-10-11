<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PartnerEcosystemSection from '@/Components/PartnerEcosystemSection.vue';
import { useLocale } from '@/composables/useLocale';
import { Handshake, ShieldCheck, ArrowRight, ArrowLeft } from 'lucide-vue-next';

const { isAr } = useLocale();
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'شركاء السفر والمصادر - InfoTravel' : 'Travel Partners & Resources - InfoTravel'" />

        <!-- Header -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold border border-blue-500/30">
                        <Handshake class="w-3.5 h-3.5" />
                        {{ isAr ? 'منظومة الشركاء والمصادر الرسمية' : 'AIRLINES & TRAVEL RESOURCES' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
                        {{ isAr ? 'شبكة متكاملة تجمع كبار الناقلين وهيئات السياحة' : 'Ecosystem of Trusted National Gateways' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium leading-relaxed">
                        {{ isAr 
                            ? 'نربطك مباشرة بالبوابات الرسمية للخطوط السعودية، طيران الرياض، منصة المطار، روح السعودية، وبوابة التأشيرة الإلكترونية.' 
                            : 'Direct access to national aviation giants, leading Saudi OTA platforms, official tourism portals, and eVisa issuance.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Partner Ecosystem Section Component -->
        <PartnerEcosystemSection />

        <!-- Architecture & Extensibility Banner -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="bg-blue-50/70 border border-blue-200/80 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-2 max-w-2xl">
                    <h3 class="text-lg font-black text-slate-900">
                        {{ isAr ? 'هل أنت شركة طيران أو جهة سياحية ترغب في الانضمام؟' : 'Are you an airline, hotel chain, or tourism provider?' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ isAr 
                            ? 'صممت معمارية أجنحة السعودية لتكون قابلة للتكامل والتوسع السريع مع بروتوكولات NDC وأنظمة حجز الفنادق العالمية عبر واجهات API حديثة.' 
                            : 'SaudiWings architecture is built for rapid extensibility with IATA NDC flight APIs, GDS distribution, and luxury hospitality channels.' }}
                    </p>
                </div>

                <Link
                    href="/about"
                    class="shrink-0 px-6 py-3 rounded-full bg-[#0D1527] hover:bg-[#1E6BFF] text-white text-xs font-bold transition-all shadow-md"
                >
                    {{ isAr ? 'تواصل مع فريق التطوير' : 'Partner Inquiries' }}
                </Link>
            </div>
        </section>
    </AppLayout>
</template>
