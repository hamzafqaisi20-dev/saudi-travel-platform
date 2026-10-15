<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { destinations } from '@/data/mockData';
import { useLocale } from '@/composables/useLocale';
import { Compass, Sparkles, MapPin, Calendar, ArrowRight, ArrowLeft, Sun, Mountain, Palmtree, Landmark, Heart } from 'lucide-vue-next';

const { isAr } = useLocale();

const activeTab = ref('all');

const seasons = [
    {
        title: { ar: 'موسم الحج المبارك (ذو الحجة)', en: 'The Blessed Hajj Season (Dhul-Hijjah)' },
        tag: { ar: 'المشاعر المقدسة ومكة المكرمة', en: 'Sacred Holy Sites & Makkah' },
        desc: {
            ar: 'أعظم تجمع إيماني في منى وعرفات ومزدلفة والحرم المكي الشريف، مع أرقى الخدمات اللوجستية ومنظومة نقل ذكية ورعاية شاملة لضيوف الرحمن.',
            en: 'The holiest spiritual gathering across Mina, Arafat, Muzdalifah, and the Grand Mosque, featuring world-class smart logistics and pilgrim care.'
        },
        route: '/destinations?id=makkah'
    },
    {
        title: { ar: 'موسم العمرة والروحانيات (طوال العام)', en: 'Spiritual Umrah & Pilgrimage (Year-Round)' },
        tag: { ar: 'مكة المكرمة والمدينة المنورة', en: 'Sacred Sanctuaries & Nusuk' },
        desc: {
            ar: 'أجواء إيمانية في رحاب المسجد الحرام والمسجد النبوي، مع سهولة استخراج التصاريح عبر منصة نُسك والتنقل بقطار الحرمين السريع.',
            en: 'Deeply fulfilling spiritual journeys to the Two Holy Mosques, seamlessly booked via official Nusuk portal and Haramain Rail.'
        },
        route: '/destinations?filter=مقدسات'
    },
    {
        title: { ar: 'موسم الشتاء والربيع (أكتوبر — أبريل)', en: 'Winter & Spring (Oct — Apr)' },
        tag: { ar: 'الموسم الذهبي للصحراء والتراث', en: 'Golden Season for Heritage' },
        desc: {
            ar: 'أفضل الأوقات لزيارة العلا، والرياض، والدرعية، وحضور شتاء طنطورة وفعاليات الصحراء بأجواء معتدلة ممتعة.',
            en: 'Ideal for AlUla, Riyadh, Diriyah, and outdoor desert stargazing under pleasant cool temperatures.'
        },
        route: '/destinations?id=alula'
    },
    {
        title: { ar: 'الموسم الساحلي (طوال العام)', en: 'Coastal & Island Season (Year-Round)' },
        tag: { ar: 'جزر البحر الأحمر والشواطئ', en: 'Red Sea Archipelagos' },
        desc: {
            ar: 'مياه دافئة نقية، وغوص الحيد المرجاني، وفيلات عائمة مستدامة مع طقس مشمس ومثالي للرياضات البحرية.',
            en: 'Warm crystal waters, pristine barrier reef diving, and ultra-luxury overwater villas.'
        },
        route: '/destinations?id=red-sea'
    },
    {
        title: { ar: 'موسم الصيف الجبلي (مايو — سبتمبر)', en: 'Highland Summer Escapes (May — Sep)' },
        tag: { ar: 'أبها ومرتفعات عسير', en: 'Abha & Misty Asir Mountains' },
        desc: {
            ar: 'أجواء باردة منعشة بين الضباب والمطر الأخضر وقرى رجال ألمع الحجرية العريقة.',
            en: 'Cool refreshing mountain weather, lush greenery, fog-covered peaks, and historic stone architecture.'
        },
        route: '/destinations?id=abha'
    }
];
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'اكتشف السعودية - InfoTravel' : 'Discover Saudi Arabia - InfoTravel'" />

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
                <span class="text-xs font-bold uppercase tracking-widest text-[#243E88] block mb-1">
                    {{ isAr ? 'أعمدة السياحة السعودية' : 'THE PILLARS OF SAUDI' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'تنوع جغرافي وثقافي وروحي يسبق التوقعات' : 'Diverse Landscapes, Cultural Depth & Spiritual Wonder' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <!-- Spiritual & Sacred -->
                <div class="bg-white rounded-3xl p-6 card-soft-shadow card-hover border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                            <Heart class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">
                            {{ isAr ? 'المقدسات والروحانيات' : 'Sacred Sanctuaries' }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ isAr ? 'مكة المكرمة قِبلة المسلمين، والمدينة المنورة مهد السلام، ورحاب الحرمين الشريفين وقطار الحرمين السريع.' : 'Holiest sanctuaries of Makkah and Madinah, the Two Holy Mosques, and high-speed rail.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?filter=مقدسات" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف الوجهات الروحانية' : 'Explore Sanctuaries' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>

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
                        <Link href="/destinations?filter=تراث" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف الوجهات التراثية' : 'Explore Heritage' }}</span>
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
                        <Link href="/destinations?filter=شواطئ" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف الوجهات الساحلية' : 'Explore Red Sea' }}</span>
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
                        <Link href="/destinations?filter=طبيعة" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف الوجهات الجبلية' : 'Explore Asir' }}</span>
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
                            {{ isAr ? 'ناطحات السحاب الشاهقة، ومطاعم ميشلان في مطل البجيري، ومركز الملك عبدالله المالي تضع العاصمة في صدارة الحداثة والفخامة.' : 'World-class Michelin gastronomy at Bujairi Terrace, iconic high-rises, and KAFD financial architecture.' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 mt-4">
                        <Link href="/destinations?filter=عاصمة" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف الوجهات الحديثة' : 'Explore Riyadh' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Travel Seasons & Guidelines -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-slate-50 rounded-3xl my-10 border border-slate-100">
            <div class="max-w-3xl mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-[#243E88] block mb-1">
                    {{ isAr ? 'دليل مواسم السفر' : 'WHEN TO VISIT' }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-[#0D1527] tracking-tight">
                    {{ isAr ? 'اختر التوقيت المثالي لمغامرتك القادمة' : 'Plan Around Ideal Seasonal Climates' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="(s, i) in seasons"
                    :key="i"
                    class="bg-white rounded-3xl p-6 card-soft-shadow border border-slate-100 flex flex-col justify-between"
                >
                    <div class="space-y-3">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#243E88]">
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
                        <Link :href="s.route || '/ai-planner'" class="text-xs font-bold text-[#243E88] flex items-center gap-1 hover:text-[#FAB515] transition-colors">
                            <span>{{ isAr ? 'استكشف وجهات ومسار هذا الموسم' : 'Explore Season Destinations' }}</span>
                            <component :is="isAr ? ArrowLeft : ArrowRight" class="w-3.5 h-3.5" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
