<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { destinations } from '@/data/mockData';
import { useLocale } from '@/composables/useLocale';
import { Compass, Sparkles, MapPin, Calendar, ArrowRight, ArrowLeft, Sun, Mountain, Palmtree, Landmark } from 'lucide-vue-next';

const { isAr } = useLocale();

const activeTab = ref('all');

const seasons = [
    {
        title: { ar: 'موسم الشتاء والربيع (أكتوبر — أبريل)', en: 'Winter & Spring (Oct — Apr)' },
        tag: { ar: 'الموسم الذهبي للصحراء والتراث', en: 'Golden Season for Heritage' },
        desc: {
            ar: 'أفضل الأوقات لزيارة العلا، والرياض، والدرعية، وحضور شتاء طنطورة وموسم الرياض بأجواء معتدلة ممتعة.',
            en: 'Ideal for AlUla, Riyadh, Diriyah, and outdoor desert stargazing under pleasant cool temperatures.'
        }
    },
    {
        title: { ar: 'الموسم الساحلي (طوال العام)', en: 'Coastal & Island Season (Year-Round)' },
        tag: { ar: 'جزر البحر الأحمر والشواطئ', en: 'Red Sea Archipelagos' },
        desc: {
            ar: 'مياه دافئة نقية، وغوص الحيد المرجاني، وفيلات عائمة مستدامة مع طقس مشمس ومثالي للرياضات البحرية.',
            en: 'Warm crystal waters, pristine barrier reef diving, and ultra-luxury overwater villas.'
        }
    },
    {
        title: { ar: 'موسم الصيف الجبلي (مايو — سبتمبر)', en: 'Highland Summer Escapes (May — Sep)' },
        tag: { ar: 'أبها ومرتفعات عسير', en: 'Abha & Misty Asir Mountains' },
        desc: {
            ar: 'أجواء باردة منعشة بين الضباب والمطر الأخضر وقرى رجال ألمع الحجرية العريقة.',
            en: 'Cool refreshing mountain weather, lush greenery, fog-covered peaks, and historic stone architecture.'
        }
    }
];
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'اكتشف السعودية - أجنحة السعودية' : 'Discover Saudi Arabia - SaudiWings'" />

        <!-- Cinematic Hero Header -->
        <section class="relative bg-slate-950 text-white min-h-[460px] flex items-center overflow-hidden">
            <!-- Background Image -->
            <img
                src="https://images.unsplash.com/photo-1682687220063-4742bd7fd538?auto=format&fit=crop&w=1600&q=85"
                alt="AlUla Hegra"
                class="absolute inset-0 w-full h-full object-cover opacity-35 scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="max-w-3xl space-y-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold border border-blue-500/30">
                        <Compass class="w-3.5 h-3.5" />
                        {{ isAr ? 'استكشف روائع المملكة' : 'DISCOVER SAUDI ARABIA' }}
                    </span>
                    <h1 class="text-3xl sm:text-6xl font-black tracking-tight leading-tight">
                        {{ isAr ? 'أرض التاريخ العريق والنهضة السياحية الاستثنائية' : 'The Living Crossroads of Civilization & Wonder' }}
                    </h1>
                    <p class="text-sm sm:text-base text-slate-300 font-medium leading-relaxed">
                        {{ isAr 
                            ? 'من آثار الأنباط الخالدة في العلا إلى أحدث المنتجعات البيئية العائمة في البحر الأحمر، انطلق في رحلة تلهم الحواس.' 
                            : 'From the millennial rock tombs of Hegra to visionary regenerative coral archipelagos, embark on a transformative journey.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Curated Discovery Pillars -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-[#1E6BFF] block mb-1">
                    {{ isAr ? 'أعمدة السياحة السعودية' : 'THE PILLARS OF SAUDI' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'تنوع جغرافي وثقافي يسبق التوقعات' : 'Diverse Landscapes, One Transformative Destination' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Heritage -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                            <Landmark class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">
                            {{ isAr ? 'التراث والآثار العالمية' : 'UNESCO World Heritage' }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? 'العلا والحجر وحي الطريف بالدرعية وجدة التاريخية تعكس آلاف السنين من الحضارة.' : 'Ancient Nabataean kingdoms, coral-stone mansions in Jeddah, and Diriyah clay fortresses.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?id=alula" class="text-xs font-bold text-[#1E6BFF] flex items-center gap-1">
                            <span>{{ isAr ? 'استكشف الآثار' : 'Explore Heritage' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>

                <!-- Islands -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-4">
                            <Palmtree class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">
                            {{ isAr ? 'الجزر والشواطئ الفيروزية' : 'Pristine Marine Sanctuaries' }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? 'رابع أكبر حيد مرجاني في العالم، وفيلات عائمة فاخرة في جزر البحر الأحمر بكهرباء متجددة 100%.' : 'Over 90 untouched archipelagos with sustainable overwater villas powered by solar energy.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?id=red-sea" class="text-xs font-bold text-[#1E6BFF] flex items-center gap-1">
                            <span>{{ isAr ? 'استكشف الجزر' : 'Explore Red Sea' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>

                <!-- Mountains -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                            <Mountain class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">
                            {{ isAr ? 'القمم الجبلية والضباب' : 'Misty Mountain Heights' }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? 'مرتفعات السودة وأبها وقرى رجال ألمع تقدم ملاذاً بارداً ومنعشاً لعشاق الطبيعة والمغامرة.' : 'Green peaks of Asir, cascading cable cars, and dramatic cool weather even in peak summer.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?id=abha" class="text-xs font-bold text-[#1E6BFF] flex items-center gap-1">
                            <span>{{ isAr ? 'استكشف عسير' : 'Explore Asir' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>

                <!-- Cosmopolitan -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            <Sparkles class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">
                            {{ isAr ? 'العاصمة والفعاليات الكبرى' : 'Cosmopolitan Hubs' }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? 'ناطحات السحاب، ومطاعم ميشلان، وبوليفارد سيتي في موسم الرياض تضع العاصمة في صدارة الترفيه.' : 'World-class Michelin gastronomy, iconic high-rises, and non-stop entertainment spectacles.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?id=riyadh" class="text-xs font-bold text-[#1E6BFF] flex items-center gap-1">
                            <span>{{ isAr ? 'استكشف الرياض' : 'Explore Riyadh' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Travel Seasons & Guidelines -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-slate-50 rounded-3xl my-10 border border-slate-100">
            <div class="max-w-3xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-[#1E6BFF] block mb-1">
                    {{ isAr ? 'دليل مواسم السفر' : 'WHEN TO VISIT' }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'اختر التوقيت المثالي لمغامرتك القادمة' : 'Plan Around Ideal Seasonal Climates' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    v-for="(s, i) in seasons"
                    :key="i"
                    class="bg-white rounded-3xl p-6 card-soft-shadow border border-slate-100 flex flex-col justify-between"
                >
                    <div class="space-y-3">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#1E6BFF]">
                            {{ isAr ? s.tag.ar : s.tag.en }}
                        </span>
                        <h3 class="text-base font-black text-slate-900">
                            {{ isAr ? s.title.ar : s.title.en }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? s.desc.ar : s.desc.en }}
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <Link href="/ai-planner" class="text-xs font-bold text-[#1E6BFF] flex items-center gap-1">
                            <span>{{ isAr ? 'صمم مسار هذا الموسم' : 'Plan Season Trip' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
