<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { experiences } from '@/data/mockData';
import { Calendar, MapPin, ArrowRight, ArrowLeft, Sparkles } from 'lucide-vue-next';

const { isAr } = useLocale();
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#243E88] flex items-center gap-1.5 mb-1">
                    <Sparkles class="w-4 h-4 text-[#FAB515]" />
                    {{ isAr ? 'رحلات استثنائية في قلب المملكة' : 'SAUDI EXPERIENCES & SACRED JOURNEYS' }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'التجارب والرحلات الاستثنائية' : 'Exceptional Experiences & Trips' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                    {{ isAr ? 'من رحاب العمرة في مكة المكرمة وسكينة المدينة المنورة إلى مسرح مرايا بالعلا وغوص البحر الأحمر' : 'From spiritual Umrah in Makkah and serene Madinah to AlUla stargazing and pristine coral diving' }}
                </p>
            </div>

            <Link
                href="/experiences"
                class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-[#243E88] hover:text-[#FAB515] transition-colors"
            >
                <span>{{ isAr ? 'عرض جميع التجارب والرحلات' : 'View All Experiences' }}</span>
                <component :is="isAr ? ArrowLeft : ArrowRight" class="w-4 h-4" />
            </Link>
        </div>

        <!-- Visual Editorial Cards (Asymmetrical / magazine layout) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                v-for="exp in experiences"
                :key="exp.id"
                class="group bg-white rounded-3xl overflow-hidden card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between"
            >
                <div>
                    <!-- Photo Header -->
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img
                            :src="exp.image"
                            :alt="exp.title.en"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        />
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                {{ isAr ? exp.tag.ar : exp.tag.en }}
                            </span>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-5">
                        <div class="flex items-center gap-1.5 text-[11px] font-bold text-[#243E88] mb-2">
                            <Calendar class="w-3.5 h-3.5 text-[#FAB515] shrink-0" />
                            <span>{{ isAr ? exp.date.ar : exp.date.en }}</span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#243E88] transition-colors leading-snug mb-2">
                            {{ isAr ? exp.title.ar : exp.title.en }}
                        </h3>

                        <div class="flex items-center gap-1 text-[11px] text-slate-400 mb-3">
                            <MapPin class="w-3.5 h-3.5 shrink-0" />
                            <span>{{ isAr ? exp.location.ar : exp.location.en }}</span>
                        </div>

                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                            {{ isAr ? exp.desc.ar : exp.desc.en }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0">
                    <Link
                        :href="`/destinations?id=${exp.destinationId || (exp.id.includes('umrah') ? 'makkah' : exp.id.includes('madinah') ? 'madinah' : exp.id.includes('tantora') ? 'alula' : 'red-sea')}`"
                        class="w-full py-2.5 rounded-full border border-slate-200 hover:border-[#243E88] hover:bg-[#243E88]/5 hover:text-[#243E88] text-slate-700 text-xs font-bold flex items-center justify-center gap-1.5 transition-colors"
                    >
                        <span>{{ isAr ? (exp.id.includes('umrah') || exp.id.includes('madinah') ? 'استكشف الوجهة والرحلة' : 'استكشف تفاصيل الوجهة') : 'Explore Destination' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
