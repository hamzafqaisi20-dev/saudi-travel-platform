<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useLocale } from '@/composables/useLocale';
import { ShieldCheck, Mail, MapPin, Send, CheckCircle2, Sparkles, Building, Layers, Cpu } from 'lucide-vue-next';

const { isAr } = useLocale();

const contactForm = ref({
    name: '',
    email: '',
    subject: 'investor',
    message: ''
});

const isSubmitted = ref(false);

const submitContact = () => {
    isSubmitted.value = true;
    setTimeout(() => {
        contactForm.value = { name: '', email: '', subject: 'investor', message: '' };
    }, 2000);
};
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'عن المنصة والتواصل - InfoTravel' : 'About & Contact - InfoTravel'" />

        <!-- Header -->
        <section class="bg-gradient-to-br from-[#0D1527] to-[#1A2845] text-white py-14 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold border border-blue-500/30">
                        <Building class="w-3.5 h-3.5" />
                        {{ isAr ? 'رؤية المنصة والتقنية' : 'INVESTOR-READY TRAVEL TECH' }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
                        {{ isAr ? 'إعادة تعريف السفر الفاخر في المملكة العربية السعودية' : 'Pioneering The Future of Saudi Travel Tech' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium leading-relaxed">
                        {{ isAr 
                            ? 'منصة رقمية رائدة تجمع بين حجز الطيران، استكشاف الوجهات، والذكاء الاصطناعي لتقديم تجارب استثنائية تواكب رؤية السعودية 2030.' 
                            : 'A visionary digital platform unifying luxury flight booking, destination discovery, and AI trip planning for domestic and global travelers.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Mission & Platform Highlights -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 card-soft-shadow border border-slate-100 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#243E88] flex items-center justify-center font-bold">
                        <Sparkles class="w-6 h-6 text-[#FAB515]" />
                    </div>
                    <h3 class="text-lg font-black text-slate-900">
                        {{ isAr ? 'الابتكار والذكاء الاصطناعي' : 'Smart AI Innovation' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        {{ isAr 
                            ? 'تصميم مسارات سفر ذكية تلائم تفضيلات كل مسافر بدقة فائقة وبدون تعقيد.' 
                            : 'AI-assisted itinerary curation understanding seasons, local heritage, and traveler preferences.' }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 card-soft-shadow border border-slate-100 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <Layers class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-black text-slate-900">
                        {{ isAr ? 'منظومة سياحية شاملة' : 'Unified Ecosystem' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        {{ isAr 
                            ? 'ربط المسافر بأقدس وأبرز الوجهات: مكة، المدينة، العلا، البحر الأحمر، الرياض، وعسير مع تغطية المهرجانات الثقافية والتراثية.' 
                            : 'Connecting luxury flight routes with sacred pilgrimages and cultural heritage destinations like Winter at Tantora.' }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 card-soft-shadow border border-slate-100 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <Cpu class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-black text-slate-900">
                        {{ isAr ? 'بنية تقنية للمستقبل' : 'Enterprise Engineering' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        {{ isAr 
                            ? 'مبني بأحدث معايير Laravel 12 و Vue 3 و Tailwind CSS، مع جاهزية كاملة لربط OpenAI وأنظمة الطيران.' 
                            : 'Engineered with Laravel 12, Vue 3, Inertia.js, and clean service abstractions for production scalability.' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact & Inquiries Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="bg-white rounded-3xl p-8 sm:p-12 card-soft-shadow border border-slate-100">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left: Info -->
                    <div class="space-y-6">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#243E88] block mb-1">
                                {{ isAr ? 'تواصل معنا' : 'CONTACT & COLLABORATION' }}
                            </span>
                            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                {{ isAr ? 'يسعدنا تواصل المستثمرين وشركاء السفر' : 'Let’s Build The Future of Travel Together' }}
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                                {{ isAr 
                                    ? 'سواء كنت مستثمراً، شركة طيران، أو مزود خدمات ضيافة فاخرة، نحن نرحب بفرص التعاون الاستراتيجي.' 
                                    : 'Whether you are an investor, airline partner, or hospitality operator, we welcome strategic partnerships.' }}
                            </p>
                        </div>

                        <div class="space-y-4 text-xs sm:text-sm text-slate-600">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                                    <MapPin class="w-4 h-4 text-[#243E88]" />
                                </div>
                                <span>{{ isAr ? 'مركز الملك عبدالله المالي (KAFD)، الرياض، المملكة العربية السعودية' : 'KAFD, Riyadh, Kingdom of Saudi Arabia' }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                                    <Mail class="w-4 h-4 text-[#243E88]" />
                                </div>
                                <span class="font-mono">partners@infotravel.sa</span>
                            </div>
                        </div>

                        <!-- Phase 1 Notice -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-500 space-y-1">
                            <span class="font-bold text-slate-800 block">{{ isAr ? 'حالة المشروع' : 'Project Status' }}:</span>
                            <p>{{ isAr ? 'المنصة حالياً في مرحلة العرض التجريبي الأولي (Phase One Showcase Prototype).' : 'Currently operating in Phase One Presentation Prototype.' }}</p>
                        </div>
                    </div>

                    <!-- Right: Contact Form -->
                    <div class="bg-slate-50/80 p-6 sm:p-8 rounded-3xl border border-slate-200/80">
                        <div v-if="isSubmitted" class="p-6 rounded-2xl bg-emerald-50 text-emerald-900 border border-emerald-200 text-center space-y-2 animate-in fade-in">
                            <CheckCircle2 class="w-10 h-10 text-emerald-600 mx-auto" />
                            <h4 class="font-bold text-sm">{{ isAr ? 'شكراً لتواصلك معنا!' : 'Thank you for reaching out!' }}</h4>
                            <p class="text-xs text-emerald-700">
                                {{ isAr ? 'تم استلام رسالتك التجريبية بنجاح وسيتواصل معك فريقنا قريباً.' : 'Your inquiry has been simulated and recorded in our demo environment.' }}
                            </p>
                        </div>

                        <form v-else @submit.prevent="submitContact" class="space-y-4 text-xs">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'الاسم الكامل' : 'Full Name' }}</label>
                                <input
                                    v-model="contactForm.name"
                                    required
                                    type="text"
                                    placeholder="e.g. Sultan Al-Otaibi"
                                    class="w-full p-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#243E88]"
                                />
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'البريد الإلكتروني' : 'Email Address' }}</label>
                                <input
                                    v-model="contactForm.email"
                                    required
                                    type="email"
                                    placeholder="name@domain.com"
                                    class="w-full p-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#243E88]"
                                />
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'طبيعة الاستفسار' : 'Inquiry Type' }}</label>
                                <select v-model="contactForm.subject" class="w-full p-3 bg-white border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none">
                                    <option value="investor">{{ isAr ? 'استثمار وشراكة استراتيجية' : 'Investor & Strategic Partnership' }}</option>
                                    <option value="airline">{{ isAr ? 'تكامل شركات الطيران (API / NDC)' : 'Airline Integration (API / NDC)' }}</option>
                                    <option value="tourism">{{ isAr ? 'هيئة أو وجهة سياحية' : 'Tourism Authority / DMO' }}</option>
                                    <option value="general">{{ isAr ? 'استفسار عام' : 'General Inquiry' }}</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'الرسالة' : 'Message' }}</label>
                                <textarea
                                    v-model="contactForm.message"
                                    required
                                    rows="4"
                                    :placeholder="isAr ? 'اكتب تفاصيل رسالتك أو استفسارك...' : 'Please write your message or partnership proposal...'"
                                    class="w-full p-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#243E88]"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="w-full py-3.5 rounded-full bg-[#FAB515] hover:bg-amber-400 text-[#1B316E] font-extrabold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 transition-all cursor-pointer"
                            >
                                <Send class="w-4 h-4 rtl:rotate-180" />
                                <span>{{ isAr ? 'إرسال الرسالة' : 'Send Message' }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
