<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { Compass, Ticket, CreditCard, ArrowRight, ArrowLeft } from 'lucide-vue-next';

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

        <!-- 3 Step Cards (Clean luxury cards without numbers 1, 2, 3 and without airplane icon) -->
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

            <!-- Step 2: Book A Ticket (Highlight Luxury Electric Blue Card - Clean, no numbers, ticket icon) -->
            <div class="relative bg-gradient-to-br from-[#1E6BFF] via-[#1A5ED8] to-[#0F42A6] text-white rounded-3xl p-8 lg:p-9 shadow-2xl shadow-blue-500/25 overflow-hidden flex flex-col justify-between min-h-[340px] lg:-translate-y-2 border border-blue-400/20 group">
                <!-- Subtle luxury decorative ambient glow -->
                <div class="absolute -top-16 -end-16 w-44 h-44 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -start-16 w-44 h-44 bg-blue-900/40 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 space-y-5">
                    <!-- Icon Container (Ticket Icon, no airplane, no 02 number) -->
                    <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center border border-white/20 shadow-sm">
                        <Ticket class="w-6 h-6" />
                    </div>

                    <!-- Title & Description -->
                    <div class="space-y-2">
                        <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight">
                            {{ isAr ? 'احجز تذكرتك بسهولة' : 'Book A Ticket' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-100/90 leading-relaxed font-medium">
                            {{ isAr 
                                ? 'قارن خيارات الرحلات بين الخطوط السعودية وطيران الرياض مع أسعار تنافسية ومواعيد طيران دقيقة.' 
                                : 'Compare direct flight itineraries across Saudia and Riyadh Air with competitive fares and punctual schedules.' }}
                        </p>
                    </div>

                    <!-- Airline Partner Pills & Perks -->
                    <div class="flex flex-wrap gap-2 pt-1">
                        <span class="px-2.5 py-1 rounded-xl bg-white/15 text-white text-[11px] font-bold border border-white/15">
                            {{ isAr ? 'الخطوط السعودية' : 'Saudia' }}
                        </span>
                        <span class="px-2.5 py-1 rounded-xl bg-white/15 text-white text-[11px] font-bold border border-white/15">
                            {{ isAr ? 'طيران الرياض' : 'Riyadh Air' }}
                        </span>
                        <span class="px-2.5 py-1 rounded-xl bg-white/10 text-blue-100 text-[11px] font-medium border border-white/10">
                            {{ isAr ? 'تأكيد فوري' : 'Instant Booking' }}
                        </span>
                    </div>
                </div>

                <!-- Card Footer Link -->
                <div class="relative z-10 pt-6 border-t border-white/20 flex items-center justify-between mt-4">
                    <Link
                        href="/flights"
                        class="inline-flex items-center gap-2 text-xs sm:text-sm font-black text-white tracking-wider hover:translate-x-1 rtl:hover:-translate-x-1 transition-transform group/link"
                    >
                        <span>{{ isAr ? 'احجز التذكرة الآن' : 'BOOK YOUR FLIGHT' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-4 h-4" />
                    </Link>
                </div>
            </div>

            <!-- Step 3: Pay & Start Journey (White soft card - Clean, no numbers) -->
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
