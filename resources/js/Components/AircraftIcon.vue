<script setup>
defineProps({
    className: {
        type: String,
        default: 'w-6 h-6'
    },
    variant: {
        type: String,
        default: 'primary' // 'primary' | 'white' | 'gold' | 'monochrome'
    },
    angle: {
        type: Number,
        default: 0 // degrees
    }
});
</script>

<template>
    <svg
        :class="[className, 'transition-transform duration-300 select-none shrink-0']"
        :style="{ transform: `rotate(${angle}deg)` }"
        viewBox="0 0 64 64"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <!-- Modern Luxury Aerodynamic Jetliner Vector (Airbus A350 / Boeing 787 Silhouette) -->
        <g filter="url(#drop-shadow)">
            <!-- Main Fuselage -->
            <path
                d="M32 4C30.2 4 29.1 7.2 29.1 12.8L29 26.5L8.5 37.8C7.1 38.6 6.8 40.4 7.8 41.5C8.8 42.6 10.5 42.5 12 41.7L29 33.2V47.2L22.8 52.1C21.8 52.9 21.6 54.3 22.4 55.2C23.1 56 24.5 56.1 25.5 55.5L32 52L38.5 55.5C39.5 56.1 40.9 56 41.6 55.2C42.4 54.3 42.2 52.9 41.2 52.1L35 47.2V33.2L52 41.7C53.5 42.5 55.2 42.6 56.2 41.5C57.2 40.4 56.9 38.6 55.5 37.8L35 26.5L34.9 12.8C34.9 7.2 33.8 4 32 4Z"
                :fill="variant === 'white' ? '#FFFFFF' : (variant === 'gold' ? '#FAB515' : '#243E88')"
            />
            
            <!-- Winglet & Engine Turbine Accents -->
            <path
                d="M32 7C32.8 7 33.5 8.8 33.5 12V24H30.5V12C30.5 8.8 31.2 7 32 7Z"
                fill="currentColor"
                fill-opacity="0.3"
            />
            
            <!-- Left Engine Nacelle -->
            <rect
                x="21.5"
                y="30"
                width="3"
                height="8"
                rx="1.5"
                :fill="variant === 'white' ? '#E2E8F0' : '#0D1527'"
            />
            <!-- Right Engine Nacelle -->
            <rect
                x="39.5"
                y="30"
                width="3"
                height="8"
                rx="1.5"
                :fill="variant === 'white' ? '#E2E8F0' : '#0D1527'"
            />

            <!-- Sleek Cockpit Visor / Glass Reflection -->
            <path
                d="M30.6 11.2C30.6 9.8 31.2 9 32 9C32.8 9 33.4 9.8 33.4 11.2C33.4 12 32.8 12.5 32 12.5C31.2 12.5 30.6 12 30.6 11.2Z"
                :fill="variant === 'white' ? '#0D1527' : '#FFFFFF'"
                fill-opacity="0.9"
            />
        </g>
    </svg>
</template>
