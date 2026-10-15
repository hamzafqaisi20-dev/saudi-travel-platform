<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { destinations } from '@/data/mockData';
import { useLocale } from '@/composables/useLocale';
import { MapPin, Star, Search, ArrowRight, ArrowLeft, CheckCircle2 } from 'lucide-vue-next';
import CurrencyBadge from '@/Components/CurrencyBadge.vue';

const { isAr } = useLocale();

const searchQuery = ref('');
const selectedCategory = ref('all');

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const filter = params.get('filter') || params.get('topic');
    if (id) {
        selectedCategory.value = id;
        setTimeout(() => {
            const el = document.getElementById(`dest-${id}`);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 150);
    } else if (filter) {
        searchQuery.value = filter;
    }
});

const filteredDestinations = computed(() => {
    return destinations.filter(d => {
        const matchesCategory = selectedCategory.value === 'all' || d.id === selectedCategory.value;
        const q = searchQuery.value.toLowerCase().trim();
        const matchesSearch = !q ||
            d.title.ar.toLowerCase().includes(q) ||
            d.title.en.toLowerCase().includes(q) ||
            d.code.toLowerCase().includes(q) ||
            d.location.ar.toLowerCase().includes(q) ||
            d.location.en.toLowerCase().includes(q) ||
            d.category.ar.toLowerCase().includes(q) ||
            d.category.en.toLowerCase().includes(q) ||
            d.description.ar.toLowerCase().includes(q) ||
            d.highlights.ar.some(h => h.toLowerCase().includes(q));

        return matchesCategory && matchesSearch;
    });
});
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'دليل الوجهات السياحية - InfoTravel' : 'Destinations Directory - InfoTravel'" />

        <!-- Header -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl space-y-3">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-400">
                        {{ isAr ? 'دليل الوجهات السعودية الشامل' : 'SAUDI DESTINATIONS CATALOG' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
                        {{ isAr ? 'استكشف أقدس وأجمل مدن ومحميات المملكة' : 'Sacred Sanctuaries & Wonders Across The Realm' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium">
                        {{ isAr 
                            ? 'دليل استرشادي يجمع بين روحانية مكة والمدينة والتراث النبطي والمنتجعات الفاخرة وقمم الجبال الخضراء مع رحلات طيران مباشرة.' 
                            : 'Explore our comprehensive directory of Saudi destinations featuring holy sanctuaries, heritage sites, luxury coastlines, and mountain peaks.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Search & Filter Controls -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
            <div class="bg-white rounded-3xl p-6 card-soft-shadow border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Search Input -->
                <div class="relative w-full md:w-96">
                    <Search class="w-4 h-4 text-slate-400 absolute top-1/2 -translate-y-1/2 start-4 pointer-events-none" />
                    <input
                        type="text"
                        v-model="searchQuery"
                        :placeholder="isAr ? 'ابحث باسم المدينة أو كود المطار (مثال: مكة، العلا، MED)...' : 'Search by city or airport code (e.g. Makkah, AlUla, MED)...'"
                        class="w-full ps-11 pe-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:outline-none focus:border-[#243E88]"
                    />
                </div>

                <!-- Category Filter Pills -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-1 md:pb-0 text-xs">
                    <button
                        type="button"
                        @click="selectedCategory = 'all'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'all' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'جميع الوجهات' : 'All Places' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'makkah'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'makkah' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'مكة المكرمة' : 'Makkah' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'madinah'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'madinah' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'المدينة المنورة' : 'Madinah' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'alula'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'alula' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'العلا' : 'AlUla' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'red-sea'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'red-sea' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'البحر الأحمر' : 'The Red Sea' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'riyadh'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'riyadh' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'الرياض' : 'Riyadh' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'jeddah'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'jeddah' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'جدة' : 'Jeddah' }}
                    </button>
                    <button
                        type="button"
                        @click="selectedCategory = 'abha'"
                        class="px-4 py-2 rounded-full font-bold transition-all cursor-pointer shrink-0"
                        :class="selectedCategory === 'abha' ? 'bg-[#243E88] text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                    >
                        {{ isAr ? 'أبها' : 'Abha' }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Destination Cards Directory -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="dest in filteredDestinations"
                    :key="dest.id"
                    :id="`dest-${dest.id}`"
                    class="bg-white rounded-3xl overflow-hidden card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between group transition-all"
                    :class="selectedCategory === dest.id ? 'ring-2 ring-[#243E88] ring-offset-4' : ''"
                >
                    <div>
                        <!-- Destination Photo -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img
                                :src="dest.image"
                                :alt="dest.title.en"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                            <div class="absolute top-3.5 inset-x-3.5 flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-slate-900 shadow-sm">
                                    {{ isAr ? dest.category.ar : dest.category.en }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#243E88] text-white shadow-sm font-mono">
                                    {{ dest.code }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-lg font-black text-slate-900 group-hover:text-[#243E88] transition-colors">
                                    {{ isAr ? dest.title.ar : dest.title.en }}
                                </h3>
                                <div class="shrink-0 flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#243E88] text-white text-xs font-black shadow-sm">
                                    <Star class="w-3 h-3 fill-current text-[#FAB515]" />
                                    <span>{{ dest.rating }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-1 text-xs text-slate-400 mb-3">
                                <MapPin class="w-3.5 h-3.5 shrink-0" />
                                <span>{{ isAr ? dest.location.ar : dest.location.en }}</span>
                            </div>

                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ isAr ? dest.description.ar : dest.description.en }}
                            </p>

                            <!-- Highlights Chips -->
                            <div class="space-y-1.5 pt-2 border-t border-slate-100">
                                <span class="text-[11px] font-bold text-slate-400 block">{{ isAr ? 'أبرز المعالم:' : 'Key Highlights:' }}</span>
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        v-for="(h, i) in (isAr ? dest.highlights.ar : dest.highlights.en)"
                                        :key="i"
                                        class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600"
                                    >
                                        {{ h }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="p-6 pt-0 flex items-center justify-between border-t border-slate-50">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">{{ isAr ? 'تبدأ باقات الطيران من' : 'Flight packages from' }}</span>
                            <CurrencyBadge :amount="dest.priceFrom" size="md" />
                        </div>

                        <Link
                            :href="`/flights?destination=${dest.code}`"
                            class="px-4 py-2 rounded-full bg-[#0D1527] hover:bg-[#243E88] text-white text-xs font-bold transition-colors"
                        >
                            {{ isAr ? 'حجز رحلة للوجهة' : 'Find Flights' }}
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
