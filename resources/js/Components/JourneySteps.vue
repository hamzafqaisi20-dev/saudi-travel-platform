<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { Compass, Ticket, CreditCard, ArrowRight, ArrowLeft } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr } = useLocale();
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Header (Matches Reference Image) -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0D1527] tracking-tight">
                {{ isAr ? 'رحلتك إلى السماء أصبحت أسهل وأرقى!' : 'Journey To The Skies Made Simple!' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-3 leading-relaxed">
                {{ isAr 
                    ? 'السفر هو طريقتك المثالية لاستكشاف آفاق جديدة، والتعرف على ثقافات متنوعة، وصناعة ذكريات استثنائية لا تُنسى.'
                    : 'Travelling Is A Wonderful Way To Explore New Places, Learn About Different Cultures, And Gain Unique Experiences.' }}
            </p>
        </div>

        <!-- 3 Step Cards (Exact Reference Arrangement: White Card, Tall Electric Blue Card with photo cutout, White Card) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-center">
            <!-- Step 1: Find Your Destination (White soft card) -->
            <div class="bg-white rounded-3xl p-8 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between min-h-[320px]">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1E6BFF] flex items-center justify-center">
                        <Compass class="w-6 h-6" />
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">01</span>
                    <h3 class="text-xl font-black text-slate-900">
                        {{ isAr ? 'اختر وجهتك المفضلة' : 'Find Your Destination' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        {{ isAr 
                            ? 'استكشف باقة واسعة من كنوز المملكة الطبيعية والتاريخية من العلا والدرعية إلى شواطئ البحر الأحمر.' 
                            : 'Explore our curated portfolio of Saudi heritage treasures, Red Sea archipelagos, and modern cosmopolitan hubs.' }}
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-50">
                    <Link href="/destinations" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1E6BFF] hover:underline">
                        <span>{{ isAr ? 'استكشف الوجهات' : 'Explore Places' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                    </Link>
                </div>
            </div>

            <!-- Step 2: Book A Ticket (Highlight Tall Blue Card with Aviation Visual - Exactly matching image) -->
            <div class="relative bg-gradient-to-br from-[#1E6BFF] to-[#1250C4] text-white rounded-[2.5rem] p-7 sm:p-8 lg:p-9 shadow-2xl shadow-blue-500/25 overflow-hidden flex flex-col justify-between min-h-[420px] lg:-translate-y-2 group">
                <!-- Aviation Window / Clouds Visual (Corner cutout) -->
                <div class="absolute top-0 ltr:right-0 rtl:left-0 w-32 h-32 sm:w-36 sm:h-36 lg:w-40 lg:h-40 ltr:rounded-bl-[3.5rem] rtl:rounded-br-[3.5rem] overflow-hidden border-b-4 ltr:border-l-4 rtl:border-r-4 border-white/20 shadow-inner z-0 pointer-events-none">
                    <img
                        src="/images/aviation_window.jpg"
                        alt="Flight soaring above clouds"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-blue-900/15 mix-blend-multiply"></div>
                </div>

                <!-- Card Content -->
                <div class="relative z-10 space-y-4">
                    <!-- Top Row: Icon + 02 Pill (Positioned opposite the image cutout) -->
                    <div class="flex items-center gap-2.5 max-w-[55%]">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center border border-white/20 shadow-sm shrink-0">
                            <AircraftIcon className="w-5 h-5 sm:w-6 sm:h-6 text-white" :angle="isAr ? -45 : 45" variant="white" />
                        </div>
                        <span class="text-xs font-black tracking-widest text-blue-200 uppercase bg-white/10 px-2.5 py-1 rounded-full border border-white/15">02</span>
                    </div>

                    <!-- Title: Constrained so it NEVER touches or covers the photo cutout -->
                    <div class="max-w-[55%]">
                        <h3 class="text-xl sm:text-2xl font-black text-white leading-tight">
                            {{ isAr ? 'احجز تذكرتك بسهولة' : 'Book A Ticket' }}
                        </h3>
                    </div>

                    <!-- Description: Sits comfortably below the photo, spanning full width -->
                    <p class="text-xs sm:text-sm text-blue-100/95 leading-relaxed font-medium pt-1">
                        {{ isAr 
                            ? 'قارن خيارات الرحلات بين الخطوط السعودية وطيران الرياض مع أسعار تنافسية ومواعيد طيران دقيقة.' 
                            : 'Compare direct flight itineraries across Saudia and Riyadh Air with competitive fares and punctual schedules.' }}
                    </p>
                </div>

                <div class="relative z-10 pt-6 border-t border-white/20 flex items-center justify-between mt-4">
                    <Link
                        href="/flights"
                        class="inline-flex items-center gap-2 text-xs sm:text-sm font-black text-white tracking-wider hover:translate-x-1 rtl:hover:-translate-x-1 transition-transform group/link"
                    >
                        <span>{{ isAr ? 'احجز التذكرة الآن' : 'LEARN MORE' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-4 h-4" />
                    </Link>
                </div>
            </div>

            <!-- Step 3: Pay & Start Journey (White soft card) -->
            <div class="bg-white rounded-3xl p-8 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between min-h-[320px]">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1E6BFF] flex items-center justify-center">
                        <CreditCard class="w-6 h-6" />
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">03</span>
                    <h3 class="text-xl font-black text-slate-900">
                        {{ isAr ? 'انطلق في رحلتك بأمان' : 'Pay & Start Journey' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        {{ isAr 
                            ? 'تجربة دفع وحجز ميسرة مع دعم لوسائل الدفع السعودية المعتمدة وتأكيدات سفر فورية بالباركود.' 
                            : 'Seamless booking checkout with instant digital itineraries, boarding passes, and 24/7 concierge assistance.' }}
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-50">
                    <Link href="/ai-planner" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1E6BFF] hover:underline">
                        <span>{{ isAr ? 'جرّب المخطط الذكي' : 'Plan with AI' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
