<script setup>
import { ref } from 'vue';
import { useLocale } from '@/composables/useLocale';
import { Sparkles, Send, Bot, User, CheckCircle2, Calendar, MapPin, Compass } from 'lucide-vue-next';
import SaudiRiyalIcon from '@/Components/SaudiRiyalIcon.vue';

const { isAr, locale } = useLocale();

// State for conversational chat
const messages = ref([
    {
        sender: 'bot',
        text: isAr.value
            ? 'مرحباً بك! أنا مساعد السفر الذكي لمنصة أجنحة السعودية. يمكنني تصميم مسار سياحي مخصص لك، واقتراح أرقى الفنادق والرحلات الجوية بين الرياض والعلا والبحر الأحمر وجدة.'
            : 'Welcome! I am SaudiWings AI Travel Concierge. I can create a customized luxury itinerary for you, suggest flights, and recommend the finest destinations across Saudi Arabia.'
    }
]);

const userInput = ref('');
const isTyping = ref(false);

const samplePrompts = [
    { ar: 'خطط لي رحلة 3 أيام في العلا', en: 'Plan a 3-day luxury trip in AlUla' },
    { ar: 'أفضل منتجعات جزر البحر الأحمر', en: 'Best resorts in The Red Sea islands' },
    { ar: 'فعاليات موسم الرياض ومطل البجيري', en: 'Riyadh Season highlights & Bujairi Terrace' },
    { ar: 'شروط التأشيرة السياحية السعودية', en: 'Saudi tourist eVisa requirements' }
];

const sendPrompt = async (text) => {
    if (!text.trim()) return;

    messages.value.push({ sender: 'user', text });
    userInput.value = '';
    isTyping.value = true;

    try {
        const response = await fetch('/api/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                message: text,
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
            throw new Error('API request fallback');
        }
    } catch (e) {
        // Safe offline simulated reply
        setTimeout(() => {
            messages.value.push({
                sender: 'bot',
                text: isAr.value
                    ? 'يسعدني مساعدتك! العلا والبحر الأحمر من أروع وجهات المملكة لرحلات الرفاهية والاستكشاف. هل تفضل مساراً يركز على الآثار التاريخية ومسرح مرايا، أم تجربة شاطئية عائمة في منتجعات البحر الأحمر؟'
                    : 'Delighted to help! AlUla and The Red Sea represent the pinnacle of Saudi luxury travel. Would you prefer a historical itinerary at Hegra and Maraya, or an overwater reef retreat at St. Regis Red Sea?'
            });
        }, 500);
    } finally {
        isTyping.value = false;
    }
};

// State for quick itinerary generator
const selectedDestination = ref('AlUla');
const selectedDays = ref(3);
const selectedStyle = ref('Luxury & Culture');
const generatedItinerary = ref(null);
const isGenerating = ref(false);

const generateQuickPlan = async () => {
    isGenerating.value = true;
    try {
        const response = await fetch('/api/ai/itinerary', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                destination: selectedDestination.value,
                days: selectedDays.value,
                style: selectedStyle.value,
                locale: locale.value
            })
        });

        if (response.ok) {
            generatedItinerary.value = await response.json();
        }
    } catch (e) {
        console.warn('Itinerary fetch error:', e);
    } finally {
        isGenerating.value = false;
    }
};
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/60 text-[#1E6BFF] text-xs font-bold mb-3">
                <Sparkles class="w-3.5 h-3.5" />
                <span>{{ isAr ? 'تقنية الذكاء الاصطناعي للمسافرين' : 'AI-POWERED TRAVEL ASSISTANT' }}</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0D1527] tracking-tight">
                {{ isAr ? 'مساعد السفر الذكي لمملكة المستقبل' : 'Your Personal AI Journey Designer' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-3 leading-relaxed">
                {{ isAr 
                    ? 'صمم رحلتك المثالية في ثوانٍ مع خوارزميات الذكاء الاصطناعي المدربة على فهم خيارات السفر والمواسم والوجهات السعودية الفاخرة.'
                    : 'Craft tailor-made Saudi itineraries with smart concierge algorithms ready for future OpenAI integration.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Conversational Chat Interface (7 cols) -->
            <div class="lg:col-span-7 bg-white rounded-3xl card-soft-shadow border border-slate-100 overflow-hidden flex flex-col h-[520px]">
                <!-- Chat Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-slate-900 to-slate-800 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#1E6BFF] flex items-center justify-center text-white shadow-md">
                            <Bot class="w-5 h-5" />
                        </div>
                        <div>
                            <h4 class="font-extrabold text-sm flex items-center gap-2">
                                SaudiWings AI Concierge
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            </h4>
                            <span class="text-[11px] text-slate-300">{{ isAr ? 'مساعد افتراضي مدعوم بالذكاء الاصطناعي' : 'Smart Travel Assistant' }}</span>
                        </div>
                    </div>
                    <span class="text-[10px] uppercase font-mono px-2.5 py-1 rounded bg-slate-800 border border-slate-700 text-slate-300">
                        Prototype Mode
                    </span>
                </div>

                <!-- Chat Messages Scroll Area -->
                <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-slate-50/50">
                    <div
                        v-for="(msg, idx) in messages"
                        :key="idx"
                        class="flex items-start gap-3"
                        :class="msg.sender === 'user' ? 'flex-row-reverse' : ''"
                    >
                        <!-- Avatar -->
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white text-xs"
                            :class="msg.sender === 'user' ? 'bg-[#0D1527]' : 'bg-[#1E6BFF]'"
                        >
                            <User v-if="msg.sender === 'user'" class="w-4 h-4" />
                            <Bot v-else class="w-4 h-4" />
                        </div>

                        <!-- Bubble -->
                        <div
                            class="max-w-[80%] rounded-2xl p-4 text-xs sm:text-sm leading-relaxed shadow-sm"
                            :class="msg.sender === 'user'
                                ? 'bg-[#1E6BFF] text-white rounded-tr-none rtl:rounded-tr-2xl rtl:rounded-tl-none'
                                : 'bg-white text-slate-800 border border-slate-100 rounded-tl-none rtl:rounded-tl-2xl rtl:rounded-tr-none'"
                        >
                            <p class="whitespace-pre-line">{{ msg.text }}</p>

                            <!-- Bot Suggestion Chips -->
                            <div v-if="msg.suggestions && msg.suggestions.length" class="mt-3 pt-2 border-t border-slate-100 flex flex-wrap gap-1.5">
                                <button
                                    v-for="sug in msg.suggestions"
                                    :key="sug"
                                    @click="sendPrompt(sug)"
                                    class="px-2.5 py-1 rounded-full text-[11px] bg-blue-50 hover:bg-blue-100 text-[#1E6BFF] font-medium transition-colors cursor-pointer"
                                >
                                    {{ sug }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Typing indicator -->
                    <div v-if="isTyping" class="flex items-center gap-2 text-slate-400 text-xs">
                        <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-[#1E6BFF]">
                            <Bot class="w-4 h-4" />
                        </div>
                        <span class="animate-pulse">{{ isAr ? 'المساعد يفكر ويكتب الإجابة...' : 'AI Concierge is typing...' }}</span>
                    </div>
                </div>

                <!-- Example Chips & Input Bar -->
                <div class="p-4 bg-white border-t border-slate-100 space-y-2">
                    <div class="flex items-center gap-1.5 overflow-x-auto pb-1 text-xs">
                        <span class="text-[11px] font-bold text-slate-400 shrink-0">{{ isAr ? 'جرّب السؤال:' : 'Quick Prompts:' }}</span>
                        <button
                            v-for="p in samplePrompts"
                            :key="p.en"
                            @click="sendPrompt(isAr ? p.ar : p.en)"
                            class="shrink-0 px-2.5 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-[#1E6BFF] text-slate-600 text-[11px] transition-colors cursor-pointer"
                        >
                            {{ isAr ? p.ar : p.en }}
                        </button>
                    </div>

                    <form @submit.prevent="sendPrompt(userInput)" class="flex items-center gap-2">
                        <input
                            v-model="userInput"
                            type="text"
                            :placeholder="isAr ? 'اسأل عن وجهات السعودية، الرحلات، أو خطط لرحلتك...' : 'Ask about Saudi destinations, flights, or plan your journey...'"
                            class="flex-1 px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:outline-none focus:border-[#1E6BFF]"
                        />
                        <button
                            type="submit"
                            :disabled="!userInput.trim() || isTyping"
                            class="px-5 py-3 rounded-2xl bg-[#1E6BFF] hover:bg-blue-600 disabled:opacity-50 text-white font-bold text-xs flex items-center gap-1.5 shadow-md transition-all cursor-pointer"
                        >
                            <Send class="w-4 h-4 rtl:rotate-180" />
                            <span class="hidden sm:inline">{{ isAr ? 'إرسال' : 'Send' }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Quick Itinerary Generator Form (5 cols) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 card-soft-shadow border border-slate-100 space-y-6">
                <div>
                    <h3 class="text-xl font-black text-slate-900 flex items-center gap-2">
                        <Compass class="w-5 h-5 text-[#1E6BFF]" />
                        {{ isAr ? 'مولّد المسارات السريعة' : 'Instant Itinerary Builder' }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        {{ isAr ? 'اختر وجهتك وأسلوب رحلتك لتوليد برنامج يومي دقيق' : 'Select your preference to craft a day-by-day plan' }}
                    </p>
                </div>

                <!-- Form Controls -->
                <div class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'الوجهة المستهدفة' : 'Target Destination' }}</label>
                        <select v-model="selectedDestination" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:outline-none">
                            <option value="AlUla">{{ isAr ? 'العلا (Hegra & Maraya)' : 'AlUla' }}</option>
                            <option value="RedSea">{{ isAr ? 'جزر البحر الأحمر (St. Regis)' : 'The Red Sea' }}</option>
                            <option value="Riyadh">{{ isAr ? 'الرياض والدرعية (Diriyah & Boulevard)' : 'Riyadh' }}</option>
                            <option value="Jeddah">{{ isAr ? 'جدة والبلد التاريخي (Al Balad)' : 'Jeddah' }}</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'مدة الرحلة (أيام)' : 'Duration (Days)' }}</label>
                            <select v-model="selectedDays" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:outline-none">
                                <option :value="1">1 {{ isAr ? 'يوم' : 'Day' }}</option>
                                <option :value="2">2 {{ isAr ? 'يومان' : 'Days' }}</option>
                                <option :value="3">3 {{ isAr ? 'أيام' : 'Days' }}</option>
                                <option :value="5">5 {{ isAr ? 'أيام' : 'Days' }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">{{ isAr ? 'طابع السفر' : 'Travel Style' }}</label>
                            <select v-model="selectedStyle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:outline-none">
                                <option value="Luxury & Culture">{{ isAr ? 'فخامة وتراث' : 'Luxury & Culture' }}</option>
                                <option value="Adventure & Desert">{{ isAr ? 'مغامرات وطبيعة' : 'Adventure & Nature' }}</option>
                                <option value="Family & Entertainment">{{ isAr ? 'عائلي وترفيه' : 'Family & Leisure' }}</option>
                            </select>
                        </div>
                    </div>

                    <button
                        type="button"
                        @click="generateQuickPlan"
                        :disabled="isGenerating"
                        class="w-full py-3.5 rounded-2xl bg-[#0D1527] hover:bg-[#1E6BFF] text-white font-extrabold text-xs sm:text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-75"
                    >
                        <Sparkles class="w-4 h-4 text-blue-400" />
                        <span>{{ isGenerating ? (isAr ? 'جاري التوليد...' : 'Generating...') : (isAr ? 'توليد المسار الذكي' : 'Generate AI Plan') }}</span>
                    </button>
                </div>

                <!-- Generated Output Preview -->
                <div v-if="generatedItinerary" class="p-4 rounded-2xl bg-blue-50/60 border border-blue-100 text-xs space-y-3 animate-in fade-in">
                    <div class="flex items-center justify-between gap-3">
                        <span class="font-black text-slate-900 text-sm">{{ generatedItinerary.title }}</span>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-100/80 text-[#1E6BFF] font-black text-xs shrink-0 shadow-xs">
                            <span>{{ String(generatedItinerary.estimatedCost).replace('ر.س', '').replace('SAR', '').trim() }}</span>
                            <SaudiRiyalIcon className="h-3.5 w-auto" color="#1E6BFF" />
                        </div>
                    </div>
                    <p class="text-slate-600 leading-relaxed">{{ generatedItinerary.highlight }}</p>

                    <div class="space-y-2 pt-2 border-t border-blue-100">
                        <div v-for="d in generatedItinerary.itinerary" :key="d.day" class="p-2.5 rounded-xl bg-white border border-slate-100">
                            <span class="font-bold text-[#1E6BFF] block">{{ isAr ? `اليوم ${d.day}: ${d.title}` : `Day ${d.day}: ${d.title}` }}</span>
                            <ul class="list-disc list-inside text-slate-600 mt-1 space-y-0.5">
                                <li v-for="(act, i) in d.activities" :key="i">{{ act }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
