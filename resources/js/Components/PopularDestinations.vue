<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { destinations } from '@/data/mockData';
import CurrencyBadge from '@/Components/CurrencyBadge.vue';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import { MapPin, Star, ChevronLeft, ChevronRight, ArrowRight, ArrowLeft } from 'lucide-vue-next';

const { isAr } = useLocale();

// Slider state
const currentIndex = ref(0);
const sliderTrack = ref(null);
const isHovered = ref(false);

// Calculate max steps based on viewport (desktop shows 3 cards, tablet 2, mobile 1)
const itemsCount = destinations.length;

const nextSlide = () => {
    if (currentIndex.value < itemsCount - 1) {
        currentIndex.value++;
    } else {
        currentIndex.value = 0; // loop back smoothly
    }
};

const prevSlide = () => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    } else {
        currentIndex.value = itemsCount - 1;
    }
};

const goToSlide = (index) => {
    currentIndex.value = index;
};

// Autoplay interval (pauses on hover)
let autoplayTimer = null;
onMounted(() => {
    autoplayTimer = setInterval(() => {
        if (!isHovered.value) {
            nextSlide();
        }
    }, 5500);
});

onUnmounted(() => {
    if (autoplayTimer) clearInterval(autoplayTimer);
});
</script>

<template>
    <section
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16"
        @mouseenter="isHovered = true"
        @mouseleave="isHovered = false"
    >
        <!-- Header with Controls (Direct Match to Reference: round buttons < >) -->
        <div class="flex items-end justify-between mb-8">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-[#1E6BFF] mb-1">
                    <AircraftIcon className="w-4 h-4 text-[#1E6BFF]" :angle="-35" />
                    <span>{{ isAr ? 'الوجهات الأكثر طلباً' : 'POPULAR DESTINATIONS' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0D1527] tracking-tight">
                    {{ isAr ? 'أبرز الوجهات السياحية' : 'Popular Destination' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                    {{ isAr ? 'أطلق شغفك للاستكشاف مع أجنحة السعودية' : 'Unleash Your Wanderlust With SkyWings' }}
                </p>
            </div>

            <!-- Slider Arrows (Direct Match to Reference: round buttons < >) -->
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    @click="prevSlide"
                    class="w-11 h-11 rounded-full border border-slate-200 hover:border-[#1E6BFF] bg-white text-slate-800 hover:text-[#1E6BFF] flex items-center justify-center transition-all cursor-pointer shadow-sm hover:scale-105 active:scale-95"
                    :aria-label="isAr ? 'الوجهة السابقة' : 'Previous destination'"
                >
                    <component :is="isAr ? ChevronRight : ChevronLeft" class="w-5 h-5" />
                </button>
                <button
                    type="button"
                    @click="nextSlide"
                    class="w-11 h-11 rounded-full bg-[#0D1527] hover:bg-[#1E6BFF] text-white flex items-center justify-center transition-all cursor-pointer shadow-md hover:scale-105 active:scale-95"
                    :aria-label="isAr ? 'الوجهة التالية' : 'Next destination'"
                >
                    <component :is="isAr ? ChevronLeft : ChevronRight" class="w-5 h-5" />
                </button>
            </div>
        </div>

        <!-- Slider Carousel Container (Smooth animated track) -->
        <div class="relative overflow-hidden rounded-3xl -mx-2 px-2 py-4">
            <div
                ref="sliderTrack"
                class="flex transition-transform duration-500 ease-out gap-6"
                :style="{
                    transform: isAr 
                        ? `translateX(${currentIndex * (100 / (windowWidth > 1024 ? 3 : (windowWidth > 640 ? 2 : 1)))}%)`
                        : `translateX(-${currentIndex * 33.33}%)`
                }"
            >
                <div
                    v-for="item in destinations"
                    :key="item.id"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] shrink-0 group bg-white rounded-[2rem] overflow-hidden card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between"
                >
                    <div>
                        <!-- Photographic Card Image -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img
                                :src="item.image"
                                :alt="item.title.en"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                loading="lazy"
                            />
                            <!-- Top Badges -->
                            <div class="absolute top-3.5 inset-x-3.5 flex items-center justify-between pointer-events-none">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 backdrop-blur-md text-slate-800 shadow-sm">
                                    {{ isAr ? item.category.ar : item.category.en }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-black bg-[#1E6BFF] text-white shadow-sm flex items-center gap-1 font-mono">
                                    <AircraftIcon className="w-3 h-3 text-white" :angle="45" />
                                    <span>{{ item.code }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-base sm:text-lg font-black text-slate-900 group-hover:text-[#1E6BFF] transition-colors leading-snug">
                                    {{ isAr ? item.title.ar : item.title.en }}
                                </h3>
                                <!-- Blue Rating Pill (Matches Reference Image: ★ 4.7) -->
                                <div class="shrink-0 flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#1E6BFF] text-white text-xs font-black shadow-sm">
                                    <Star class="w-3 h-3 fill-current" />
                                    <span>{{ item.rating }}</span>
                                </div>
                            </div>

                            <!-- Location Pin (Matches Reference Image) -->
                            <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium mb-3">
                                <MapPin class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                <span>{{ isAr ? item.location.ar : item.location.en }}</span>
                            </div>

                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ isAr ? item.description.ar : item.description.en }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer with Luxury Currency Badge -->
                    <div class="px-5 sm:px-6 pb-5 pt-3 border-t border-slate-50 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">
                                {{ isAr ? 'يبدأ من' : 'Starts from' }}
                            </span>
                            <CurrencyBadge :amount="item.priceFrom" size="md" />
                        </div>

                        <Link
                            :href="`/destinations?id=${item.id}`"
                            class="inline-flex items-center gap-1 text-xs font-bold text-slate-700 group-hover:text-[#1E6BFF] transition-colors"
                        >
                            <span>{{ isAr ? 'تفاصيل الوجهة' : 'View Details' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Dots Indicator -->
        <div class="flex items-center justify-center gap-2 mt-6">
            <button
                v-for="(_, idx) in destinations"
                :key="idx"
                type="button"
                @click="goToSlide(idx)"
                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                :class="currentIndex === idx ? 'w-8 bg-[#1E6BFF]' : 'w-2 bg-slate-300 hover:bg-slate-400'"
                :aria-label="`Slide ${idx + 1}`"
            ></button>
        </div>
    </section>
</template>
