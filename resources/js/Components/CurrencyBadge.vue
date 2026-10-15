<script setup>
import SaudiRiyalIcon from '@/Components/SaudiRiyalIcon.vue';

defineProps({
    amount: {
        type: [Number, String],
        default: null
    },
    variant: {
        type: String,
        default: 'blue' // 'blue' | 'black' | 'gold' | 'white'
    },
    size: {
        type: String,
        default: 'md' // 'sm' | 'md' | 'lg'
    },
    showSuffix: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <span class="inline-flex items-center gap-1.5 align-middle select-none group font-sans">
        <!-- Formatted Price / Amount -->
        <span
            v-if="amount !== null"
            class="font-black tracking-tight"
            :class="size === 'lg' ? 'text-2xl sm:text-3xl text-[#243E88]' : (size === 'sm' ? 'text-sm font-extrabold text-[#243E88]' : 'text-lg sm:text-xl text-[#243E88]')"
        >
            {{ typeof amount === 'number' ? amount.toLocaleString('en-US') : amount }}
        </span>

        <!-- Official Saudi Riyal Emoji / Icon Glyph (Matches attached image) -->
        <span
            class="inline-flex items-center justify-center transition-transform group-hover:scale-110"
            :title="'ريال سعودي (SAR)'"
        >
            <SaudiRiyalIcon
                :className="size === 'lg' ? 'h-6 sm:h-7' : (size === 'sm' ? 'h-3.5' : 'h-4 sm:h-5')"
                :color="variant === 'white' ? '#FFFFFF' : (variant === 'gold' ? '#FAB515' : (variant === 'black' ? '#0D1527' : '#243E88'))"
            />
        </span>

        <span v-if="showSuffix" class="text-[10px] font-mono font-bold opacity-60">
            SAR
        </span>
    </span>
</template>
