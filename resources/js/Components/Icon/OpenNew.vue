<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'normal'
    }
})

const iconSize = computed(() => {
    return {
        xs: 'w-3 h-3',
        sm: 'w-4 h-4',
        normal: 'w-5 h-5',
        md: 'w-6 h-6',
        lg: 'w-7 h-7'
    }[props.size]
})
</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" :class="iconSize">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
    </svg>
</template>