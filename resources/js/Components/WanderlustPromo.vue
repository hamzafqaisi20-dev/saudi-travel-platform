<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { ArrowRight, ArrowLeft, Tag, Sparkles } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr } = useLocale();
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Portrait Photographic Card with Discount Badge (Exact Match to Reference Image) -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-[2.5rem] overflow-hidden aspect-[4/5] shadow-2xl border border-white/60 bg-slate-100">
                    <img
                        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80"
                        alt="Summer Travel by the Sea"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                    />

                    <!-- Interactive 20% Discount Badge at Bottom (Links directly to flight search with promo applied) -->
                    <Link
                        href="/flights?promo=SAUDI20"
                        class="absolute bottom-4 left-4 right-4 sm:left-6 sm:right-6 bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-xl border border-slate-100 flex items-center justify-between transition-all hover:scale-[1.02] cursor-pointer group"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#FAB515] flex items-center justify-center font-black text-sm group-hover:bg-[#FAB515] group-hover:text-[#1B316E] transition-colors">
                                <Tag class="w-5 h-5" />
                            </div>
                            <div>
                                <span class="text-lg sm:text-xl font-black text-[#243E88] block leading-none">
                                    {{ isAr ? 'خصم 20% (كوبون SAUDI20)' : '20% OFF (Code SAUDI20)' }}
                                </span>
                                <span class="text-[11px] font-bold text-slate-400 mt-1 block">
                                    {{ isAr ? 'انقر لتفعيل الخصم على الرحلات' : 'Click to apply discount on flights' }}
                                </span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-emerald-50 text-emerald-600 border border-emerald-200 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            {{ isAr ? 'تفعيل العرض' : 'APPLY' }}
                        </span>
                    </Link>
                </div>
            </div>

            <!-- Right: Bold Typography & Action Banner (Matches Reference Image) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Large Editorial Headline -->
                <div class="space-y-3">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-[#0D1527] uppercase tracking-tight leading-[1.08]">
                        <template v-if="isAr">
                            أطلق شغفك للاستكشاف<br/>
                            مع <span class="text-[#243E88]">Info</span><span class="text-[#FAB515]">Travel</span>
                        </template>
                        <template v-else>
                            UNLEASH<br/>
                            WANDERLUST WITH<br/>
                            <span class="text-[#243E88]">INFO</span><span class="text-[#FAB515]">TRAVEL</span>
                        </template>
                    </h2>
                </div>

                <!-- Editorial Explanations -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm text-slate-600 leading-relaxed">
                    <p>
                        {{ isAr 
                            ? 'نجمع لك أرقى وجهات السياحة السعودية في منصة واحدة متكاملة؛ لتخطيط رحلاتك بين القمم الجبلية في عسير، والآثار النبطية في العلا، وشواطئ البحر الأحمر.' 
                            : 'Travelling Is A Wonderful Way To Explore New Places, Learn About Different Cultures, And Gain Unique Experiences Across The Kingdom.' }}
                    </p>
                    <p>
                        {{ isAr 
                            ? 'احصل على أسعار تفضيلية على رحلات الطيران الداخلية والدولية، مع أدوات ذكاء اصطناعي تفهم ذوقك وتصمم لك جداول يومية لا تُنسى.' 
                            : 'Access curated flight pairings, private resort escapes, and AI-assisted personalized itineraries designed for modern discerning travelers.' }}
                    </p>
                </div>

                <!-- Wide Soft Card CTA Button (Matches Reference: "Book A Flight Now ->" in soft card) -->
                <div class="pt-4">
                    <Link
                        href="/flights"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-5 rounded-2xl bg-gradient-to-r from-slate-50 to-amber-50/50 hover:from-slate-100 hover:to-amber-100/70 border border-slate-200 text-[#0D1527] font-black text-base shadow-sm hover:shadow-md transition-all duration-200 group"
                    >
                        <AircraftIcon className="w-5 h-5 text-[#FAB515]" :angle="isAr ? -45 : 45" />
                        <span>{{ isAr ? 'احجز رحلة طيران الآن' : 'Book A Flight Now' }}</span>
                        <component :is="isAr ? ArrowLeft : ArrowRight" class="w-5 h-5 text-[#243E88] group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
