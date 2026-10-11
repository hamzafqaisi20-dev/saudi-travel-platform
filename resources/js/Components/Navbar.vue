<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { Globe, Menu, X } from 'lucide-vue-next';
import AircraftIcon from '@/Components/AircraftIcon.vue';

const { isAr, isEn, toggleLocale, locale } = useLocale();
const page = usePage();
const mobileMenuOpen = ref(false);

const navLinks = [
    { href: '/', label: { ar: 'الرئيسية', en: 'Home' } },
    { href: '/flights', label: { ar: 'حجز الطيران', en: 'Flights' } },
    { href: '/discover', label: { ar: 'اكتشف السعودية', en: 'Discover Saudi' } },
    { href: '/destinations', label: { ar: 'الوجهات', en: 'Destinations' } },
    { href: '/experiences', label: { ar: 'التجارب والفعاليات', en: 'Experiences' } },
    { href: '/ai-planner', label: { ar: 'مساعد السفر الذكي', en: 'AI Planner' }, isAi: true },
    { href: '/partners', label: { ar: 'شركاء السفر', en: 'Travel Partners' } },
    { href: '/about', label: { ar: 'عن المنصة', en: 'About' } },
];

const isActive = (href) => {
    const currentUrl = page.url.split('?')[0].split('#')[0];
    if (href === '/') {
        return currentUrl === '/' || currentUrl === '';
    }
    return currentUrl === href || currentUrl.startsWith(href + '/');
};
</script>

<template>
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 transition-all duration-200">
        <div class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-6 xl:px-8">
            <div class="flex items-center justify-between h-18 sm:h-20 gap-2 sm:gap-4">
                <!-- Group 1: Brand Logo & Navigation Links -->
                <div class="flex items-center gap-3 lg:gap-4 xl:gap-6 min-w-0">
                    <!-- Brand Logo -->
                    <Link href="/" class="flex items-center gap-2.5 group shrink-0 select-none">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-2xl bg-gradient-to-tr from-[#0D1527] to-[#1E6BFF] flex items-center justify-center text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform border border-white/20 shrink-0">
                            <!-- Aerodynamic aircraft icon -->
                            <AircraftIcon className="w-5 h-5 sm:w-6 sm:h-6" variant="white" :angle="-45" />
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base sm:text-lg font-extrabold tracking-tight text-slate-900 leading-tight inline-flex items-center" dir="ltr">
                                <span>Info</span><span class="text-[#1E6BFF]">Travel</span>
                            </span>
                            <span class="text-[9px] font-medium text-slate-400 tracking-wider">
                                {{ isAr ? 'منصة السفر الذكية' : 'SMART TRAVEL PLATFORM' }}
                            </span>
                        </div>
                    </Link>

                    <!-- Desktop Navigation Links (All 8 items restored with balanced compact scale) -->
                    <nav class="hidden lg:flex items-center gap-1 xl:gap-1.5 2xl:gap-2 flex-nowrap whitespace-nowrap">
                        <Link
                            v-for="link in navLinks"
                            :key="link.href"
                            :href="link.href"
                            class="px-2.5 xl:px-3 py-1.5 text-xs xl:text-[13px] 2xl:text-sm rounded-full transition-all duration-200 flex items-center gap-1.5 font-semibold shrink-0 whitespace-nowrap leading-none tracking-normal"
                            :class="isActive(link.href)
                                ? 'bg-[#1E6BFF] text-white shadow-sm shadow-blue-500/25 font-bold'
                                : 'text-slate-600 hover:text-[#1E6BFF] hover:bg-slate-100/70'"
                        >
                            <span
                                v-if="link.isAi"
                                class="inline-flex items-center justify-center w-1.5 h-1.5 rounded-full animate-pulse shrink-0"
                                :class="isActive(link.href) ? 'bg-white' : 'bg-[#1E6BFF]'"
                            ></span>
                            <span>{{ isAr ? link.label.ar : link.label.en }}</span>
                        </Link>
                    </nav>
                </div>

                <!-- Group 2: Language Selector, CTA Button & Mobile Toggle -->
                <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0 whitespace-nowrap">
                    <!-- Language Selector Button -->
                    <button
                        @click="toggleLocale"
                        class="hidden sm:flex items-center gap-1.5 px-2.5 xl:px-3 py-1.5 rounded-full border border-slate-200 text-[11px] xl:text-xs font-bold text-slate-700 hover:border-[#1E6BFF] hover:text-[#1E6BFF] hover:bg-slate-50 transition-all cursor-pointer shrink-0"
                        :title="isAr ? 'Switch to English' : 'التحويل إلى العربية'"
                    >
                        <Globe class="w-3.5 h-3.5 text-slate-500" />
                        <span>{{ isAr ? 'English' : 'العربية' }}</span>
                    </button>

                    <!-- Primary Pill CTA Button -->
                    <Link
                        href="/flights"
                        class="hidden sm:inline-flex items-center justify-center px-4 xl:px-5 py-2 rounded-full text-xs xl:text-sm font-bold bg-[#0D1527] text-white hover:bg-[#1E6BFF] transition-all duration-200 shadow-md hover:shadow-lg hover:shadow-blue-500/20 active:scale-95 shrink-0"
                    >
                        {{ isAr ? 'احجز رحلتك' : 'Book Trip' }}
                    </Link>

                    <!-- Mobile Language Button -->
                    <button
                        @click="toggleLocale"
                        class="sm:hidden p-2 rounded-lg border border-slate-200 text-xs font-bold text-slate-700"
                    >
                        {{ isAr ? 'EN' : 'عربي' }}
                    </button>

                    <!-- Mobile / Tablet Hamburger Toggle (Shown on screens < lg) -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-slate-100 border border-slate-200 transition-colors cursor-pointer"
                        aria-label="Toggle menu"
                    >
                        <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
                        <X v-else class="w-6 h-6" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer (Lists all 8 pages clearly on mobile) -->
        <div v-show="mobileMenuOpen" class="lg:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-1.5 shadow-xl animate-in slide-in-from-top-2">
            <Link
                v-for="link in navLinks"
                :key="link.href"
                :href="link.href"
                @click="mobileMenuOpen = false"
                class="px-4 py-3 rounded-2xl text-sm font-bold transition-all flex items-center justify-between"
                :class="isActive(link.href)
                    ? 'bg-[#1E6BFF] text-white shadow-md shadow-blue-500/20 font-black'
                    : 'text-slate-700 hover:bg-blue-50 hover:text-[#1E6BFF]'"
            >
                <div class="flex items-center gap-2">
                    <span
                        v-if="link.isAi"
                        class="inline-flex items-center justify-center w-2 h-2 rounded-full animate-pulse"
                        :class="isActive(link.href) ? 'bg-white' : 'bg-[#1E6BFF]'"
                    ></span>
                    <span>{{ isAr ? link.label.ar : link.label.en }}</span>
                </div>
                <span v-if="isActive(link.href)" class="w-2 h-2 rounded-full bg-white"></span>
            </Link>
            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                <Link
                    href="/flights"
                    @click="mobileMenuOpen = false"
                    class="w-full text-center py-3 rounded-full text-sm font-bold bg-[#0D1527] text-white hover:bg-[#1E6BFF]"
                >
                    {{ isAr ? 'احجز رحلتك الآن' : 'Book Trip Now' }}
                </Link>
            </div>
        </div>
    </header>
</template>
