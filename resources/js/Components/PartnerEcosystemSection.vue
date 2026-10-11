<script setup>
import { useLocale } from '@/composables/useLocale';
import { travelPartners } from '@/data/mockData';
import { ExternalLink, ShieldCheck, Building2, Ticket, Globe } from 'lucide-vue-next';

const { isAr } = useLocale();
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Header -->
        <div class="max-w-3xl mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-[#1E6BFF] block mb-1">
                {{ isAr ? 'منظومة الشركاء والمصادر الرسمية' : 'TRAVEL PARTNERS & OFFICIAL RESOURCES' }}
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                {{ isAr ? 'بوابات السفر والسياحة والترفيه المعتمدة في المملكة' : 'Verified Ecosystem & External Travel Authorities' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-2 leading-relaxed">
                {{ isAr 
                    ? 'روابط مباشرة ومصادر خارجية تم التحقق منها للناقلين الوطنيين وهيئات السياحة ومنصات الفعاليات الكبرى.'
                    : 'Direct verified links to national flag carriers, official tourism portals, eVisa platforms, and entertainment ticketing.' }}
            </p>
        </div>

        <!-- Categorized Partner Groups -->
        <div class="space-y-10">
            <div
                v-for="(group, idx) in travelPartners"
                :key="idx"
                class="bg-white rounded-3xl p-6 sm:p-8 card-soft-shadow border border-slate-100"
            >
                <!-- Category Title -->
                <div class="flex items-center gap-3 pb-5 border-b border-slate-100 mb-6">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-[#1E6BFF] flex items-center justify-center">
                        <Building2 class="w-4 h-4" />
                    </div>
                    <h3 class="text-base sm:text-lg font-black text-slate-900">
                        {{ isAr ? group.category.ar : group.category.en }}
                    </h3>
                </div>

                <!-- Cards Grid inside Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a
                        v-for="item in group.items"
                        :key="item.name.en"
                        :href="item.url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group p-5 rounded-2xl bg-slate-50/80 hover:bg-white border border-slate-200/80 hover:border-[#1E6BFF] card-hover flex flex-col justify-between transition-all"
                    >
                        <div>
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <span class="text-base font-extrabold text-slate-900 group-hover:text-[#1E6BFF] transition-colors">
                                    {{ isAr ? item.name.ar : item.name.en }}
                                </span>
                                <ExternalLink class="w-4 h-4 text-slate-400 group-hover:text-[#1E6BFF] shrink-0 transition-colors" />
                            </div>

                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-[#1E6BFF] border border-blue-200/60 mb-3">
                                {{ isAr ? item.badge.ar : item.badge.en }}
                            </span>

                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ isAr ? item.desc.ar : item.desc.en }}
                            </p>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-bold text-slate-400 group-hover:text-[#1E6BFF]">
                            <span>{{ isAr ? 'زيارة البوابة الرسمية' : 'Visit Official Portal' }}</span>
                            <span class="text-xs font-mono">↗</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Extensibility Note -->
        <div class="mt-8 p-4 rounded-2xl bg-slate-100/60 border border-slate-200 text-xs text-slate-500 flex items-center justify-between">
            <span>
                {{ isAr 
                    ? 'منظومة مفتوحة وقابلة للتوسع: يمكن ربط المزيد من شركات الطيران، المطارات، ومزودي الفنادق والنقل مستقبلاً.' 
                    : 'Extensible architecture: easily onboard additional international airlines, airports, and luxury hospitality providers.' }}
            </span>
            <span class="font-bold text-[#1E6BFF] hidden sm:inline">Vision 2030 Ecosystem</span>
        </div>
    </section>
</template>
