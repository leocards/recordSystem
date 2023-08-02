<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'xs'
    },
    stroke : {
        type: Number,
        default: 1.6
    }
})

const iconSize = computed(() => {
    return {
        xxs: 'w-3 h-3',
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
        max4: 'w-36 h-36',
        max5: 'w-44 h-44',
        max6: 'w-52 h-52',
    }[props.size];
});
</script>

<template>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :stroke-width="stroke" stroke="currentColor" :class="iconSize">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
</svg>
</template>