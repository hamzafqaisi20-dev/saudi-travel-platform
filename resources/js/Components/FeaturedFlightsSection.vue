<script setup>
import { ref } from 'vue';
import { useLocale } from '@/composables/useLocale';
import { flightOffers } from '@/data/mockData';
import { Plane, Clock, ShieldCheck, ArrowRight, ArrowLeft, CheckCircle2 } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import CurrencyBadge from '@/Components/CurrencyBadge.vue';

const { isAr } = useLocale();

const selectedOffer = ref(null);
const modalOpen = ref(false);

const openOfferModal = (offer) => {
    selectedOffer.value = offer;
    modalOpen.value = true;
};
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-slate-50/60 rounded-3xl my-10 border border-slate-100">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#243E88] block mb-1">
                    {{ isAr ? 'عروض الطيران المميزة' : 'FEATURED FLIGHT OFFERS' }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'رحلات نموذجية مختارة بأفضل الأسعار' : 'Sample Curated Flight Routes' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                    {{ isAr ? 'أسعار إرشادية توضيحية لرحلات الخطوط الوطنية عبر أهم مطارات المملكة' : 'Illustrative mock fares across prime Saudi domestic and international hubs' }}
                </p>
            </div>
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                {{ isAr ? 'بيانات نموذجية تجريبية' : 'Illustrative Mock Fares' }}
            </span>
        </div>

        <!-- Flight Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
                v-for="flight in flightOffers"
                :key="flight.id"
                class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between"
            >
                <div>
                    <!-- Top Airline & Class Bar -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#243E88] border border-blue-100 flex items-center justify-center font-black text-sm">
                                {{ flight.airlineCode }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">
                                    {{ isAr ? flight.airline.ar : flight.airline.en }}
                                </h4>
                                <span class="text-[11px] text-slate-400 font-mono">{{ flight.flightNumber }} • {{ flight.aircraft }}</span>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                            {{ isAr ? flight.cabinClass.ar : flight.cabinClass.en }}
                        </span>
                    </div>

                    <!-- Flight Itinerary & Timeline -->
                    <div class="py-6 flex items-center justify-between gap-4">
                        <!-- Origin -->
                        <div class="text-center sm:text-start">
                            <span class="text-2xl sm:text-3xl font-black text-[#0D1527] block font-mono">
                                {{ flight.origin.code }}
                            </span>
                            <span class="text-xs font-bold text-slate-600 block">
                                {{ isAr ? flight.origin.city.ar : flight.origin.city.en }}
                            </span>
                            <span class="text-[11px] text-slate-400 block font-mono mt-0.5">
                                {{ flight.departureTime }}
                            </span>
                        </div>

                        <!-- Flight Duration Vector Graphic -->
                        <div class="flex-1 flex flex-col items-center px-4">
                            <span class="text-[11px] font-bold text-slate-400 flex items-center gap-1 mb-1">
                                <Clock class="w-3 h-3" />
                                {{ flight.duration }}
                            </span>
                            <div class="w-full flex items-center gap-1">
                                <div class="w-2 h-2 rounded-full bg-[#FAB515]"></div>
                                <div class="flex-1 border-t-2 border-dashed border-slate-300 relative">
                                    <AircraftIcon className="w-5 h-5 text-[#243E88] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" :angle="isAr ? -90 : 90" />
                                </div>
                                <div class="w-2 h-2 rounded-full bg-[#243E88]"></div>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-600 mt-1">
                                {{ isAr ? flight.stops.ar : flight.stops.en }}
                            </span>
                        </div>

                        <!-- Destination -->
                        <div class="text-center sm:text-end">
                            <span class="text-2xl sm:text-3xl font-black text-[#0D1527] block font-mono">
                                {{ flight.destination.code }}
                            </span>
                            <span class="text-xs font-bold text-slate-600 block">
                                {{ isAr ? flight.destination.city.ar : flight.destination.city.en }}
                            </span>
                            <span class="text-[11px] text-slate-400 block font-mono mt-0.5">
                                {{ flight.arrivalTime }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Bottom: Price & Select Button -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase block">
                            {{ isAr ? 'السعر التوضيحي' : 'Illustrative Fare' }}
                        </span>
                        <div class="mt-1">
                            <CurrencyBadge :amount="flight.priceSAR" size="lg" />
                        </div>
                    </div>

                    <button
                        type="button"
                        @click="openOfferModal(flight)"
                        class="px-5 py-2.5 rounded-full bg-[#243E88] hover:bg-[#1B316E] text-white hover:text-[#FAB515] text-xs font-bold transition-all shadow-md active:scale-95 cursor-pointer"
                    >
                        {{ isAr ? 'استعراض الرحلة' : 'Select Flight' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Flight Detail & Prototype Notice Modal -->
        <div v-if="modalOpen && selectedOffer" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full card-soft-shadow border border-slate-100 space-y-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <Plane class="w-5 h-5 text-[#FAB515]" />
                        <h3 class="text-lg font-black text-slate-900">
                            {{ isAr ? 'تفاصيل الرحلة النموذجية' : 'Sample Flight Preview' }}
                        </h3>
                    </div>
                    <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-700 text-lg p-1">✕</button>
                </div>

                <div class="p-4 rounded-2xl bg-blue-50/70 border border-blue-100 text-xs text-blue-900 space-y-2">
                    <div class="flex items-center gap-2 font-bold text-sm text-[#243E88]">
                        <ShieldCheck class="w-4 h-4 text-[#FAB515]" />
                        <span>{{ isAr ? 'تنبيه العرض التجريبي (Phase One)' : 'Prototype Demonstration Only' }}</span>
                    </div>
                    <p>
                        {{ isAr 
                            ? 'هذا العرض مخصص لأغراض استعراض واجهات المستخدم فقط. لا يتم إجراء أي حجز فعلي أو خصم مالي في هذه المرحلة.' 
                            : 'This interface is an illustrative design showcase. No real flight reservations, inventory queries, or payment transactions are processed.' }}
                    </p>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">{{ isAr ? 'الناقل الجوي:' : 'Airline:' }}</span>
                        <span class="font-bold text-slate-900">{{ isAr ? selectedOffer.airline.ar : selectedOffer.airline.en }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">{{ isAr ? 'المسار:' : 'Route:' }}</span>
                        <span class="font-bold text-slate-900">{{ selectedOffer.origin.code }} → {{ selectedOffer.destination.code }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">{{ isAr ? 'الدرجة:' : 'Cabin Class:' }}</span>
                        <span class="font-bold text-slate-900">{{ isAr ? selectedOffer.cabinClass.ar : selectedOffer.cabinClass.en }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100 items-center">
                        <span class="text-slate-500">{{ isAr ? 'السعر الاسترشادي:' : 'Mock Fare:' }}</span>
                        <CurrencyBadge :amount="selectedOffer.priceSAR" size="md" />
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <button
                        @click="modalOpen = false"
                        class="w-full py-3 rounded-full bg-[#243E88] text-white text-xs font-bold hover:bg-[#1B316E] transition-colors"
                    >
                        {{ isAr ? 'إغلاق المعاينة' : 'Close Preview' }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
