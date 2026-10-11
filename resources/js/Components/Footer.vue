<script setup>
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import { Globe, Shield, Sparkles, Plane, ExternalLink } from 'lucide-vue-next';

const { isAr, toggleLocale } = useLocale();
</script>

<template>
    <footer class="bg-[#090F1D] text-slate-300 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800/80">
                <!-- Brand Info & Vision -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#0D1527] to-[#1E6BFF] flex items-center justify-center text-white border border-white/20 shadow-lg shadow-blue-500/25">
                            <AircraftIcon className="w-7 h-7" variant="white" :angle="-45" />
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white inline-flex items-center" dir="ltr">
                            <span>Info</span><span class="text-[#1E6BFF]">Travel</span>
                        </span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        {{ isAr 
                            ? 'المنصة الرقمية المتطورة لاكتشاف وجهات المملكة العربية السعودية وحجز الرحلات الفاخرة عبر InfoTravel، معززة بالذكاء الاصطناعي لتقديم تجارب سفر استثنائية.'
                            : 'The premier smart travel platform celebrating Saudi Arabia’s world-class destinations and luxury flight experiences, powered by InfoTravel AI.' }}
                    </p>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            {{ isAr ? 'رؤية السعودية 2030 — نموذج تجريبي' : 'Saudi Vision 2030 — Demo Prototype' }}
                        </span>
                    </div>
                </div>

                <!-- Column: Quick Navigation -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">
                        {{ isAr ? 'روابط المنصة' : 'Navigation' }}
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><Link href="/flights" class="hover:text-white transition-colors">{{ isAr ? 'حجز الطيران' : 'Flight Booking' }}</Link></li>
                        <li><Link href="/discover" class="hover:text-white transition-colors">{{ isAr ? 'اكتشف السعودية' : 'Discover Saudi' }}</Link></li>
                        <li><Link href="/destinations" class="hover:text-white transition-colors">{{ isAr ? 'دليل الوجهات' : 'Destinations' }}</Link></li>
                        <li><Link href="/experiences" class="hover:text-white transition-colors">{{ isAr ? 'التجارب والمواسم' : 'Experiences & Events' }}</Link></li>
                        <li><Link href="/ai-planner" class="hover:text-white transition-colors flex items-center gap-1.5 text-blue-400">{{ isAr ? 'المخطط الذكي' : 'AI Trip Planner' }} <Sparkles class="w-3.5 h-3.5" /></Link></li>
                    </ul>
                </div>

                <!-- Column: Top Destinations -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">
                        {{ isAr ? 'أهم الوجهات' : 'Top Destinations' }}
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><Link href="/destinations?id=alula" class="hover:text-white transition-colors">{{ isAr ? 'العلا التاريخية' : 'Historic AlUla' }}</Link></li>
                        <li><Link href="/destinations?id=red-sea" class="hover:text-white transition-colors">{{ isAr ? 'جزر البحر الأحمر' : 'The Red Sea Islands' }}</Link></li>
                        <li><Link href="/destinations?id=riyadh" class="hover:text-white transition-colors">{{ isAr ? 'الرياض والدرعية' : 'Riyadh & Diriyah' }}</Link></li>
                        <li><Link href="/destinations?id=jeddah" class="hover:text-white transition-colors">{{ isAr ? 'جدة البلد والكورنيش' : 'Jeddah Al Balad' }}</Link></li>
                        <li><Link href="/destinations?id=abha" class="hover:text-white transition-colors">{{ isAr ? 'أبها ومرتفعات عسير' : 'Abha & Asir Peaks' }}</Link></li>
                    </ul>
                </div>

                <!-- Column: Official Resources -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">
                        {{ isAr ? 'المصادر والشركاء' : 'Ecosystem & Partners' }}
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="https://www.saudia.com/" target="_blank" rel="noopener" class="hover:text-white transition-colors flex items-center gap-1">{{ isAr ? 'الخطوط السعودية' : 'Saudia' }} <ExternalLink class="w-3 h-3 text-slate-500" /></a></li>
                        <li><a href="https://www.riyadhair.com/en/home" target="_blank" rel="noopener" class="hover:text-white transition-colors flex items-center gap-1">{{ isAr ? 'طيران الرياض' : 'Riyadh Air' }} <ExternalLink class="w-3 h-3 text-slate-500" /></a></li>
                        <li><a href="https://www.visitsaudi.com/" target="_blank" rel="noopener" class="hover:text-white transition-colors flex items-center gap-1">{{ isAr ? 'روح السعودية (Visit Saudi)' : 'Visit Saudi' }} <ExternalLink class="w-3 h-3 text-slate-500" /></a></li>
                        <li><a href="https://visa.visitsaudi.com/" target="_blank" rel="noopener" class="hover:text-white transition-colors flex items-center gap-1">{{ isAr ? 'بوابة التأشيرة السياحية' : 'Saudi eVisa Portal' }} <ExternalLink class="w-3 h-3 text-slate-500" /></a></li>
                        <li><a href="https://webook.com/en" target="_blank" rel="noopener" class="hover:text-white transition-colors flex items-center gap-1">{{ isAr ? 'ويبوك (Webook)' : 'Webook' }} <ExternalLink class="w-3 h-3 text-slate-500" /></a></li>
                    </ul>
                </div>
            </div>

            <!-- Prototype Notice & Disclaimer (Strict Phase 1 Compliance) -->
            <div class="mt-8 p-4 rounded-xl bg-slate-900/60 border border-slate-800 text-xs text-slate-400 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <Shield class="w-4 h-4 text-blue-400 shrink-0" />
                    <span>
                        {{ isAr 
                            ? 'إشعار توضيحي: هذا الموقع هو نموذج عرض وتصميم واجهات تفاعلية (Frontend Prototype). بيانات الرحلات والأسعار هي بيانات تجريبية (Mock Data) ولا تمثل حجوزات فعلية أو ارتباطاً تعاقدياً مع شركات الطيران.' 
                            : 'Prototype Notice: This platform is a design showcase and presentation prototype. All flight schedules, fares, and external resource listings are illustrative mock data and do not constitute live booking transactions.' }}
                    </span>
                </div>
                <button
                    @click="toggleLocale"
                    class="shrink-0 flex items-center gap-1.5 text-blue-400 hover:text-white font-medium"
                >
                    <Globe class="w-3.5 h-3.5" />
                    <span>{{ isAr ? 'English' : 'العربية' }}</span>
                </button>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>© {{ new Date().getFullYear() }} InfoTravel. {{ isAr ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <Link href="/about" class="hover:text-slate-400">{{ isAr ? 'سياسة الخصوصية' : 'Privacy Policy' }}</Link>
                    <Link href="/about" class="hover:text-slate-400">{{ isAr ? 'الشروط والأحكام' : 'Terms of Service' }}</Link>
                    <Link href="/about" class="hover:text-slate-400">{{ isAr ? 'تواصل معنا' : 'Contact Support' }}</Link>
                </div>
            </div>
        </div>
    </footer>
</template>
