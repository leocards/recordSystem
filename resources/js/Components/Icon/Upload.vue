<script setup>
import { computed } from 'vue';


const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    },
    stroke: {
        type: Number,
        default: 2
    }
})

const iconSize = computed(() => {
    return {
        xxs: 'w-2 h-2',
        xs: 'w-3 h-3',
        sm: 'w-[1.2rem] h-[1.2rem]',
        md: 'w-5 h-5',
        lg: 'w-6 h-6',
        xl: 'w-7 h-7',
        '2xl': 'w-8 h-8',
    }[props.size]
})

</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :stroke-width="stroke" stroke="currentColor" :class="iconSize">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
    </svg>
</template>