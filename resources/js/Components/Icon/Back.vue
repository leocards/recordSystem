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
        normal: 'w-6 h-6'
    }[props.size];
});
</script>

<template>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :stroke-width="stroke" stroke="currentColor" :class="iconSize">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
</svg>
</template>