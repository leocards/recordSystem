<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    },
    stroke: {
        type: Number,
        default: 1.7
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
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :stroke-width="stroke" stroke="currentColor" :class="iconSize">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
    </svg>
</template>