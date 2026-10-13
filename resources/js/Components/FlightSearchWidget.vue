<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { sampleAirportCodes } from '@/data/mockData';
import { Search, ArrowRightLeft, Calendar, Users, CheckCircle2 } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr } = useLocale();

const tripType = ref('round'); // 'round' | 'oneway' | 'multi'
const origin = ref('RUH');
const destination = ref('ULH');
const departDate = ref('2026-11-15');
const returnDate = ref('2026-11-20');
const travelers = ref('1');
const cabinClass = ref('business');

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
        // Redirect to flights page with query parameters
        router.visit(`/flights?origin=${origin.value}&destination=${destination.value}&class=${cabinClass.value}`);
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
                class="px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all cursor-pointer"
                :class="tripType === 'multi' ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20' : 'text-slate-600 hover:bg-slate-100'"
            >
                {{ isAr ? 'وجهات متعددة' : 'Multi-City' }}
            </button>
        </div>

        <!-- Inputs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-center">
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
                        {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }} ({{ isAr ? ap.name.ar : ap.name.en }})
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
                        {{ ap.code }} - {{ isAr ? ap.city.ar : ap.city.en }} ({{ isAr ? ap.name.ar : ap.name.en }})
                    </option>
                </select>
            </div>

            <!-- Dates -->
            <div class="bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3.5 border border-slate-200/80 transition-colors">
                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                    <Calendar class="w-3 h-3 text-slate-400" />
                    {{ isAr ? 'تاريخ السفر' : 'Departure Date' }}
                </span>
                <input
                    type="date"
                    v-model="departDate"
                    class="w-full bg-transparent font-bold text-slate-900 text-sm focus:outline-none cursor-pointer"
                />
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
                    <option value="economy">{{ isAr ? '1 مسافر، الدرجة السياحية' : '1 Traveler, Economy' }}</option>
                    <option value="business">{{ isAr ? '1 مسافر، درجة الأعمال' : '1 Traveler, Business Class' }}</option>
                    <option value="first">{{ isAr ? '1 مسافر، الدرجة الأولى الفاخرة' : '1 Traveler, First Suite' }}</option>
                </select>
            </div>

            <!-- Submit CTA Button -->
            <div>
                <button
                    type="button"
                    @click="handleSearch"
                    :disabled="isSearching"
                    class="w-full py-4 px-6 rounded-2xl bg-[#1E6BFF] hover:bg-blue-600 text-white font-extrabold text-sm sm:text-base flex items-center justify-center gap-2.5 shadow-lg shadow-blue-500/25 active:scale-98 transition-all cursor-pointer disabled:opacity-75"
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

        <!-- Quick Route Chips -->
        <div class="mt-4 pt-3 flex flex-wrap items-center gap-2 text-xs text-slate-500">
            <span class="font-bold text-slate-600">{{ isAr ? 'المسارات المقترحة:' : 'Popular Routes:' }}</span>
            <button
                type="button"
                @click="origin = 'RUH'; destination = 'MED'"
                class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-[#1E6BFF] transition-colors"
            >
                {{ isAr ? 'الرياض ⇄ المدينة المنورة' : 'RUH ⇄ MED (Madinah)' }}
            </button>
            <button
                type="button"
                @click="origin = 'RUH'; destination = 'JED'"
                class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-[#1E6BFF] transition-colors"
            >
                {{ isAr ? 'الرياض ⇄ جدة (مكة)' : 'RUH ⇄ JED (Makkah)' }}
            </button>
            <button
                type="button"
                @click="origin = 'RUH'; destination = 'ULH'"
                class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-[#1E6BFF] transition-colors"
            >
                {{ isAr ? 'الرياض ⇄ العلا' : 'RUH ⇄ ULH (AlUla)' }}
            </button>
            <button
                type="button"
                @click="origin = 'RUH'; destination = 'RSI'"
                class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-[#1E6BFF] transition-colors"
            >
                {{ isAr ? 'الرياض ⇄ البحر الأحمر' : 'RUH ⇄ RSI (Red Sea)' }}
            </button>
        </div>
    </div>
</template>
