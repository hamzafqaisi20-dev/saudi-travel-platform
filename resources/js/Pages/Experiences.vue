<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { experiences } from '@/data/mockData';
import { useLocale } from '@/composables/useLocale';
import { Sparkles, Calendar, MapPin, ExternalLink, Ticket, ArrowRight, ArrowLeft } from 'lucide-vue-next';

const { isAr } = useLocale();

const activeModal = ref(null);
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'التجارب والفعاليات - InfoTravel' : 'Experiences & Events - InfoTravel'" />

        <!-- Header -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold border border-blue-500/30">
                        <Sparkles class="w-3.5 h-3.5" />
                        {{ isAr ? 'مواسم وتجارب المملكة الاستثنائية' : 'SAUDI MEGA SEASONS & EXPERIENCES' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
                        {{ isAr ? 'عِش الحماس والترفيه في أكبر مواسم المنطقة' : 'Unmatched Festivals, Heritage & Wonder' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium leading-relaxed">
                        {{ isAr 
                            ? 'اكتشف فعاليات موسم الرياض، وليالي مسرح مرايا في شتاء طنطورة، وتجارب الغوص بين شعاب البحر الأحمر البكر.' 
                            : 'Immerse in globally acclaimed seasons, contemporary art biennials, and private marine adventures across Saudi Arabia.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Events Catalog Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    v-for="exp in experiences"
                    :key="exp.id"
                    class="bg-white rounded-3xl overflow-hidden card-soft-shadow card-hover border border-slate-100 flex flex-col md:flex-row group"
                >
                    <!-- Visual Image -->
                    <div class="md:w-1/2 relative aspect-[4/3] md:aspect-auto overflow-hidden bg-slate-100">
                        <img
                            :src="exp.image"
                            :alt="exp.title.en"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                        <span class="absolute top-3.5 start-3.5 px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-slate-900 shadow-sm">
                            {{ isAr ? exp.tag.ar : exp.tag.en }}
                        </span>
                    </div>

                    <!-- Details -->
                    <div class="p-6 md:w-1/2 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-[#1E6BFF]">
                                <Calendar class="w-3.5 h-3.5" />
                                <span>{{ isAr ? exp.date.ar : exp.date.en }}</span>
                            </div>

                            <h3 class="text-lg font-black text-slate-900 group-hover:text-[#1E6BFF] transition-colors leading-snug">
                                {{ isAr ? exp.title.ar : exp.title.en }}
                            </h3>

                            <div class="flex items-center gap-1 text-xs text-slate-400">
                                <MapPin class="w-3.5 h-3.5 shrink-0" />
                                <span>{{ isAr ? exp.location.ar : exp.location.en }}</span>
                            </div>

                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ isAr ? exp.desc.ar : exp.desc.en }}
                            </p>
                        </div>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between gap-2">
                            <button
                                type="button"
                                @click="activeModal = exp"
                                class="px-4 py-2 rounded-full bg-[#1E6BFF] hover:bg-blue-600 text-white text-xs font-bold flex items-center gap-1.5 transition-colors cursor-pointer"
                            >
                                <Ticket class="w-3.5 h-3.5" />
                                <span>{{ isAr ? 'استعراض التذاكر' : 'Ticket Preview' }}</span>
                            </button>

                            <a
                                href="https://webook.com/en"
                                target="_blank"
                                rel="noopener"
                                class="text-xs font-bold text-slate-500 hover:text-slate-900 flex items-center gap-1"
                            >
                                <span>Webook</span>
                                <ExternalLink class="w-3 h-3" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preview Modal -->
        <div v-if="activeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full card-soft-shadow border border-slate-100 space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="font-black text-slate-900 text-base">
                        {{ isAr ? activeModal.title.ar : activeModal.title.en }}
                    </h3>
                    <button @click="activeModal = null" class="text-slate-400 hover:text-slate-700 text-lg">✕</button>
                </div>

                <div class="p-4 rounded-2xl bg-amber-50 text-xs text-amber-900 border border-amber-200">
                    {{ isAr 
                        ? 'تنبيه: حجز تذاكر الفعاليات يتم رسمياً عبر منصة ويبوك (Webook) المعتمدة للهيئة العامة للترفيه. توفر أجنحة السعودية باقات الطيران والإقامة المتكاملة.' 
                        : 'Notice: Official ticketing for mega-events is processed through official gateways such as Webook. SaudiWings provides curated flight and hospitality pairing.' }}
                </div>

                <div class="space-y-2 text-xs text-slate-600">
                    <div class="flex justify-between">
                        <span>{{ isAr ? 'الموقع:' : 'Location:' }}</span>
                        <span class="font-bold text-slate-900">{{ isAr ? activeModal.location.ar : activeModal.location.en }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ isAr ? 'التاريخ المتاح:' : 'Schedule:' }}</span>
                        <span class="font-bold text-slate-900">{{ isAr ? activeModal.date.ar : activeModal.date.en }}</span>
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <a
                        href="https://webook.com/en"
                        target="_blank"
                        rel="noopener"
                        class="flex-1 py-3 text-center rounded-full bg-[#0D1527] text-white text-xs font-bold hover:bg-[#1E6BFF] transition-colors"
                    >
                        {{ isAr ? 'الانتقال إلى Webook الرسمي' : 'Open Official Webook' }}
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
