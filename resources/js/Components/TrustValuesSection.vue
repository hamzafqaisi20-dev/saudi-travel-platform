<script setup>
import { useLocale } from '@/composables/useLocale';
import { Compass, Sparkles, ShieldCheck, HeartHandshake, Layers, Plane } from 'lucide-vue-next';

const { isAr } = useLocale();

const values = [
    {
        icon: Compass,
        title: { ar: 'تخطيط سفر أسهل وأرقى', en: 'Effortless Journey Planning' },
        desc: {
            ar: 'واجهة عصرية توحد خطوات البحث عن الطيران واستكشاف الفنادق والفعاليات في تجربة واحدة منسجمة.',
            en: 'A unified digital interface bringing flight routes, boutique hotels, and regional seasons together.'
        }
    },
    {
        icon: Layers,
        title: { ar: 'اكتشاف كنوز الوجهات السعودية', en: 'Unrivaled Saudi Discovery' },
        desc: {
            ar: 'تسليط الضوء على المعالم الفريدة من آثار الحضارة النبطية في العلا إلى جزر البحر الأحمر البكر ونبض الرياض.',
            en: 'Showcasing the full spectrum of Saudi wonder from AlUla heritage to pristine coral archipelagos.'
        }
    },
    {
        icon: Sparkles,
        title: { ar: 'توصيات ذكية بالذكاء الاصطناعي', en: 'Smart Personalized AI Curation' },
        desc: {
            ar: 'مساعد ذكي يفهم تفضيلاتك ويوصي بأفضل أوقات السفر، مع مسارات تفصيلية تناسب أسلوب سفرك الفاخر.',
            en: 'Personalized travel designer that tailors day-by-day itineraries to your exact pace and luxury preferences.'
        }
    },
    {
        icon: ShieldCheck,
        title: { ar: 'مصادر موثوقة وروابط رسمية', en: 'Verified Official Gateways' },
        desc: {
            ar: 'الربط المباشر مع بوابات التأشيرات الرسمية والناقلين الوطنيين ومنصات الفعاليات الكبرى لضمان راحة بالك.',
            en: 'Direct access to official tourist visa portals, national flag carriers, and verified event platforms.'
        }
    }
];
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gradient-to-br from-[#0D1527] to-[#16233B] text-white rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-2xl relative overflow-hidden">
            <!-- Subtle background accent glow -->
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#1E6BFF]/20 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-[#1E6BFF] block mb-2">
                    {{ isAr ? 'قيم المنصة ومزاياها' : 'OUR CORE PILLARS & VALUE' }}
                </span>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    {{ isAr ? 'لماذا تختار أجنحة السعودية لتخطيط رحلتك القادمة؟' : 'Crafting Next-Generation Travel Experiences' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 font-medium mt-3 leading-relaxed">
                    {{ isAr 
                        ? 'نجمع بين أحدث تقنيات السفر الرقمية وعراقة الضيافة السعودية، لنمنحك تجربة سفر تفوق التوقعات.' 
                        : 'Combining cutting-edge travel technology with authentic Arabian hospitality to elevate every step of your journey.' }}
                </p>
            </div>

            <!-- Value Cards Grid -->
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    v-for="(val, idx) in values"
                    :key="idx"
                    class="bg-white/5 hover:bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10 transition-all hover:-translate-y-1"
                >
                    <div class="w-12 h-12 rounded-2xl bg-[#1E6BFF] text-white flex items-center justify-center mb-5 shadow-lg shadow-blue-500/30">
                        <component :is="val.icon" class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">
                        {{ isAr ? val.title.ar : val.title.en }}
                    </h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        {{ isAr ? val.desc.ar : val.desc.en }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
