<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { Play, ArrowUpRight, ArrowRight, ArrowLeft } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr } = useLocale();

const videoModalOpen = ref(false);
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2 sm:pt-4 pb-8 sm:pb-12">
        <!-- Main Curved Hero Container (Visual match to reference image) -->
        <div class="relative w-full rounded-[2.5rem] sm:rounded-[3.2rem] overflow-hidden min-h-[560px] sm:min-h-[600px] lg:min-h-[620px] xl:min-h-[660px] 2xl:min-h-[700px] flex flex-col justify-between p-5 sm:p-10 lg:p-14 pb-24 sm:pb-12 shadow-2xl shadow-blue-500/10 border border-white/60 bg-slate-900">
            <!-- Saudi Aviation & Iconic Landscape Panoramic Background (Towers prominent and visible in both languages) -->
            <img
                src="/images/saudi_wings_hero.jpg"
                :alt="isAr ? 'رحلات أجنحة السعودية الفاخرة فوق الرياض والعلا' : 'Saudi Wings Aviation over Riyadh and AlUla'"
                class="absolute inset-0 w-full h-full object-cover object-bottom sm:object-center select-none pointer-events-none transition-transform duration-700 ease-in-out hover:scale-105"
                :style="{ transform: isAr ? 'scaleX(1)' : 'scaleX(-1)' }"
            />

            <!-- Directional Soft Sky/Atmospheric Glass Gradient Overlay to guarantee 100% text readability -->
            <div
                class="absolute inset-0 pointer-events-none z-10 transition-all duration-300"
                :class="isAr 
                    ? 'bg-gradient-to-b sm:bg-gradient-to-l from-white/95 via-white/85 sm:via-45% to-white/10 sm:to-transparent' 
                    : 'bg-gradient-to-b sm:bg-gradient-to-r from-white/95 via-white/85 sm:via-45% to-white/10 sm:to-transparent'"
            ></div>

            <!-- Atmospheric Ambient Clouds Overlay -->
            <div class="absolute inset-0 pointer-events-none opacity-40 mix-blend-overlay z-10">
                <div class="absolute top-10 left-1/4 w-96 h-96 rounded-full bg-white/70 blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-[500px] h-[500px] rounded-full bg-white/80 blur-3xl"></div>
            </div>

            <!-- Hero Content Grid -->
            <div class="relative z-20 max-w-2xl flex flex-col justify-between h-full pt-2 sm:pt-6">
                <!-- Vertical Progress / Steps (Matches 1, 2, 3 indicators in reference image) -->
                <!-- Typography & Call to Action -->
                <div class="space-y-3 sm:space-y-6">
                        <!-- Top Tagline (Reference: ELEVATE YOUR TRAVEL JOURNEY) -->
                        <div class="inline-flex items-center gap-2">
                            <span class="text-[11px] sm:text-sm font-bold tracking-wider uppercase text-slate-700">
                                {{ isAr ? 'ارتقِ بتجربة سفرك نحو آفاق جديدة' : 'ELEVATE YOUR TRAVEL JOURNEY' }}
                            </span>
                        </div>

                        <!-- Main Bold Headline (Reference: Experience The Magic Of Flight! - Identical 3-line layout) -->
                        <h1 class="text-[32px] sm:text-5xl lg:text-7xl font-extrabold lg:font-black text-[#0D1527] leading-[1.12] sm:leading-[1.08] tracking-tight">
                            <template v-if="isAr">
                                عِش سحر<br/>
                                الطيران نحو<br/>
                                <span class="text-[#1E6BFF]">وجهات المملكة!</span>
                            </template>
                            <template v-else>
                                Experience<br/>
                                The Magic Of<br/>
                                <span class="text-[#1E6BFF]">Flight!</span>
                            </template>
                        </h1>

                        <!-- Supporting Editorial Line -->
                        <p class="text-xs sm:text-base text-slate-700 font-medium max-w-lg leading-relaxed">
                            {{ isAr 
                                ? 'اكتشف روائع العلا والبحر الأحمر والرياض وجدة على متن أحدث أساطيل الطيران مع تجارب صُممت خصيصاً لأجلك.' 
                                : 'Discover the timeless marvels of AlUla, pristine Red Sea coral archipelagos, and vibrant Riyadh aboard modern flag-carrier fleets.' }}
                        </p>

                        <!-- CTA Row (Reference: Blue Pill Button + Circular Play Button) -->
                        <div class="pt-2 sm:pt-4 flex flex-wrap items-center gap-3 sm:gap-4">
                            <!-- Blue Pill CTA: Book A Trip Now -->
                            <Link
                                href="/flights"
                                class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full bg-[#1E6BFF] hover:bg-blue-600 text-white font-extrabold text-xs sm:text-base shadow-xl shadow-blue-600/30 hover:shadow-2xl hover:shadow-blue-600/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200"
                            >
                                <AircraftIcon className="w-4 h-4 sm:w-5 sm:h-5 text-white shrink-0" :angle="isAr ? -45 : 45" />
                                <span>{{ isAr ? 'احجز رحلتك الآن' : 'Book A Trip Now' }}</span>
                            </Link>

                            <!-- Circular Play Icon (Video Modal Trigger) -->
                            <button
                                type="button"
                                @click="videoModalOpen = true"
                                class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white hover:bg-slate-50 text-[#1E6BFF] flex items-center justify-center shadow-md hover:scale-105 active:scale-95 transition-all cursor-pointer shrink-0"
                                :title="isAr ? 'مشاهدة الفيديو التعريفي' : 'Watch Showcase Reel'"
                            >
                                <Play class="w-4 h-4 sm:w-5 sm:h-5 fill-current ml-0.5" />
                            </button>
                        </div>
                    </div>
                </div>

            <!-- Signature Bottom Nested Cutout Badge (Direct Match to Reference Image with dynamic placement) -->
            <div
                class="absolute bottom-0 z-30 bg-white/95 backdrop-blur-md pt-3.5 px-4 sm:px-8 pb-3.5 sm:pb-6 shadow-xl flex items-center gap-3 sm:gap-6 border-slate-100"
                :class="isAr 
                    ? 'left-0 rounded-tr-[2rem] sm:rounded-tr-[3.2rem] rounded-bl-[2.2rem] sm:rounded-bl-none border-t border-r' 
                    : 'right-0 rounded-tl-[2rem] sm:rounded-tl-[3.2rem] rounded-br-[2.2rem] sm:rounded-br-none border-t border-l'"
            >
                <!-- Circular Avatar Thumbnails -->
                <div class="flex items-center -space-x-2.5 sm:-space-x-3 rtl:space-x-reverse shrink-0">
                    <img
                        class="w-9 h-9 sm:w-13 sm:h-13 rounded-full object-cover border-2 border-white shadow-sm ring-1 ring-slate-100"
                        src="https://images.unsplash.com/photo-1682687220063-4742bd7fd538?auto=format&fit=crop&w=200&q=80"
                        alt="AlUla"
                    />
                    <img
                        class="w-9 h-9 sm:w-13 sm:h-13 rounded-full object-cover border-2 border-white shadow-sm ring-1 ring-slate-100"
                        src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=200&q=80"
                        alt="Red Sea"
                    />
                    <img
                        class="w-9 h-9 sm:w-13 sm:h-13 rounded-full object-cover border-2 border-white shadow-sm ring-1 ring-slate-100"
                        src="https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=200&q=80"
                        alt="Riyadh"
                    />
                </div>

                <!-- Text & Know More Arrow -->
                <div class="flex flex-col">
                    <Link
                        href="/discover"
                        class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-extrabold text-slate-900 hover:text-[#1E6BFF] transition-colors group"
                    >
                        <span>{{ isAr ? 'اكتشف المزيد' : 'Know More' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" />
                    </Link>
                    <span class="text-[10px] sm:text-xs font-bold text-slate-800">
                        {{ isAr ? 'أماكن مذهلة' : 'Awesome Places' }}
                    </span>
                    <span class="text-[9px] sm:text-[10px] text-slate-400 hidden sm:inline">
                        {{ isAr ? 'اكتشف المملكة مغامرة تلو الأخرى!' : 'Discover The World One Adventure At A Time!' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Video Showcase Modal -->
        <div v-if="videoModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm animate-in fade-in">
            <div class="relative w-full max-w-3xl bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-slate-700 p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                    <h3 class="text-white font-bold text-base sm:text-lg">
                        {{ isAr ? 'سحر الطيران واكتشاف السعودية' : 'The Magic of Saudi Flight Experience' }}
                    </h3>
                    <button
                        @click="videoModalOpen = false"
                        class="text-slate-400 hover:text-white p-2"
                    >
                        ✕
                    </button>
                </div>
                <div class="mt-4 aspect-video bg-black rounded-2xl flex items-center justify-center relative overflow-hidden">
                    <img
                        src="/images/saudi_wings_hero.jpg"
                        class="w-full h-full object-cover opacity-60 transition-transform duration-500"
                        :style="{ transform: isAr ? 'scaleX(1)' : 'scaleX(-1)' }"
                        alt="Preview"
                    />
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent">
                        <div class="w-16 h-16 rounded-full bg-[#1E6BFF] text-white flex items-center justify-center mb-4 shadow-lg animate-pulse">
                            <Play class="w-8 h-8 fill-current ml-1" />
                        </div>
                        <p class="text-white font-bold text-lg max-w-md">
                            {{ isAr ? 'فيديو استعراضي سينمائي للوجهات السعودية الفاخرة' : 'Cinematic Destination Showcase Reel' }}
                        </p>
                        <p class="text-slate-300 text-xs mt-2">
                            {{ isAr ? 'مستوحى من روح السعودية ومواسم الرياض والعلا' : 'Inspired by Visit Saudi and Saudi Vision 2030' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
