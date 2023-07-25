<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'sm'
    },
    stroke: {
        type: Number,
        default: 1.5
    }
})

const iconSize = computed(() => {
    return {
        xxs: 'w-2 h-2',
        xs: 'w-3 h-3',
        sm: 'w-4 h-4',
        md: 'w-5 h-5',
        lg: 'w-6 h-6',
        xl: 'w-7 h-7',
        '2xl': 'w-8 h-8',
    }[props.size];
});

</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :stroke-width="stroke" stroke="currentColor" :class="iconSize">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>
</template>