<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import AircraftIcon from '@/Components/AircraftIcon.vue';
import { Globe, Shield, Sparkles, Plane, ExternalLink, Mail, Phone, Clock, CheckCircle2, ShieldCheck, FileText, X } from 'lucide-vue-next';

const { isAr, toggleLocale } = useLocale();

const activeLegalModal = ref(null);
const contactSent = ref(false);
const contactForm = ref({ name: '', email: '', message: '' });

const submitContact = () => {
    if (contactForm.value.email || contactForm.value.message) {
        contactSent.value = true;
        setTimeout(() => {
            contactSent.value = false;
            contactForm.value = { name: '', email: '', message: '' };
            activeLegalModal.value = null;
        }, 2500);
    }
};
</script>

<template>
    <footer class="bg-[#090F1D] text-slate-300 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800/80">
                <!-- Brand Info & Vision -->
                <div class="lg:col-span-2 space-y-4">
                    <Link href="/" class="inline-flex items-center gap-3 group">
                        <img 
                            src="/images/logo-white.png" 
                            alt="InfoTravel" 
                            class="h-10 sm:h-12 w-auto object-contain transition-transform duration-200 group-hover:scale-105" 
                        />
                    </Link>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        {{ isAr 
                            ? 'المنصة الرقمية المتطورة لاكتشاف وجهات المملكة العربية السعودية وحجز الرحلات الفاخرة عبر InfoTravel، معززة بالذكاء الاصطناعي لتقديم تجارب سفر استثنائية.'
                            : 'The premier smart travel platform celebrating Saudi Arabia’s world-class destinations and luxury flight experiences, powered by InfoTravel AI.' }}
                    </p>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-[#FAB515]/10 text-[#FAB515] border border-[#FAB515]/20">
                            <span class="w-2 h-2 rounded-full bg-[#FAB515]"></span>
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
                        <li><Link href="/destinations?id=makkah" class="hover:text-white transition-colors">{{ isAr ? 'مكة المكرمة' : 'Holy Makkah' }}</Link></li>
                        <li><Link href="/destinations?id=madinah" class="hover:text-white transition-colors">{{ isAr ? 'المدينة المنورة' : 'Madinah Al-Munawwarah' }}</Link></li>
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

            <!-- Bottom Copyright & Legal Links -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>© {{ new Date().getFullYear() }} InfoTravel. {{ isAr ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <button type="button" @click="activeLegalModal = 'privacy'" class="hover:text-slate-300 transition-colors cursor-pointer">{{ isAr ? 'سياسة الخصوصية' : 'Privacy Policy' }}</button>
                    <button type="button" @click="activeLegalModal = 'terms'" class="hover:text-slate-300 transition-colors cursor-pointer">{{ isAr ? 'الشروط والأحكام' : 'Terms of Service' }}</button>
                    <button type="button" @click="activeLegalModal = 'contact'" class="hover:text-slate-300 transition-colors cursor-pointer">{{ isAr ? 'تواصل معنا' : 'Contact Support' }}</button>
                </div>
            </div>
        </div>

        <!-- Legal & Contact Interactive Modals -->
        <div v-if="activeLegalModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm animate-in fade-in">
            <div class="bg-white text-slate-900 rounded-3xl p-6 sm:p-8 max-w-lg w-full card-soft-shadow border border-slate-100 space-y-5">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <component
                            :is="activeLegalModal === 'contact' ? Mail : (activeLegalModal === 'privacy' ? ShieldCheck : FileText)"
                            class="w-5 h-5 text-[#243E88]"
                        />
                        <h3 class="text-base font-black text-slate-900">
                            <template v-if="activeLegalModal === 'privacy'">{{ isAr ? 'سياسة الخصوصية وحماية البيانات' : 'Privacy Policy & Data Security' }}</template>
                            <template v-else-if="activeLegalModal === 'terms'">{{ isAr ? 'الشروط والأحكام والترخيص' : 'Terms of Service & Licensing' }}</template>
                            <template v-else>{{ isAr ? 'تواصل مع فريق InfoTravel' : 'Contact InfoTravel Support' }}</template>
                        </h3>
                    </div>
                    <button @click="activeLegalModal = null" class="text-slate-400 hover:text-slate-700 text-lg cursor-pointer">
                        <X class="w-5 h-5" />
                    </button>
                </div>

                <!-- Modal Body: Privacy Policy -->
                <div v-if="activeLegalModal === 'privacy'" class="space-y-3 text-xs text-slate-600 leading-relaxed max-h-[60vh] overflow-y-auto pe-1">
                    <p class="font-bold text-slate-800">
                        {{ isAr 
                            ? 'نلتزم في InfoTravel بحماية خصوصية بيانات زوارنا ومستخدمينا وفق أعلى معايير الأمن السيبراني السعودية.' 
                            : 'At InfoTravel, we adhere to stringent data protection and cybersecurity standards across the Kingdom.' }}
                    </p>
                    <p>
                        {{ isAr
                            ? '• جمع البيانات: لا نقوم بجمع أو مشاركة أي بيانات مصرفية حساسة خلال هذه المرحلة الاستعراضية، وتقتصر المدخلات على استفسارات البحث السياحي الذكي.'
                            : '• Data Collection: No payment card or sensitive financial credentials are required or stored during this demonstration phase.' }}
                    </p>
                    <p>
                        {{ isAr
                            ? '• ملفات تعريف الارتباط (Cookies): نستخدم ملفات تعريف الارتباط التقنية فقط لحفظ تفضيل اللغة (العربية/الإنجليزية) وحالة التصفح.'
                            : '• Cookies: We utilize strictly essential cookies solely to persist your language preference and UI states.' }}
                    </p>
                </div>

                <!-- Modal Body: Terms of Service -->
                <div v-if="activeLegalModal === 'terms'" class="space-y-3 text-xs text-slate-600 leading-relaxed max-h-[60vh] overflow-y-auto pe-1">
                    <p class="font-bold text-slate-800">
                        {{ isAr 
                            ? 'شروط الاستخدام الخاصة بالنموذج التفاعلي لمنصة InfoTravel:' 
                            : 'Terms & Conditions governing the InfoTravel interactive showcase platform:' }}
                    </p>
                    <p>
                        {{ isAr
                            ? '1. طبيعة المنصة: هذا المشروع مصمم كنموذج عرض واجهات وتقنيات حديثة لتجربة مستخدم فاخرة لقطاع السفر والسياحة السعودي.'
                            : '1. Platform Nature: This software application serves as a high-fidelity frontend UI architecture and technology demonstration.' }}
                    </p>
                    <p>
                        {{ isAr
                            ? '2. بيانات الرحلات والتسعير: جميع أسعار الرحلات وباقات الطيران وأكواد الخصم المعروضة هي بيانات توضيحية ومحاكاة برمجية وليست عقود حجز نهائية ملزمة.'
                            : '2. Fares & Schedules: All flight itineraries, schedules, and promo codes are simulated mock values and do not constitute actual ticketing tickets.' }}
                    </p>
                </div>

                <!-- Modal Body: Contact Support -->
                <div v-if="activeLegalModal === 'contact'" class="space-y-4 text-xs text-slate-600">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                        <div class="flex items-center gap-2">
                            <Mail class="w-4 h-4 text-[#243E88] shrink-0" />
                            <div>
                                <span class="text-slate-400 block text-[10px]">{{ isAr ? 'البريد الإلكتروني:' : 'Email Support:' }}</span>
                                <span class="font-bold text-slate-800">support@infotravel.sa</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <Phone class="w-4 h-4 text-[#243E88] shrink-0" />
                            <div>
                                <span class="text-slate-400 block text-[10px]">{{ isAr ? 'الرقم الموحد:' : 'Toll Free:' }}</span>
                                <span class="font-bold text-slate-800" dir="ltr">800 124 2030</span>
                            </div>
                        </div>
                    </div>

                    <div v-if="contactSent" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-2 text-xs font-bold">
                        <CheckCircle2 class="w-4 h-4 text-emerald-600 shrink-0" />
                        <span>{{ isAr ? 'تم إرسال رسالتك بنجاح! سيتواصل معك فريق الدعم قريباً.' : 'Message sent successfully! Our concierge will respond shortly.' }}</span>
                    </div>

                    <form v-else @submit.prevent="submitContact" class="space-y-3">
                        <div>
                            <input
                                type="text"
                                v-model="contactForm.name"
                                :placeholder="isAr ? 'الاسم الكامل' : 'Your Name'"
                                class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#243E88]"
                                required
                            />
                        </div>
                        <div>
                            <input
                                type="email"
                                v-model="contactForm.email"
                                :placeholder="isAr ? 'البريد الإلكتروني' : 'Email Address'"
                                class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#243E88]"
                                required
                            />
                        </div>
                        <div>
                            <textarea
                                v-model="contactForm.message"
                                rows="3"
                                :placeholder="isAr ? 'اكتب رسالتك أو استفسارك هنا...' : 'Write your message or inquiry here...'"
                                class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#243E88]"
                                required
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="w-full py-2.5 rounded-full bg-[#FAB515] hover:bg-[#e8a50e] text-[#1B316E] font-black text-xs transition-colors cursor-pointer shadow-md"
                        >
                            {{ isAr ? 'إرسال الرسالة' : 'Send Message' }}
                        </button>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="pt-2 border-t border-slate-100 flex justify-end">
                    <button
                        type="button"
                        @click="activeLegalModal = null"
                        class="px-5 py-2 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors cursor-pointer"
                    >
                        {{ isAr ? 'إغلاق' : 'Close' }}
                    </button>
                </div>
            </div>
        </div>
    </footer>
</template>
