<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    }
})

const iconSize = computed(() => {
    return {
        xs: 'w-4 h-4',
        sm: 'w-5 h-5',
        normal: 'w-6 h-6',
        md: 'w-7 h-7',
        lg: 'w-8 h-8',
        xl: 'w-10 h-10',
        '2xl': 'w-12 h-12',
        '3xl': 'w-14 h-14',
        '4xl': 'w-16 h-16',
        max: 'w-20 h-20',
        max2: 'w-24 h-24',
        max3: 'w-28 h-28',
    }[props.size]
})
</script>

<template>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" :class="iconSize">
    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
</svg>
</template>