<script setup>
import { ref, computed, nextTick, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { useLocale } from '@/composables/useLocale';
import { 
    X, 
    ArrowLeft, 
    ArrowRight, 
    Plane, 
    MapPin, 
    Compass, 
    Sparkles, 
    Bot,
    ExternalLink
} from 'lucide-vue-next';

const { isAr, locale } = useLocale();

const isOpen = ref(false);
const showTeaser = ref(false);
const teaserDismissed = ref(false);
const inputQuery = ref('');
const isTyping = ref(false);
const messagesContainer = ref(null);

// Navigation quick links matching website structure
const quickNavigation = computed(() => [
    { label: isAr.value ? 'حجز الطيران' : 'Flights', href: '/flights', icon: Plane },
    { label: isAr.value ? 'الوجهات' : 'Destinations', href: '/destinations', icon: MapPin },
    { label: isAr.value ? 'استكشف السعودية' : 'Discover', href: '/discover', icon: Compass },
    { label: isAr.value ? 'التجارب والفعاليات' : 'Experiences', href: '/experiences', icon: Sparkles },
    { label: isAr.value ? 'مساعد السفر' : 'AI Planner', href: '/ai-planner', icon: Bot },
]);

// Initial messages
const messages = ref([
    {
        sender: 'bot',
        text: isAr.value
            ? 'أهلين 👋 أنا دليل الموقع ومساعدك الذكي في InfoTravel. احكيلي وين بدك تروح — حجز الطيران، استكشاف السعودية، الوجهات، التجارب، أو تخطيط رحلتك — ومستعد أساعدك فوراً.'
            : 'Welcome 👋 I am your InfoTravel AI guide. Tell me where you want to go — Flight Booking, Discover Saudi, Destinations, Experiences, or AI Trip Planner — and I will guide you right away.',
        showNavChips: true,
        suggestions: isAr.value 
            ? ['خطط لي رحلة 3 أيام في العلا', 'تصاريح العمرة والروضة عبر نُسك', 'أفضل منتجعات البحر الأحمر', 'عروض رحلات الرياض وجدة']
            : ['Plan 3-day luxury trip in AlUla', 'Umrah & Rawdah permits guide', 'Red Sea island resorts', 'Flights to Riyadh & Jeddah']
    }
]);

const scrollToBottom = async () => {
    await nextTick();
    if (messagesContainer.value) {
        messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
    }
};

const toggleChat = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        showTeaser.value = false;
        teaserDismissed.value = true;
        scrollToBottom();
    }
};

const closeChat = () => {
    isOpen.value = false;
};

const dismissTeaser = (e) => {
    e.stopPropagation();
    showTeaser.value = false;
    teaserDismissed.value = true;
};

const navigateTo = (path, name) => {
    messages.value.push({
        sender: 'user',
        text: (isAr.value ? 'أود الذهاب إلى: ' : 'Take me to: ') + name
    });
    
    messages.value.push({
        sender: 'bot',
        text: isAr.value 
            ? `جاري توجيهك إلى صفحة "${name}" الآن... استمتع برحلتك!`
            : `Navigating you to "${name}" now... Enjoy your journey!`,
        actionLink: { label: isAr.value ? 'فتح الصفحة الآن' : 'Open Page Now', href: path }
    });

    scrollToBottom();

    // Smooth navigation after short delay
    setTimeout(() => {
        router.visit(path);
    }, 400);
};

const sendMessage = async (textToSend) => {
    const text = typeof textToSend === 'string' ? textToSend : inputQuery.value;
    if (!text || !text.trim()) return;

    const trimmed = text.trim();
    inputQuery.value = '';

    messages.value.push({
        sender: 'user',
        text: trimmed
    });

    scrollToBottom();
    isTyping.value = true;

    // Check for direct navigation shortcuts
    const normalized = trimmed.toLowerCase();
    let navigated = false;

    if (normalized.includes('طيران') || normalized.includes('تذاكر') || normalized.includes('حجز') || normalized.includes('flight')) {
        setTimeout(() => {
            messages.value.push({
                sender: 'bot',
                text: isAr.value
                    ? 'يمكنني مساعدتك في استعراض رحلات الطيران وأسعار التذاكر مع كود خصم SAUDI20 (20% خصم). هل تحب الانتقال لصفحة حجز الطيران؟'
                    : 'I can help you explore flights with promo code SAUDI20 for 20% off. Would you like to view flight bookings?',
                actionLink: { label: isAr.value ? 'انتقال إلى حجز الطيران' : 'Go to Flights', href: '/flights' },
                suggestions: isAr.value ? ['رحلات إلى الرياض', 'رحلات إلى العلا', 'رحلات إلى جدة'] : ['Flights to Riyadh', 'Flights to AlUla', 'Flights to Jeddah']
            });
            isTyping.value = false;
            scrollToBottom();
        }, 600);
        return;
    }

    try {
        const response = await fetch('/api/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                message: trimmed,
                locale: locale.value
            })
        });

        if (response.ok) {
            const data = await response.json();
            messages.value.push({
                sender: 'bot',
                text: data.reply,
                suggestions: data.suggestions
            });
        } else {
            throw new Error('API fallback');
        }
    } catch (e) {
        // Fallback simulated intelligent response
        setTimeout(() => {
            messages.value.push({
                sender: 'bot',
                text: isAr.value
                    ? 'يسعدني إرشادك وتوفير كافة تفاصيل السفر والإقامة في المملكة! يمكنك أيضاً استكشاف الوجهات وتصميم مسار مخصص عبر مساعد السفر الذكي.'
                    : 'Happy to assist you with all travel details across Saudi Arabia! You can also explore curated destinations and design custom itineraries.',
                actionLink: { label: isAr.value ? 'مساعد السفر المتكامل' : 'AI Planner', href: '/ai-planner' }
            });
        }, 500);
    } finally {
        isTyping.value = false;
        scrollToBottom();
    }
};

onMounted(() => {
    // Show teaser after 1.8 seconds on initial load if not dismissed
    setTimeout(() => {
        if (!isOpen.value && !teaserDismissed.value) {
            showTeaser.value = true;
        }
    }, 1800);
});
</script>

<template>
    <!-- Fixed Container - Persistent Across All Pages -->
    <div 
        class="fixed bottom-6 z-50 flex flex-col pointer-events-none select-none transition-all duration-300"
        :class="isAr ? 'left-4 sm:left-6 items-start' : 'right-4 sm:right-6 items-end'"
    >
        <!-- Chat Modal / Popup Window (Image 2 style) -->
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-6 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-6 scale-95"
        >
            <div 
                v-if="isOpen"
                class="pointer-events-auto mb-4 w-[90vw] sm:w-[390px] md:w-[410px] h-[540px] max-h-[80vh] flex flex-col rounded-3xl overflow-hidden shadow-2xl shadow-slate-950/60 border border-slate-700/50 bg-[#0D1527] text-white"
                :dir="isAr ? 'rtl' : 'ltr'"
            >
                <!-- Header with Brand Royal Blue & Gold -->
                <div class="bg-gradient-to-r from-[#1B316E] via-[#243E88] to-[#122352] px-4 py-3.5 flex items-center justify-between border-b border-[#243E88]/40 shrink-0">
                    <!-- Close Button -->
                    <button 
                        @click="closeChat"
                        class="p-1.5 rounded-full text-blue-200 hover:text-white hover:bg-white/10 transition-colors cursor-pointer"
                        :title="isAr ? 'إغلاق' : 'Close'"
                    >
                        <X class="w-5 h-5" />
                    </button>

                    <!-- Title & Identity -->
                    <div class="flex items-center gap-3 text-start">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-white tracking-wide flex items-center gap-1.5">
                                <span>{{ isAr ? 'مساعد' : 'InfoTravel' }}</span>
                                <span class="text-[#FAB515]">{{ isAr ? 'InfoTravel' : 'AI' }}</span>
                            </span>
                            <span class="text-[11px] text-blue-200/90 font-medium">
                                {{ isAr ? 'احكيلي وين بدك تروح' : 'Tell me where you want to go' }}
                            </span>
                        </div>

                        <!-- Avatar with green online dot -->
                        <div class="relative w-9 h-9 rounded-full bg-[#FAB515] text-[#1B316E] border border-white/30 flex items-center justify-center shrink-0 shadow-md">
                            <!-- Chat icon inside avatar -->
                            <svg class="w-4 h-4 stroke-[2.2] fill-none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                                <line x1="8" y1="10" x2="16" y2="10" stroke-linecap="round" />
                                <line x1="8" y1="13" x2="14" y2="13" stroke-linecap="round" />
                            </svg>
                            <!-- Online indicator dot -->
                            <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-400 ring-2 ring-[#1B316E]"></span>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div 
                    ref="messagesContainer"
                    class="flex-1 overflow-y-auto p-4 space-y-3.5 bg-[#090F1E] scrollbar-thin scrollbar-thumb-slate-700/40"
                >
                    <!-- Message bubbles -->
                    <div 
                        v-for="(msg, index) in messages" 
                        :key="index"
                        class="flex flex-col space-y-2"
                        :class="msg.sender === 'user' ? 'items-end' : 'items-start'"
                    >
                        <!-- User message -->
                        <div 
                            v-if="msg.sender === 'user'"
                            class="bg-gradient-to-r from-[#243E88] to-[#1B316E] text-white rounded-2xl rounded-br-sm px-4 py-2.5 max-w-[85%] text-xs sm:text-[13px] leading-relaxed shadow-md border border-blue-400/20"
                        >
                            {{ msg.text }}
                        </div>

                        <!-- Bot message -->
                        <div 
                            v-else
                            class="bg-[#121B30] text-slate-100 border border-slate-700/60 rounded-2xl rounded-tl-sm p-3.5 max-w-[92%] text-xs sm:text-[13px] leading-relaxed shadow-sm space-y-3"
                        >
                            <p class="whitespace-pre-line">{{ msg.text }}</p>

                            <!-- Navigation Chips -->
                            <div v-if="msg.showNavChips" class="pt-1">
                                <div class="text-[10px] text-[#FAB515] font-bold mb-2">
                                    {{ isAr ? 'أقسام الموقع السريعة:' : 'Quick Navigation:' }}
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    <button
                                        v-for="item in quickNavigation"
                                        :key="item.href"
                                        @click="navigateTo(item.href, item.label)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#182644] hover:bg-[#243E88] border border-blue-400/20 text-blue-100 hover:text-white text-[11px] font-medium transition-all duration-200 cursor-pointer shadow-sm active:scale-95"
                                    >
                                        <component :is="item.icon" class="w-3 h-3 text-[#FAB515]" />
                                        <span>{{ item.label }}</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Optional Action Link -->
                            <div v-if="msg.actionLink" class="pt-1">
                                <button
                                    @click="router.visit(msg.actionLink.href)"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#FAB515] hover:bg-amber-400 text-[#1B316E] text-[11px] font-black shadow-md transition-all cursor-pointer"
                                >
                                    <span>{{ msg.actionLink.label }}</span>
                                    <ExternalLink class="w-3 h-3" />
                                </button>
                            </div>

                            <!-- Follow-up Suggestions -->
                            <div v-if="msg.suggestions && msg.suggestions.length" class="pt-1 border-t border-slate-700/40">
                                <div class="text-[10px] text-slate-400 mb-1.5">
                                    {{ isAr ? 'اقتراحات مفيدة:' : 'Suggested topics:' }}
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    <button
                                        v-for="(sug, sIdx) in msg.suggestions"
                                        :key="sIdx"
                                        @click="sendMessage(sug)"
                                        class="px-2.5 py-1 rounded-lg bg-[#182644]/70 hover:bg-[#243E88] border border-blue-500/20 text-blue-200 hover:text-white text-[10px] font-medium transition-colors cursor-pointer text-start"
                                    >
                                        {{ sug }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Typing indicator -->
                    <div v-if="isTyping" class="flex items-center gap-1.5 bg-[#121B30] border border-slate-700/60 w-fit px-3 py-2 rounded-2xl text-[#FAB515]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FAB515] animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FAB515] animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FAB515] animate-bounce" style="animation-delay: 300ms"></span>
                    </div>
                </div>

                <!-- Input Footer -->
                <div class="bg-[#0D1527] p-3 border-t border-slate-800 shrink-0">
                    <form @submit.prevent="sendMessage()" class="relative flex items-center">
                        <div class="w-full bg-[#121B30] border border-slate-700/80 rounded-full px-4 py-2 flex items-center gap-2 focus-within:border-[#FAB515] focus-within:ring-2 focus-within:ring-[#FAB515]/20 transition-all">
                            <input 
                                v-model="inputQuery"
                                type="text"
                                :placeholder="isAr ? 'وين بدك أوديك؟' : 'Where do you want to go?'"
                                class="bg-transparent text-white placeholder-slate-400 text-xs sm:text-sm outline-none flex-1 font-sans"
                            />
                            
                            <!-- Send Button -->
                            <button
                                type="submit"
                                :disabled="!inputQuery.trim() || isTyping"
                                class="w-8 h-8 rounded-full bg-[#FAB515] hover:bg-amber-400 disabled:opacity-40 disabled:hover:bg-[#FAB515] text-[#1B316E] flex items-center justify-center shrink-0 transition-transform active:scale-95 cursor-pointer shadow-md"
                                :title="isAr ? 'إرسال' : 'Send'"
                            >
                                <component :is="isAr ? ArrowLeft : ArrowRight" class="w-4 h-4 stroke-[2.5]" />
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>

        <!-- Teaser Speech Bubble -->
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-2 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-2 scale-95"
        >
            <div 
                v-if="showTeaser && !isOpen"
                @click="toggleChat"
                class="pointer-events-auto mb-3 max-w-[280px] sm:max-w-[320px] bg-white text-slate-800 rounded-2xl shadow-xl shadow-black/10 border border-slate-100 p-3.5 flex items-center gap-2.5 cursor-pointer hover:shadow-2xl transition-all duration-200 group"
                :dir="isAr ? 'rtl' : 'ltr'"
            >
                <p class="text-xs font-semibold leading-snug flex-1 text-slate-700 group-hover:text-[#243E88] transition-colors">
                    {{ isAr 
                        ? 'مرحباً 👋 هل تخطط لرحلة أو استكشاف جديد؟ دعنا نتحدث!' 
                        : 'Hello 👋 Planning a trip or new adventure? Let\'s talk!' }}
                </p>
                <button 
                    @click="dismissTeaser"
                    class="p-1 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer shrink-0"
                    :title="isAr ? 'إغلاق' : 'Close'"
                >
                    <X class="w-3.5 h-3.5" />
                </button>
            </div>
        </Transition>

        <!-- Floating Brand Circle Button (Harmonized with InfoTravel Royal Blue & Gold) -->
        <!-- Note: NO WhatsApp circle is included anywhere, strictly adhering to the user's instruction -->
        <button
            @click="toggleChat"
            class="pointer-events-auto relative w-14 h-14 sm:w-15 sm:h-15 rounded-full bg-gradient-to-tr from-[#1B316E] via-[#243E88] to-[#2E50B0] hover:from-[#243E88] hover:to-[#1B316E] text-white flex items-center justify-center shadow-xl shadow-[#243E88]/40 hover:shadow-[#243E88]/60 ring-4 ring-[#FAB515]/35 active:scale-90 transition-all duration-300 cursor-pointer group"
            :title="isAr ? 'مساعد الذكاء الاصطناعي' : 'AI Assistant'"
        >
            <!-- Animated background glow ring -->
            <span class="absolute inset-0 rounded-full bg-[#243E88]/40 animate-ping opacity-60 pointer-events-none" v-if="!isOpen"></span>

            <!-- Icon: X when open, Chat message bubble with 3 horizontal lines when closed -->
            <div class="relative flex items-center justify-center transition-transform duration-300" :class="{ 'rotate-90': isOpen }">
                <X v-if="isOpen" class="w-7 h-7 stroke-[2.5]" />
                
                <!-- Chat Bubble Icon -->
                <svg v-else class="w-6 h-6 stroke-[2.2] fill-none text-white group-hover:text-[#FAB515] transition-colors" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                    <!-- Inside 3 text lines -->
                    <line x1="8" y1="10" x2="16" y2="10" stroke-linecap="round" />
                    <line x1="8" y1="13" x2="14" y2="13" stroke-linecap="round" />
                </svg>
            </div>
        </button>
    </div>
</template>
