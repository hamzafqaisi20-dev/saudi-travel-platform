<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { Compass, CreditCard, ArrowRight, ArrowLeft } from 'lucide-vue-next';

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

        <!-- 3 Step Cards (Exact Reference Arrangement: White Card, Tall Electric Blue Card with photo cutout, White Card - No numbers) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-center">
            <!-- Step 1: Find Your Destination (White soft card) -->
            <div class="bg-white rounded-3xl p-8 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between min-h-[320px]">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1E6BFF] flex items-center justify-center">
                        <Compass class="w-6 h-6" />
                    </div>
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
            <div class="relative bg-gradient-to-br from-[#1E6BFF] to-[#1250C4] text-white rounded-[2.5rem] p-8 lg:p-10 shadow-2xl shadow-blue-500/25 overflow-hidden flex flex-col justify-between min-h-[400px] lg:-translate-y-2 group">
                <!-- Aviation Window / Clouds Visual (Complements Flight Theme Perfectly) -->
                <div class="absolute top-0 ltr:right-0 rtl:left-0 w-40 h-40 lg:w-48 lg:h-48 ltr:rounded-bl-[4.5rem] rtl:rounded-br-[4.5rem] overflow-hidden border-b-4 ltr:border-l-4 rtl:border-r-4 border-white/20 shadow-inner">
                    <img
                        src="/images/aviation_window.jpg"
                        alt="Flight soaring above clouds"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-blue-900/20 mix-blend-multiply"></div>
                </div>

                <div class="relative z-10 space-y-4 max-w-[65%]">
                    <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight">
                        {{ isAr ? 'احجز تذكرتك بسهولة' : 'Book A Ticket' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-blue-100/90 leading-relaxed font-medium">
                        {{ isAr 
                            ? 'قارن خيارات الرحلات بين الخطوط السعودية وطيران الرياض مع أسعار تنافسية ومواعيد طيران دقيقة.' 
                            : 'Compare direct flight itineraries across Saudia and Riyadh Air with competitive fares and punctual schedules.' }}
                    </p>
                </div>

                <div class="relative z-10 pt-6 border-t border-white/20 flex items-center justify-between">
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
