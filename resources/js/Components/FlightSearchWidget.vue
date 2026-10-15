<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { sampleAirportCodes } from '@/data/mockData';
import { Search, ArrowRightLeft, Calendar, Users, CheckCircle2, Plus, X, Sparkles, Compass, MapPin, HelpCircle } from 'lucide-vue-next';

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
        <!-- Trip Type Tabs with Clear Subtitles & Clarification -->
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-6 border-b border-slate-100 pb-4">
            <!-- 1. Round Trip Tab -->
            <button
                type="button"
                @click="tripType = 'round'"
                class="px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center gap-2"
                :class="tripType === 'round' 
                    ? 'bg-[#243E88] text-white shadow-md shadow-[#243E88]/25' 
                    : 'text-slate-600 hover:bg-slate-100'"
            >
                <span>{{ isAr ? 'ذهاب وعودة' : 'Round Trip' }}</span>
                <span class="text-[10px] opacity-75 font-medium border-s border-current/25 ps-1.5">
                    {{ isAr ? 'مدينتان مع عودة' : '2-Way' }}
                </span>
            </button>

            <!-- 2. One Way Tab -->
            <button
                type="button"
                @click="tripType = 'oneway'"
                class="px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center gap-2"
                :class="tripType === 'oneway' 
                    ? 'bg-[#243E88] text-white shadow-md shadow-[#243E88]/25' 
                    : 'text-slate-600 hover:bg-slate-100'"
            >
                <span>{{ isAr ? 'اتجاه واحد' : 'One Way' }}</span>
                <span class="text-[10px] opacity-75 font-medium border-s border-current/25 ps-1.5">
                    {{ isAr ? 'ذهاب فقط' : '1-Way' }}
                </span>
            </button>

            <!-- 3. Multi-City Tab (Highlighted with Clear Explanation Badge) -->
            <button
                type="button"
                @click="tripType = 'multi'"
                class="px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center gap-2"
                :class="tripType === 'multi' 
                    ? 'bg-[#243E88] text-white shadow-md shadow-[#243E88]/25' 
                    : 'text-slate-600 hover:bg-slate-100'"
            >
                <span>{{ isAr ? 'وجهات متعددة' : 'Multi-City' }}</span>
                <span 
                    class="text-[10px] px-2 py-0.5 rounded-full font-black tracking-wide"
                    :class="tripType === 'multi' 
                        ? 'bg-[#FAB515] text-[#1B316E] shadow-xs' 
                        : 'bg-amber-100 text-[#1B316E]'"
                >
                    {{ isAr ? 'عدة محطات متتالية' : 'Multi-Leg' }}
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
                    class="absolute -top-3.5 sm:top-1/2 sm:-translate-y-1/2 -start-3 z-10 w-7 h-7 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-[#243E88] hover:border-[#243E88] flex items-center justify-center shadow-sm cursor-pointer"
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

            <!-- Submit CTA Button (Golden Yellow Brand Color) -->
            <div>
                <button
                    type="button"
                    @click="handleSearch"
                    :disabled="isSearching"
                    class="w-full py-3.5 px-4 rounded-2xl bg-[#FAB515] hover:bg-[#e8a50e] text-[#1B316E] font-black text-sm flex items-center justify-center gap-2 shadow-lg shadow-[#FAB515]/25 active:scale-98 transition-all cursor-pointer disabled:opacity-75"
                >
                    <svg v-if="isSearching" class="animate-spin h-5 w-5 text-[#1B316E]" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>{{ isAr ? 'بحث عن الرحلات' : 'Search Flights' }}</span>
                </button>
            </div>
        </div>

        <!-- ======================= DEDICATED MULTI-CITY BUILDER VIEW ======================= -->
        <div v-else class="space-y-4">
            <!-- Clear Multi-City Clarification Guidance Box -->
            <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-blue-50/90 via-indigo-50/50 to-blue-50/90 border border-blue-200/90 shadow-xs">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-md bg-[#243E88] text-white text-[11px] font-black">
                                {{ isAr ? 'توضيح تبويب الوجهات المتعددة' : 'Multi-City Guide' }}
                            </span>
                            <h4 class="text-xs sm:text-sm font-black text-slate-900">
                                {{ isAr ? 'حجز مسار رحلات متتابع بين أكثر من مدينة في تذكرة واحدة' : 'Sequential Stops Across Cities on 1 Ticket' }}
                            </h4>
                        </div>
                        <p class="text-xs text-slate-600 font-medium leading-relaxed">
                            {{ isAr 
                                ? 'هذا التبويب مخصص للمسافرين الراغبين في زيارة أكثر من وجهة (مثال: من الرياض إلى العلا، ثم بعد أيام من العلا إلى جدة) مع تحديد موعد منفصل لكل محطة دون الحاجة لتذكرة عودة إلى نقطة البداية.' 
                                : 'Plan multi-stop itineraries with independent dates for each stopover (e.g. Riyadh to AlUla, then AlUla to Jeddah) in one connected ticket.' }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2 self-start md:self-auto shrink-0">
                        <span class="text-xs font-bold text-[#243E88] bg-white px-3 py-1.5 rounded-xl border border-blue-200 shadow-xs">
                            {{ isAr ? `المسار: ${multiSegments.length} محطات سفر` : `${multiSegments.length} Flight Legs` }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Segment Rows -->
            <div class="space-y-3">
                <div
                    v-for="(seg, idx) in multiSegments"
                    :key="seg.id"
                    class="p-4 sm:p-5 rounded-2xl bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 transition-all hover:border-[#243E88]/40"
                >
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-[#243E88] text-white shadow-xs">
                                {{ isAr ? `المحطة ${idx + 1} (الرحلة ${idx + 1})` : `Stop ${idx + 1} (Flight ${idx + 1})` }}
                            </span>
                            <span class="text-xs font-bold text-slate-500">
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
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-dashed border-[#243E88]/40 text-[#243E88] hover:bg-blue-50/70 font-bold text-xs sm:text-sm transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
                >
                    <Plus class="w-4 h-4" />
                    <span>{{ isAr ? 'إضافة محطة رحلة أخرى (+)' : 'Add Another Stop (+)' }}</span>
                    <span v-if="multiSegments.length >= 4" class="text-[10px] text-slate-400">
                        ({{ isAr ? 'الحد الأقصى 4' : 'Max 4' }})
                    </span>
                </button>

                <!-- Class & Travelers + Search CTA Button (Without Aircraft Icon) -->
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
                        class="w-full sm:w-auto py-3 px-6 rounded-xl bg-[#FAB515] hover:bg-[#e8a50e] text-[#1B316E] font-black text-sm flex items-center justify-center gap-2 shadow-lg shadow-[#FAB515]/25 active:scale-98 transition-all cursor-pointer"
                    >
                        <svg v-if="isSearching" class="animate-spin h-4 w-4 text-[#1B316E]" viewBox="0 0 24 24">
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
                    <span class="w-2 h-2 rounded-full bg-[#FAB515]"></span>
                    {{ isAr ? 'المسارات المقترحة:' : 'Popular Routes:' }}
                </span>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'MED'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'MED'
                        ? 'bg-[#243E88] text-white border-[#243E88] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-[#243E88]/5 hover:text-[#243E88] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ المدينة المنورة' : 'RUH ⇄ MED (Madinah)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'JED'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'JED'
                        ? 'bg-[#243E88] text-white border-[#243E88] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-[#243E88]/5 hover:text-[#243E88] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ جدة (مكة)' : 'RUH ⇄ JED (Makkah)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'ULH'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'ULH'
                        ? 'bg-[#243E88] text-white border-[#243E88] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-[#243E88]/5 hover:text-[#243E88] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ العلا' : 'RUH ⇄ ULH (AlUla)' }}
                </button>
                <button
                    type="button"
                    @click="origin = 'RUH'; destination = 'RSI'"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border"
                    :class="origin === 'RUH' && destination === 'RSI'
                        ? 'bg-[#243E88] text-white border-[#243E88] shadow-sm'
                        : 'bg-slate-100 text-slate-700 hover:bg-[#243E88]/5 hover:text-[#243E88] border-slate-200/60'"
                >
                    {{ isAr ? 'الرياض ⇄ البحر الأحمر' : 'RUH ⇄ RSI (Red Sea)' }}
                </button>
            </template>

            <!-- Suggested Itineraries for Multi-City -->
            <template v-else>
                <span class="font-black text-slate-700 flex items-center gap-1 me-1">
                    <Sparkles class="w-3.5 h-3.5 text-[#FAB515]" />
                    {{ isAr ? 'مسارات متعددة مقترحة:' : 'Suggested Multi-City Trips:' }}
                </span>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'RUH', destination: 'ULH', date: '2026-11-15' },
                        { origin: 'ULH', destination: 'JED', date: '2026-11-20' },
                        { origin: 'JED', destination: 'RUH', date: '2026-11-25' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#243E88] border-slate-200/60"
                >
                    {{ isAr ? 'الرياض ➔ العلا ➔ جدة ➔ الرياض' : 'RUH ➔ ULH ➔ JED ➔ RUH' }}
                </button>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'RUH', destination: 'RSI', date: '2026-11-15' },
                        { origin: 'RSI', destination: 'MED', date: '2026-11-20' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#243E88] border-slate-200/60"
                >
                    {{ isAr ? 'الرياض ➔ البحر الأحمر ➔ المدينة' : 'RUH ➔ RSI ➔ MED' }}
                </button>
                <button
                    type="button"
                    @click="applyMultiPreset([
                        { origin: 'DMM', destination: 'RUH', date: '2026-11-15' },
                        { origin: 'RUH', destination: 'AHB', date: '2026-11-20' }
                    ])"
                    class="px-3 py-1.5 rounded-full font-bold transition-all cursor-pointer border bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-[#243E88] border-slate-200/60"
                >
                    {{ isAr ? 'الدمام ➔ الرياض ➔ أبها' : 'DMM ➔ RUH ➔ AHB' }}
                </button>
            </template>
        </div>
    </div>
</template>
