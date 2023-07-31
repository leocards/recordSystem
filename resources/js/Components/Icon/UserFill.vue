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
        max4: 'w-36 h-36',
        max5: 'w-44 h-44',
        max6: 'w-52 h-52',
    }[props.size]
})
</script>
<template>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" :class="iconSize">
  <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
</svg>
</template>

