<script setup>
defineProps({
    className: {
        type: String,
        default: 'h-4 w-auto'
    },
    color: {
        type: String,
        default: 'currentColor'
    },
    useImgDirect: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <!-- Direct Image (original crisp black glyph) -->
    <img
        v-if="useImgDirect || color === 'black' || color === '#000000'"
        src="/images/saudi-riyal-symbol.png"
        alt="﷼"
        :class="[className, 'inline-block align-middle select-none shrink-0 object-contain']"
        loading="lazy"
    />
    <!-- Dynamic Color Mask (adapts to brand blue, gold, white, or current text color) -->
    <span
        v-else
        :class="[className, 'inline-block align-middle select-none shrink-0 aspect-[134/150]']"
        :style="{
            maskImage: `url('/images/saudi-riyal-symbol.png')`,
            WebkitMaskImage: `url('/images/saudi-riyal-symbol.png')`,
            maskRepeat: 'no-repeat',
            WebkitMaskRepeat: 'no-repeat',
            maskPosition: 'center',
            WebkitMaskPosition: 'center',
            maskSize: 'contain',
            WebkitMaskSize: 'contain',
            backgroundColor: color === 'currentColor' ? 'currentColor' : color
        }"
        aria-label="ريال سعودي"
    >
        <span class="sr-only">ريال سعودي</span>
    </span>
</template>
