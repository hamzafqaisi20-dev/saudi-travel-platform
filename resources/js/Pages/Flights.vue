<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FlightSearchWidget from '@/Components/FlightSearchWidget.vue';
import { flightOffers, sampleAirportCodes } from '@/data/mockData';
import { useLocale } from '@/composables/useLocale';
import { Plane, Filter, Clock, ShieldCheck, ArrowRightLeft, ArrowRight, CheckCircle2, SlidersHorizontal, Tag, Check, X } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import CurrencyBadge from '@/Components/CurrencyBadge.vue';
import SaudiRiyalIcon from '@/Components/SaudiRiyalIcon.vue';

const { isAr } = useLocale();

// Filters state
const selectedAirline = ref('all');
const selectedClass = ref('all');
const maxPrice = ref(2500);
const sortBy = ref('price_asc'); // 'price_asc' | 'duration' | 'earliest'
const promoInput = ref('');
const promoApplied = ref(false);
const promoError = ref(false);

const applyPromoCode = (code) => {
    const val = (code || promoInput.value).trim().toUpperCase();
    if (val === 'SAUDI20') {
        promoApplied.value = true;
        promoInput.value = 'SAUDI20';
        promoError.value = false;
    } else {
        promoError.value = true;
        promoApplied.value = false;
    }
};

const removePromoCode = () => {
    promoApplied.value = false;
    promoInput.value = '';
    promoError.value = false;
};

const getFlightPrice = (price) => {
    return promoApplied.value ? Math.round(price * 0.8) : price;
};

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    if (params.get('airline')) {
        selectedAirline.value = params.get('airline');
    }
    if (params.get('promo') === 'SAUDI20') {
        applyPromoCode('SAUDI20');
    }
});

const filteredFlights = computed(() => {
    return flightOffers.filter(f => {
        if (selectedAirline.value !== 'all' && f.airlineCode !== selectedAirline.value) return false;
        const currentPrice = getFlightPrice(f.priceSAR);
        if (currentPrice > maxPrice.value) return false;
        return true;
    }).sort((a, b) => {
        const priceA = getFlightPrice(a.priceSAR);
        const priceB = getFlightPrice(b.priceSAR);
        if (sortBy.value === 'price_asc') return priceA - priceB;
        if (sortBy.value === 'price_desc') return priceB - priceA;
        return 0;
    });
});

const activeModalFlight = ref(null);
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'حجز الطيران - InfoTravel' : 'Flight Booking - InfoTravel'" />

        <!-- Page Header Banner -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold mb-4 border border-blue-500/30">
                        <Plane class="w-3.5 h-3.5" />
                        {{ isAr ? 'رحلات الطيران الفاخرة' : 'PREMIUM AIR TRAVEL' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                        {{ isAr ? 'احجز رحلتك القادمة عبر سماء المملكة' : 'Fly Across The Kingdom in Pure Comfort' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium mt-3 leading-relaxed">
                        {{ isAr 
                            ? 'استعرض رحلات الخطوط السعودية، طيران الرياض، والناقلين الإقليميين بأسعار توضيحية وتجربة مستخدم لا مثيل لها.'
                            : 'Explore illustrative flight schedules and bespoke services across Saudi Arabia’s world-class airport infrastructure.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Search Bar Overlay -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
            <FlightSearchWidget />
        </div>

        <!-- Main Flights Results & Filter Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <!-- Prototype Disclaimer Notice -->
            <div class="mb-8 p-4 rounded-2xl bg-amber-50 border border-amber-200/80 text-xs text-amber-900 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <ShieldCheck class="w-4 h-4 text-amber-600 shrink-0" />
                    <span>
                        {{ isAr 
                            ? 'ملاحظة توضيحية: هذه العروض والمواعيد والأسعار هي بيانات تجريبية (Mock Data) للاستعراض، ولا تشكل نظام حجز حي أو شراء فعلي.' 
                            : 'Demonstration Notice: Displayed fares and schedules are realistic mock data for UI showcase purposes only. No actual tickets are issued.' }}
                    </span>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-amber-200/60 font-bold text-amber-800 text-[10px]">
                    Phase 1 Demo
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Filters (1 col) -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow border border-slate-100 h-fit space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                            <SlidersHorizontal class="w-4 h-4 text-[#243E88]" />
                            {{ isAr ? 'تصفية النتائج' : 'Filter Flights' }}
                        </h3>
                        <button
                            @click="selectedAirline = 'all'; maxPrice = 2500; sortBy = 'price_asc'"
                            class="text-xs text-[#243E88] hover:underline"
                        >
                            {{ isAr ? 'إعادة ضبط' : 'Reset' }}
                        </button>
                    </div>

                    <!-- Airline Filter -->
                    <div class="space-y-2 text-xs">
                        <label class="font-bold text-slate-700 block">{{ isAr ? 'شركة الطيران' : 'Airline' }}</label>
                        <select v-model="selectedAirline" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900">
                            <option value="all">{{ isAr ? 'جميع خطوط الطيران' : 'All Airlines' }}</option>
                            <option value="SV">{{ isAr ? 'الخطوط السعودية (SV)' : 'Saudia (SV)' }}</option>
                            <option value="RX">{{ isAr ? 'طيران الرياض (RX)' : 'Riyadh Air (RX)' }}</option>
                            <option value="XY">{{ isAr ? 'طيران ناس (XY)' : 'flynas (XY)' }}</option>
                        </select>
                    </div>

                    <!-- Max Price Slider -->
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between font-bold text-slate-700 items-center">
                            <span>{{ isAr ? 'الحد الأقصى للسعر:' : 'Max Fare:' }}</span>
                            <CurrencyBadge :amount="maxPrice" size="sm" />
                        </div>
                        <input
                            type="range"
                            min="300"
                            max="3000"
                            step="100"
                            v-model.number="maxPrice"
                            class="w-full accent-[#243E88] cursor-pointer"
                        />
                    </div>

                    <!-- Sort By -->
                    <div class="space-y-2 text-xs">
                        <label class="font-bold text-slate-700 block">{{ isAr ? 'الترتيب حسب' : 'Sort By' }}</label>
                        <select v-model="sortBy" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900">
                            <option value="price_asc">{{ isAr ? 'الأقل سعراً أولاً' : 'Lowest Fare First' }}</option>
                            <option value="price_desc">{{ isAr ? 'الأعلى سعراً أولاً' : 'Highest Fare First' }}</option>
                        </select>
                    </div>

                    <!-- Promo Code / 20% Discount Feature -->
                    <div class="pt-4 border-t border-slate-100 space-y-2 text-xs">
                        <label class="font-bold text-slate-700 flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-[#243E88]">
                                <Tag class="w-3.5 h-3.5 text-[#FAB515]" />
                                {{ isAr ? 'كوبون الخصم (20% OFF)' : 'Promo Code (20% OFF)' }}
                            </span>
                            <span v-if="promoApplied" class="text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                {{ isAr ? 'مُفعّل' : 'Active' }}
                            </span>
                        </label>

                        <div v-if="!promoApplied" class="flex items-center gap-1.5">
                            <input
                                type="text"
                                v-model="promoInput"
                                :placeholder="isAr ? 'أدخل SAUDI20' : 'Enter SAUDI20'"
                                class="w-full uppercase tracking-wider font-mono p-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-900 placeholder:normal-case placeholder:font-normal placeholder:tracking-normal"
                                @keyup.enter="applyPromoCode(promoInput)"
                            />
                            <button
                                type="button"
                                @click="applyPromoCode(promoInput)"
                                class="px-3 py-2 rounded-xl bg-[#243E88] hover:bg-[#1B316E] text-white font-bold text-xs shrink-0 transition-colors"
                            >
                                {{ isAr ? 'تطبيق' : 'Apply' }}
                            </button>
                        </div>

                        <div v-else class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <Check class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span class="font-bold text-[11px] font-mono">SAUDI20 (-20%)</span>
                            </div>
                            <button
                                type="button"
                                @click="removePromoCode"
                                class="text-xs text-red-500 hover:text-red-700 font-bold"
                            >
                                {{ isAr ? 'إلغاء' : 'Remove' }}
                            </button>
                        </div>

                        <p v-if="promoError" class="text-[10px] text-red-500 font-medium">
                            {{ isAr ? 'رمز غير صالح. استخدم SAUDI20 للحصول على خصم 20%.' : 'Invalid code. Use SAUDI20 for 20% off.' }}
                        </p>
                    </div>
                </div>

                <!-- Flight Results List (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <div class="flex items-center justify-between text-xs text-slate-500 pb-2">
                        <span>
                            {{ isAr 
                                ? `تم العثور على ${filteredFlights.length} رحلة نموذجية` 
                                : `Showing ${filteredFlights.length} sample flight offers` }}
                        </span>
                        <span class="font-medium text-slate-400 inline-flex items-center gap-1.5">
                            <span>{{ isAr ? 'جميع الأسعار تشمل الضرائب بالعملة الرسمية' : 'All sample fares in' }}</span>
                            <SaudiRiyalIcon className="h-3.5 w-auto inline-block" color="#94A3B8" />
                        </span>
                    </div>

                    <!-- Flight Item Cards -->
                    <div
                        v-for="flight in filteredFlights"
                        :key="flight.id"
                        class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6"
                    >
                        <!-- Airline & Flight Info -->
                        <div class="flex items-center gap-4 w-full md:w-auto">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#243E88] flex items-center justify-center font-black text-sm shrink-0">
                                {{ flight.airlineCode }}
                            </div>
                            <div>
                                <h4 class="font-extrabold text-slate-900 text-sm">
                                    {{ isAr ? flight.airline.ar : flight.airline.en }}
                                </h4>
                                <span class="text-xs text-slate-400 font-mono">{{ flight.flightNumber }}</span>
                                <span class="inline-block ms-2 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                    {{ isAr ? flight.cabinClass.ar : flight.cabinClass.en }}
                                </span>
                            </div>
                        </div>

                        <!-- Schedule & Route Vector -->
                        <div class="flex items-center justify-between gap-6 w-full md:w-auto flex-1 max-w-md px-2">
                            <div class="text-center sm:text-start">
                                <span class="text-2xl font-black text-slate-900 font-mono block">{{ flight.origin.code }}</span>
                                <span class="text-xs text-slate-500 font-medium block">{{ isAr ? flight.origin.city.ar : flight.origin.city.en }}</span>
                                <span class="text-[11px] text-slate-400 font-mono block">{{ flight.departureTime }}</span>
                            </div>

                            <div class="flex-1 flex flex-col items-center">
                                <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1 mb-1">
                                    <Clock class="w-3 h-3" />
                                    {{ flight.duration }}
                                </span>
                                <div class="w-full flex items-center gap-1">
                                    <div class="w-1.5 h-1.5 rounded-full bg-[#243E88]"></div>
                                    <div class="flex-1 border-t border-dashed border-slate-300 relative">
                                        <AircraftIcon className="w-4 h-4 text-[#FAB515] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" :angle="isAr ? -90 : 90" />
                                    </div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-900"></div>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-600 mt-1">
                                    {{ isAr ? flight.stops.ar : flight.stops.en }}
                                </span>
                            </div>

                            <div class="text-center sm:text-end">
                                <span class="text-2xl font-black text-slate-900 font-mono block">{{ flight.destination.code }}</span>
                                <span class="text-xs text-slate-500 font-medium block">{{ isAr ? flight.destination.city.ar : flight.destination.city.en }}</span>
                                <span class="text-[11px] text-slate-400 font-mono block">{{ flight.arrivalTime }}</span>
                            </div>
                        </div>

                        <!-- Pricing & CTA -->
                        <div class="flex items-center justify-between md:flex-col md:items-end w-full md:w-auto pt-4 md:pt-0 border-t md:border-t-0 border-slate-100 gap-3">
                            <div class="text-start md:text-end">
                                <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">{{ isAr ? 'السعر' : 'Fare' }}</span>
                                <div class="flex items-center gap-2">
                                    <span v-if="promoApplied" class="line-through text-xs text-slate-400">
                                        {{ flight.priceSAR }}
                                    </span>
                                    <CurrencyBadge :amount="getFlightPrice(flight.priceSAR)" size="lg" />
                                </div>
                                <span v-if="promoApplied" class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-600 border border-emerald-200">
                                    {{ isAr ? 'خصم 20% مفعّل' : '20% OFF Applied' }}
                                </span>
                            </div>

                            <button
                                type="button"
                                @click="activeModalFlight = flight"
                                class="px-6 py-2.5 rounded-full bg-[#243E88] hover:bg-[#1B316E] text-white text-xs font-bold transition-all shadow-md active:scale-95 cursor-pointer"
                            >
                                {{ isAr ? 'حجز تجريبي' : 'Book Mock Flight' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mock Booking Modal -->
        <div v-if="activeModalFlight" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full card-soft-shadow border border-slate-100 space-y-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="text-lg font-black text-slate-900">
                        {{ isAr ? 'تأكيد الحجز الاستعراضي' : 'Simulated Flight Confirmation' }}
                    </h3>
                    <button @click="activeModalFlight = null" class="text-slate-400 hover:text-slate-700 text-lg">✕</button>
                </div>

                <div class="p-4 rounded-2xl bg-blue-50 text-xs text-blue-900 space-y-2 border border-blue-100">
                    <p class="font-bold flex items-center gap-1.5 text-blue-700">
                        <CheckCircle2 class="w-4 h-4" />
                        {{ isAr ? 'تم تسجيل اهتمامك بالرحلة بنجاح!' : 'Simulated selection registered successfully!' }}
                    </p>
                    <p>
                        {{ isAr 
                            ? 'في المرحلة الأولى، هذه التجربة مخصصة للعرض التقني والتصميمي، ولا يتم خصم أي مبالغ من بطاقتك.' 
                            : 'In Phase One, this workflow showcases UI interactions only. No payment gateway is connected and no funds are deducted.' }}
                    </p>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-400">{{ isAr ? 'رقم الرحلة:' : 'Flight Number:' }}</span>
                        <span class="font-mono font-bold">{{ activeModalFlight.flightNumber }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-400">{{ isAr ? 'المسار:' : 'Route:' }}</span>
                        <span class="font-bold">{{ activeModalFlight.origin.code }} → {{ activeModalFlight.destination.code }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100 items-center">
                        <span class="text-slate-400">{{ isAr ? 'إجمالي السعر التقديري:' : 'Estimated Fare:' }}</span>
                        <div class="text-end">
                            <span v-if="promoApplied" class="line-through text-xs text-slate-400 block">
                                {{ activeModalFlight.priceSAR }} ر.س
                            </span>
                            <CurrencyBadge :amount="getFlightPrice(activeModalFlight.priceSAR)" size="md" />
                            <span v-if="promoApplied" class="text-[10px] text-emerald-600 font-bold block">
                                {{ isAr ? '(تم تطبيق خصم 20%)' : '(20% Promo Applied)' }}
                            </span>
                        </div>
                    </div>
                </div>

                <button
                    @click="activeModalFlight = null"
                    class="w-full py-3 rounded-full bg-[#243E88] text-white text-xs font-bold hover:bg-[#1B316E] transition-colors"
                >
                    {{ isAr ? 'العودة لصفحة الرحلات' : 'Back to Flights' }}
                </button>
            </div>
        </div>
    </AppLayout>
</template>
