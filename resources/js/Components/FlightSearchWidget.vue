<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { sampleAirportCodes } from '@/data/mockData';
import { Search, ArrowRightLeft, Calendar, Users, CheckCircle2, Plus, X, Sparkles } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr } = useLocale();

const tripType = ref('round'); // 'round' | 'oneway' | 'multi'
const origin = ref('RUH');
const destination = ref('ULH');
const departDate = ref('2026-11-15');
const returnDate = ref('2026-11-20');
const travelers = ref('1');
const cabinClass = ref('business');

// Multi-City flight segments builder
const multiSegments = ref([
    { id: 1, origin: 'RUH', destination: 'ULH', date: '2026-11-15' },
    { id: 2, origin: 'ULH', destination: 'JED', date: '2026-11-20' },
]);

const addSegment = () => {
    if (multiSegments.value.length < 4) {
        const lastSeg = multiSegments.value[multiSegments.value.length - 1];
        multiSegments.value.push({
            id: Date.now(),
            origin: lastSeg ? lastSeg.destination : 'JED',
            destination: 'RUH',
            date: '2026-11-25',
        });
    }
};

const removeSegment = (index) => {
    if (multiSegments.value.length > 2) {
        multiSegments.value.splice(index, 1);
    }
};

const applyMultiPreset = (legs) => {
    multiSegments.value = legs.map((leg, i) => ({
        id: i + 1,
        origin: leg.origin,
        destination: leg.destination,
        date: leg.date || `2026-11-${15 + i * 5}`,
    }));
};

const swapAirports = () => {
    const temp = origin.value;
    origin.value = destination.value;
    destination.value = temp;
};

const isSearching = ref(false);
const searchSuccess = ref(false);

const handleSearch = () => {
    isSearching.value = true;
    setTimeout(() => {
        isSearching.value = false;
        searchSuccess.value = true;
        if (tripType.value === 'multi') {
            const firstLeg = multiSegments.value[0];
            const lastLeg = multiSegments.value[multiSegments.value.length - 1];
            router.visit(`/flights?trip=multi&origin=${firstLeg.origin}&destination=${lastLeg.destination}&class=${cabinClass.value}`);
        } else {
            router.visit(`/flights?trip=${tripType.value}&origin=${origin.value}&destination=${destination.value}&class=${cabinClass.value}`);
        }
    }, 600);
};
</script>

<template>
    <div class="w-full bg-white rounded-3xl p-6 sm:p-8 card-soft-shadow border border-slate-100">
        <!-- Trip Type Tabs -->
        <div class="flex items-center gap-2 sm:gap-4 mb-6 border-b border-slate-100 pb-4">
            <button
                type="button"
                @click="tripType = 'round'"
                class="px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all cursor-pointer"
                :class="tripType === 'round' ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20' : 'text-slate-600 hover:bg-slate-100'"
            >
                {{ isAr ? 'ذهاب وعودة' : 'Round Trip' }}
            </button>
            <button
                type="button"
                @click="tripType = 'oneway'"
                class="px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all cursor-pointer"
                :class="tripType === 'oneway' ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20' : 'text-slate-600 hover:bg-slate-100'"
            >
                {{ isAr ? 'اتجاه واحد' : 'One Way' }}
            </button>
            <button
                type="button"
                @click="tripType = 'multi'"
                class="px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center gap-1.5"
                :class="tripType === 'multi' ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20' : 'text-slate-600 hover:bg-slate-100'"
            >
                <span>{{ isAr ? 'وجهات متعددة' : 'Multi-City' }}</span>
                <span class="text-[10px] px-1.5 py-0.2 rounded-full" :class="tripType === 'multi' ? 'bg-white/20 text-white' : 'bg-blue-100 text-[#1E6BFF]'">
                    {{ isAr ? 'مسار متتابع' : 'Multi-Leg' }}
                </span>
            </button>
        </div>

        <!-- ======================= STANDARD 1-ROW VIEW (Round-Trip & One-Way) ======================= -->
        <div v-if="tripType !== 'multi'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3.5 items-center">
            <!-- Origin Airport -->
            <div class="relative bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3.5 border border-slate-200/80 transition-colors">
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                    {{ isAr ? 'من (المغادرة)' : 'From (Departure)' }}
                </span>
                <select
                    v-model="origin"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                >
                    <option v-for="ap in sampleAirportCodes" :key="ap.code" :value="ap.code">
                        {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }}
                    </option>
                </select>
            </div>

            <!-- Destination Airport (with Swap Button in between) -->
            <div class="relative bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3.5 border border-slate-200/80 transition-colors">
                <!-- Swap Button -->
                <button
                    type="button"
                    @click="swapAirports"
                    class="absolute -top-3.5 sm:top-1/2 sm:-translate-y-1/2 -start-3 z-10 w-7 h-7 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-[#1E6BFF] hover:border-[#1E6BFF] flex items-center justify-center shadow-sm cursor-pointer"
                    :title="isAr ? 'تبديل الوجهات' : 'Swap Airports'"
                >
                    <ArrowRightLeft class="w-3.5 h-3.5" />
                </button>
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                    {{ isAr ? 'إلى (الوصول)' : 'To (Destination)' }}
                </span>
                <select
                    v-model="destination"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                >
                    <option v-for="ap in sampleAirportCodes" :key="ap.code" :value="ap.code">
                        {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }}
                    </option>
                </select>
            </div>

            <!-- Departure Date -->
            <div class="bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3.5 border border-slate-200/80 transition-colors">
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                    <Calendar class="w-3 h-3 text-slate-400" />
                    {{ isAr ? 'تاريخ الذهاب' : 'Depart Date' }}
                </span>
                <input
                    type="date"
                    v-model="departDate"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                />
            </div>

            <!-- Return Date: Displayed when Round-Trip, disabled with clear badge when One-Way -->
            <div
                class="rounded-2xl p-3.5 border transition-all"
                :class="tripType === 'oneway' 
                    ? 'bg-slate-100/50 border-dashed border-slate-200 opacity-60 cursor-not-allowed select-none' 
                    : 'bg-slate-50 hover:bg-slate-100/80 border-slate-200/80'"
            >
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                    <Calendar class="w-3 h-3 text-slate-400" />
                    {{ isAr ? 'تاريخ العودة' : 'Return Date' }}
                </span>
                <input
                    v-if="tripType !== 'oneway'"
                    type="date"
                    v-model="returnDate"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                />
                <span v-else class="text-xs font-bold text-slate-400 block pt-1">
                    {{ isAr ? 'غير مطلوب (اتجاه واحد)' : 'Not needed (One-Way)' }}
                </span>
            </div>

            <!-- Cabin Class & Travelers -->
            <div class="bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3.5 border border-slate-200/80 transition-colors">
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                    <Users class="w-3 h-3 text-slate-400" />
                    {{ isAr ? 'المسافرون والدرجة' : 'Travelers & Class' }}
                </span>
                <select
                    v-model="cabinClass"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                >
                    <option value="economy">{{ isAr ? '1 مسافر، السياحية' : '1 Traveler, Economy' }}</option>
                    <option value="business">{{ isAr ? '1 مسافر، الأعمال' : '1 Traveler, Business' }}</option>
                    <option value="first">{{ isAr ? '1 مسافر، الأولى' : '1 Traveler, First' }}</option>
                </select>
            </div>

            <!-- Submit CTA Button -->
            <div>
                <button
                    type="button"
                    @click="handleSearch"
                    :disabled="isSearching"
                    class="w-full py-3.5 px-4 rounded-2xl bg-[#1E6BFF] hover:bg-blue-600 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-lg shadow-blue-500/25 active:scale-98 transition-all cursor-pointer disabled:opacity-75"
                >
                    <AircraftIcon v-if="!isSearching" className="w-5 h-5 text-white" :angle="isAr ? -45 : 45" />
                    <svg v-else class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>{{ isAr ? 'بحث عن الرحلات' : 'Search Flights' }}</span>
                </button>
            </div>
        </div>

        <!-- ======================= DEDICATED MULTI-CITY BUILDER VIEW ======================= -->
        <div v-else class="space-y-4">
            <!-- Clear Multi-City Clarification Banner -->
            <div class="p-4 rounded-2xl bg-blue-50/70 border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1E6BFF] text-white flex items-center justify-center shrink-0 shadow-sm">
                        <AircraftIcon className="w-5 h-5 text-white" :angle="isAr ? -45 : 45" />
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-black text-slate-900">
                            {{ isAr ? 'تخطيط رحلات متعددة الوجهات (Multi-City Itinerary)' : 'Multi-City Route Planner' }}
                        </h4>
                        <p class="text-[11px] sm:text-xs text-slate-600 font-medium mt-0.5">
                            {{ isAr 
                                ? 'خطط للتنقل بين عدة مدن ومطارات في تذكرة واحدة متسلسلة بكل سهولة ومرونة.' 
                                : 'Coordinate sequential flight legs across multiple Saudi destinations in one unified ticket.' }}
                        </p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 text-xs font-black text-[#1E6BFF] bg-white px-3 py-1.5 rounded-full border border-blue-200/70 shadow-xs self-start sm:self-auto">
                    <span class="w-2 h-2 rounded-full bg-[#1E6BFF]"></span>
                    {{ isAr ? `${multiSegments.length} محطات محددة` : `${multiSegments.length} Flight Legs` }}
                </span>
            </div>

            <!-- Segment Rows -->
            <div class="space-y-3">
                <div
                    v-for="(seg, idx) in multiSegments"
                    :key="seg.id"
                    class="p-4 rounded-2xl bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 transition-all hover:border-[#1E6BFF]/40"
                >
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-[#1E6BFF] text-white shadow-xs">
                                {{ isAr ? `الرحلة ${idx + 1}` : `Leg ${idx + 1}` }}
                            </span>
                            <span class="text-xs font-bold text-slate-400">
                                {{ seg.origin }} ➔ {{ seg.destination }}
                            </span>
                        </div>

                        <!-- Remove Leg Button (allowed if more than 2 legs) -->
                        <button
                            v-if="multiSegments.length > 2"
                            type="button"
                            @click="removeSegment(idx)"
                            class="text-xs font-bold text-rose-500 hover:text-rose-700 flex items-center gap-1 transition-colors cursor-pointer px-2 py-1 rounded-lg hover:bg-rose-50"
                        >
                            <X class="w-3.5 h-3.5" />
                            <span>{{ isAr ? 'حذف هذه المحطة' : 'Remove' }}</span>
                        </button>
                    </div>

                    <!-- Input Fields for this Leg -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <!-- Origin -->
                        <div class="bg-white rounded-xl p-3 border border-slate-200/80 shadow-xs">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                {{ isAr ? 'من (مطار المغادرة)' : 'From' }}
                            </span>
                            <select
                                v-model="seg.origin"
                                class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                            >
                                <option v-for="ap in sampleAirportCodes" :key="ap.code" :value="ap.code">
                                    {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }}
                                </option>
                            </select>
                        </div>

                        <!-- Destination -->
                        <div class="bg-white rounded-xl p-3 border border-slate-200/80 shadow-xs">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                {{ isAr ? 'إلى (مطار الوصول)' : 'To' }}
                            </span>
                            <select
                                v-model="seg.destination"
                                class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                            >
                                <option v-for="ap in sampleAirportCodes" :key="ap.code" :value="ap.code">
                                    {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }}
                                </option>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="bg-white rounded-xl p-3 border border-slate-200/80 shadow-xs">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                                <Calendar class="w-3 h-3 text-slate-400" />
                                {{ isAr ? 'تاريخ السفر' : 'Flight Date' }}
                            </span>
                            <input
                                type="date"
                                v-model="seg.date"
                                class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multi-City Bottom Control Bar -->
            <div class="pt-3 border-t border-slate-100 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                <!-- Add Segment CTA Button -->
                <button
                    type="button"
                    @click="addSegment"
                    :disabled="multiSegments.length >= 4"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-dashed border-[#1E6BFF]/40 text-[#1E6BFF] hover:bg-blue-50/70 font-bold text-xs sm:text-sm transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
                >
                    <Plus class="w-4 h-4" />
                    <span>{{ isAr ? 'إضافة محطة رحلة أخرى (+)' : 'Add Another Flight (+)' }}</span>
                    <span v-if="multiSegments.length >= 4" class="text-[10px] text-slate-400">
                        ({{ isAr ? 'الحد الأقصى 4' : 'Max 4' }})
                    </span>
                </button>

                <!-- Class & Travelers + Search CTA Button -->
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <div class="w-full sm:w-auto bg-slate-50 rounded-xl p-2.5 border border-slate-200/80 flex items-center gap-2">
                        <Users class="w-4 h-4 text-slate-400 shrink-0" />
                        <select v-model="cabinClass" class="bg-transparent font-bold text-slate-900 text-xs sm:text-sm focus:outline-none cursor-pointer">
                            <option value="economy">{{ isAr ? '1 مسافر، السياحية' : '1 Traveler, Economy' }}</option>
                            <option value="business">{{ isAr ? '1 مسافر، الأعمال' : '1 Traveler, Business' }}</option>
                            <option value="first">{{ isAr ? '1 مسافر، الأولى' : '1 Traveler, First' }}</option>
                        </select>
                    </div>

                    <button
                        type="button"
                        @click="handleSearch"
                        :disabled="isSearching"
                        class="w-full sm:w-auto py-3 px-6 rounded-xl bg-[#1E6BFF] hover:bg-blue-600 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-lg shadow-blue-500/25 active:scale-98 transition-all cursor-pointer"
                    >
                        <AircraftIcon v-if="!isSearching" className="w-4 h-4 text-white" :angle="isAr ? -45 : 45" />
                        <svg v-else class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>{{ isAr ? 'بحث عن رحلات المسار المتعدد' : 'Search Multi-City Flights' }}</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Route Chips (Clickable and interactive) -->
        <div class="mt-5 pt-3.5 border-t border-slate-100 flex flex-wrap items-center gap-2 text-xs">
            <!-- Normal Route Chips for Round/One-way -->
            <template v-if="tripType !== 'multi'">
                <span class="font-black text-slate-700 flex items-center gap-1 me-1">
                    <span class="w-2 h-2 rounded-full bg-[#1E6BFF]"></span>
                    {{ isAr ? 'المسارات المقترحة:' : 'Popular Routes:' }}
                </span>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'MED'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'MED'
                        ? 'bg-[#1E6BFF] text-white border-[#1E6BFF] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ المدينة المنورة' : 'RUH ⇄ MED (Madinah)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'JED'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'JED'
                        ? 'bg-[#1E6BFF] text-white border-[#1E6BFF] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ جدة (مكة)' : 'RUH ⇄ JED (Makkah)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'ULH'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'ULH'
                        ? 'bg-[#1E6BFF] text-white border-[#1E6BFF] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ العلا' : 'RUH ⇄ ULH (AlUla)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'RSI'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'RSI'
                        ? 'bg-[#1E6BFF] text-white border-[#1E6BFF] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ البحر الأحمر' : 'RUH ⇄ RSI (Red Sea)' }}
                </button>
            </template>

            <!-- Suggested Itineraries for Multi-City -->
            <template v-else>
                <span class="font-black text-slate-700 flex items-center gap-1 me-1">
                    <Sparkles class="w-3.5 h-3.5 text-[#1E6BFF]" />
                    {{ isAr ? 'مسارات متعددة مقترحة:' : 'Suggested Multi-City Trips:' }}
                </span>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'RUH', destination: 'ULH', date: '2026-11-15' },
                        { origin: 'ULH', destination: 'JED', date: '2026-11-20' },
                        { origin: 'JED', destination: 'RUH', date: '2026-11-25' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60"
                >
                    {{ isAr ? 'الرياض ➔ العلا ➔ جدة ➔ الرياض' : 'RUH ➔ ULH ➔ JED ➔ RUH' }}
                </button>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'RUH', destination: 'RSI', date: '2026-11-15' },
                        { origin: 'RSI', destination: 'MED', date: '2026-11-20' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60"
                >
                    {{ isAr ? 'الرياض ➔ البحر الأحمر ➔ المدينة' : 'RUH ➔ RSI ➔ MED' }}
                </button>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'DMM', destination: 'RUH', date: '2026-11-15' },
                        { origin: 'RUH', destination: 'AHB', date: '2026-11-20' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF] border-slate-200/60"
                >
                    {{ isAr ? 'الدمام ➔ الرياض ➔ أبها' : 'DMM ➔ RUH ➔ AHB' }}
                </button>
            </template>
        </div>
    </div>
</template>
