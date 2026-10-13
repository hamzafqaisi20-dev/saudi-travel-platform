<script setup>
import { ref, computed, onMounted, onUnmounted, watch, nextTick } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { destinations } from '@/data/mockData';
import CurrencyBadge from '@/Components/CurrencyBadge.vue';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import { 
    MapPin, 
    Star, 
    ChevronLeft, 
    ChevronRight, 
    ArrowRight, 
    ArrowLeft, 
    Sparkles, 
    Compass,
    Eye
} from 'lucide-vue-next';

const { isAr } = useLocale();

// Active category filter state
const selectedCategory = ref('all');

const categories = computed(() => [
    { id: 'all', label: { ar: 'كافة الوجهات', en: 'All Wonders' } },
    { id: 'spiritual', label: { ar: 'مقدسات وروحانيات', en: 'Sacred & Spiritual' } },
    { id: 'heritage', label: { ar: 'تراث وفخامة', en: 'Heritage & Luxury' } },
    { id: 'islands', label: { ar: 'جزر وشواطئ', en: 'Islands & Coast' } },
    { id: 'capital', label: { ar: 'عواصم وترفيه', en: 'Capital & Cities' } },
    { id: 'nature', label: { ar: 'طبيعة ومغامرات', en: 'Nature & Peaks' } }
]);

const filteredDestinations = computed(() => {
    if (selectedCategory.value === 'all') return destinations;
    if (selectedCategory.value === 'spiritual') return destinations.filter(d => d.id === 'makkah' || d.id === 'madinah');
    if (selectedCategory.value === 'heritage') return destinations.filter(d => d.id === 'alula' || d.id === 'madinah');
    if (selectedCategory.value === 'islands') return destinations.filter(d => d.id === 'red-sea' || d.id === 'jeddah');
    if (selectedCategory.value === 'capital') return destinations.filter(d => d.id === 'riyadh');
    if (selectedCategory.value === 'nature') return destinations.filter(d => d.id === 'abha');
    return destinations;
});

// Slider state
const currentIndex = ref(0);
const trackRef = ref(null);
const isHovered = ref(false);
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1200);
const cardStepPx = ref(0);

// Responsive cards per view
const cardsPerView = computed(() => {
    if (windowWidth.value >= 1024) return 3;
    if (windowWidth.value >= 640) return 2;
    return 1;
});

// Max index bounded to prevent whitespace
const maxIndex = computed(() => {
    return Math.max(0, filteredDestinations.value.length - cardsPerView.value);
});

// Reset index if category changes
watch(selectedCategory, () => {
    currentIndex.value = 0;
    nextTick(updateStep);
});

// Navigation handlers (smooth loop)
const nextSlide = () => {
    if (currentIndex.value < maxIndex.value) {
        currentIndex.value++;
    } else {
        currentIndex.value = 0;
    }
};

const prevSlide = () => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    } else {
        currentIndex.value = maxIndex.value;
    }
};

const goToSlide = (index) => {
    if (index > maxIndex.value) {
        currentIndex.value = maxIndex.value;
    } else {
        currentIndex.value = index;
    }
};

// Navigation handlers (Locale-aware directional logic requested by user)
// Navigation handlers synchronized with reading direction
const handleNextClick = () => {
    nextSlide();
};

const handlePrevClick = () => {
    prevSlide();
};

// Interactive Drag state (real-time 1:1 tracking with hand movement)
const isDragging = ref(false);
const dragStartX = ref(0);
const dragDeltaX = ref(0);

const startDrag = (clientX) => {
    isDragging.value = true;
    dragStartX.value = clientX;
    dragDeltaX.value = 0;
    stopAutoplay();
};

const moveDrag = (clientX) => {
    if (!isDragging.value) return;
    dragDeltaX.value = clientX - dragStartX.value;
};

const endDrag = () => {
    if (!isDragging.value) return;
    const delta = dragDeltaX.value;
    isDragging.value = false;
    dragDeltaX.value = 0;

    // 40px threshold to snap to next/prev card
    if (Math.abs(delta) > 40) {
        if (delta > 0) {
            // Hand moved to the RIGHT -> slide cards to the RIGHT!
            if (currentIndex.value > 0) {
                currentIndex.value--;
            }
        } else {
            // Hand moved to the LEFT -> slide cards to the LEFT!
            if (currentIndex.value < maxIndex.value) {
                currentIndex.value++;
            }
        }
    }
    startAutoplay();
};

const handleTouchStart = (e) => {
    if (e.touches && e.touches[0]) {
        startDrag(e.touches[0].clientX);
    }
};

const handleTouchMove = (e) => {
    if (e.touches && e.touches[0]) {
        moveDrag(e.touches[0].clientX);
    }
};

const handleTouchEnd = () => {
    endDrag();
};

const handleMouseDown = (e) => {
    if (e.button !== 0) return;
    startDrag(e.clientX);
    window.addEventListener('mousemove', onWindowMouseMove);
    window.addEventListener('mouseup', onWindowMouseUp);
};

const onWindowMouseMove = (e) => {
    moveDrag(e.clientX);
};

const onWindowMouseUp = () => {
    window.removeEventListener('mousemove', onWindowMouseMove);
    window.removeEventListener('mouseup', onWindowMouseUp);
    endDrag();
};

// Computed CSS transform with live drag offset and pixel + percentage fallback
const currentTranslateStyle = computed(() => {
    const step = cardStepPx.value > 0 ? cardStepPx.value : (windowWidth.value > 1024 ? 380 : 320);
    const baseTranslate = -(currentIndex.value * step);
    const finalTranslate = baseTranslate + dragDeltaX.value;
    return `translateX(${finalTranslate}px)`;
});

// Calculate exact pixel step based on actual rendered card width + gap
const updateStep = () => {
    if (typeof window !== 'undefined') {
        windowWidth.value = window.innerWidth;
    }
    if (trackRef.value && trackRef.value.children[0]) {
        const cardEl = trackRef.value.children[0];
        const cardWidth = cardEl.getBoundingClientRect().width;
        const gap = 24; // gap-6 = 1.5rem = 24px
        if (cardWidth > 0) {
            cardStepPx.value = cardWidth + gap;
        }
    }
};

// Autoplay interval (pauses on hover and while dragging)
let autoplayTimer = null;
const startAutoplay = () => {
    stopAutoplay();
    autoplayTimer = setInterval(() => {
        if (!isHovered.value && !isDragging.value && maxIndex.value > 0) {
            nextSlide();
        }
    }, 6000);
};

const stopAutoplay = () => {
    if (autoplayTimer) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
    }
};

onMounted(() => {
    updateStep();
    nextTick(updateStep);
    window.addEventListener('resize', updateStep);
    startAutoplay();
});

onUnmounted(() => {
    if (typeof window !== 'undefined') {
        window.removeEventListener('resize', updateStep);
        window.removeEventListener('mousemove', onWindowMouseMove);
        window.removeEventListener('mouseup', onWindowMouseUp);
    }
    stopAutoplay();
});
</script>

<template>
    <section
        class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 overflow-hidden"
        @mouseenter="isHovered = true"
        @mouseleave="isHovered = false"
    >
        <!-- Ambient Decorative Glows -->
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-indigo-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div class="max-w-2xl">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-[#0D1527] tracking-tight leading-tight">
                    {{ isAr ? 'أبرز الوجهات السياحية في المملكة' : 'Popular Destinations in Saudi Arabia' }}
                </h2>

                <p class="text-xs sm:text-sm lg:text-base text-slate-500 font-medium mt-2 leading-relaxed">
                    {{ isAr 
                        ? 'أطلق شغفك للاستكشاف مع InfoTravel بين أطهر بقاع الأرض في مكة المكرمة والمدينة المنورة، وكنوز العلا النبطية، وجزر البحر الأحمر البكر.' 
                        : 'Unleash your wanderlust with InfoTravel across holy sanctuaries of Makkah and Madinah, ancient Nabataean wonders, and pristine azure islands.' }}
                </p>
            </div>

            <!-- Slider Arrows & Slide Counter -->
            <div class="flex items-center gap-3 shrink-0 self-end md:self-auto">
                <!-- Slide index counter badge -->
                <div class="hidden sm:flex items-center gap-1 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60 text-xs font-mono font-bold text-slate-600" dir="ltr">
                    <span class="text-[#1E6BFF]">{{ String(currentIndex + 1).padStart(2, '0') }}</span>
                    <span>/</span>
                    <span>{{ String(maxIndex + 1).padStart(2, '0') }}</span>
                </div>

                <!-- Navigation Buttons (Synchronized with reading direction: Next advances, Prev goes back) -->
                <div class="flex items-center gap-2">
                    <!-- Previous Button -->
                    <button
                        type="button"
                        @click="handlePrevClick"
                        class="w-11 h-11 rounded-full flex items-center justify-center transition-all cursor-pointer shadow-sm hover:scale-105 active:scale-95 border border-slate-200 hover:border-[#1E6BFF] bg-white text-slate-800 hover:text-[#1E6BFF] hover:bg-blue-50/40"
                        :aria-label="isAr ? 'السابق' : 'Previous destination'"
                        :title="isAr ? 'السابق' : 'Previous'"
                    >
                        <component :is="isAr ? ChevronRight : ChevronLeft" class="w-5 h-5" />
                    </button>

                    <!-- Next Button -->
                    <button
                        type="button"
                        @click="handleNextClick"
                        class="w-11 h-11 rounded-full flex items-center justify-center transition-all cursor-pointer shadow-md hover:shadow-blue-500/25 hover:scale-105 active:scale-95 bg-[#0D1527] hover:bg-[#1E6BFF] text-white"
                        :aria-label="isAr ? 'التالي' : 'Next destination'"
                        :title="isAr ? 'التالي' : 'Next'"
                    >
                        <component :is="isAr ? ChevronLeft : ChevronRight" class="w-5 h-5" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Category Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-6 scrollbar-none">
            <button
                v-for="cat in categories"
                :key="cat.id"
                type="button"
                @click="selectedCategory = cat.id"
                class="px-4 py-2 rounded-full text-xs font-bold transition-all whitespace-nowrap cursor-pointer shrink-0"
                :class="selectedCategory === cat.id
                    ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20'
                    : 'bg-white text-slate-600 hover:text-[#1E6BFF] hover:bg-slate-100/80 border border-slate-200/70'"
            >
                {{ isAr ? cat.label.ar : cat.label.en }}
            </button>
        </div>

        <!-- Slider Carousel Container (Interactive drag & swipe) -->
        <div
            class="relative overflow-hidden rounded-[2.5rem] -mx-2 px-2 py-4 select-none touch-pan-y"
            dir="ltr"
            @touchstart="handleTouchStart"
            @touchmove="handleTouchMove"
            @touchend="handleTouchEnd"
            @mousedown="handleMouseDown"
        >
            <div
                ref="trackRef"
                class="flex gap-6 will-change-transform"
                :class="isDragging ? 'transition-none cursor-grabbing' : 'transition-transform duration-500 ease-out cursor-grab'"
                :style="{ transform: currentTranslateStyle }"
            >
                <div
                    v-for="item in filteredDestinations"
                    :key="item.id"
                    :dir="isAr ? 'rtl' : 'ltr'"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] shrink-0 group bg-white rounded-[2rem] overflow-hidden card-soft-shadow hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1.5 transition-all duration-300 border border-slate-100 flex flex-col justify-between"
                >
                    <div>
                        <!-- Photographic Card Image with Luxury Badging -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img
                                :src="item.image"
                                :alt="isAr ? item.title.ar : item.title.en"
                                class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700"
                                loading="lazy"
                            />
                            
                            <!-- Subtle bottom gradient for contrast -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 pointer-events-none"></div>

                            <!-- Top Badges Row -->
                            <div class="absolute top-3.5 inset-x-3.5 flex items-center justify-between pointer-events-none z-10">
                                <!-- Distinctive Golden/Amber Feature Ribbon -->
                                <span class="px-3 py-1 rounded-full text-xs font-black bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md flex items-center gap-1 tracking-wide">
                                    <Sparkles class="w-3 h-3 text-amber-200" />
                                    <span>{{ isAr ? item.badge.ar : item.badge.en }}</span>
                                </span>

                                <!-- Airport IATA Code Pill -->
                                <span class="px-2.5 py-1 rounded-full text-xs font-black bg-black/60 backdrop-blur-md text-white border border-white/20 shadow-sm flex items-center gap-1 font-mono">
                                    <AircraftIcon className="w-3 h-3 text-white" :angle="45" />
                                    <span>{{ item.code }}</span>
                                </span>
                            </div>

                            <!-- Bottom Floating Category -->
                            <div class="absolute bottom-3 inset-x-3.5 flex items-center justify-between pointer-events-none z-10">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    {{ isAr ? item.category.ar : item.category.en }}
                                </span>
                                <!-- Location Pin -->
                                <div class="flex items-center gap-1 text-[11px] font-semibold text-white/90 drop-shadow-sm">
                                    <MapPin class="w-3 h-3 text-amber-400 shrink-0" />
                                    <span>{{ isAr ? item.location.ar : item.location.en }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6">
                            <!-- Title & Rating Header -->
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 group-hover:text-[#1E6BFF] transition-colors leading-snug">
                                    {{ isAr ? item.title.ar : item.title.en }}
                                </h3>

                                <!-- Star Rating Badge -->
                                <div class="shrink-0 flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#1E6BFF] text-white text-xs font-black shadow-sm">
                                    <Star class="w-3 h-3 fill-current text-amber-300" />
                                    <span>{{ item.rating }}</span>
                                </div>
                            </div>

                            <!-- Destination Description -->
                            <p class="text-xs sm:text-[13px] text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                {{ isAr ? item.description.ar : item.description.en }}
                            </p>

                            <!-- Key Highlights Chips (Shows rich tourist features) -->
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                <span
                                    v-for="(tag, tIdx) in (isAr ? item.highlights.ar.slice(0, 3) : item.highlights.en.slice(0, 3))"
                                    :key="tIdx"
                                    class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 group-hover:bg-blue-50 group-hover:text-[#1E6BFF] transition-colors"
                                >
                                    {{ tag }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer with Luxury Currency Badge & Action CTA -->
                    <div class="px-5 sm:px-6 pb-5 pt-3 border-t border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">
                                {{ isAr ? 'يبدأ السعر من' : 'Starts from' }}
                            </span>
                            <CurrencyBadge :amount="item.priceFrom" size="md" />
                        </div>

                        <Link
                            :href="`/destinations?id=${item.id}`"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full text-xs font-bold bg-slate-900 text-white group-hover:bg-[#1E6BFF] transition-all shadow-sm group-hover:shadow-md group-hover:shadow-blue-500/20 active:scale-95"
                        >
                            <span>{{ isAr ? 'استكشف الوجهة' : 'View Details' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Dots Indicator with Click Support (Stable LTR alignment to match cards) -->
        <div class="flex items-center justify-center gap-2 mt-8" dir="ltr">
            <button
                v-for="(_, idx) in (maxIndex + 1)"
                :key="idx"
                type="button"
                @click="goToSlide(idx)"
                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                :class="currentIndex === idx ? 'w-8 bg-[#1E6BFF]' : 'w-2 bg-slate-300 hover:bg-slate-400'"
                :aria-label="`Slide ${idx + 1}`"
            ></button>
        </div>

        <!-- Bottom Explore All Destinations CTA -->
        <div class="mt-10 text-center">
            <Link
                href="/destinations"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs sm:text-sm font-bold bg-white text-slate-800 hover:text-[#1E6BFF] border border-slate-200 hover:border-[#1E6BFF] shadow-sm hover:shadow-md transition-all active:scale-95"
            >
                <Compass class="w-4 h-4 text-[#1E6BFF]" />
                <span>{{ isAr ? 'استعرض كافة الوجهات والمعالم السياحية بالمملكة (12+ وجهة)' : 'Browse All 12+ Saudi Destinations & Attractions' }}</span>
                <component :is="isAr ? ArrowLeft : ArrowRight" class="w-4 h-4" />
            </Link>
        </div>
    </section>
</template>
