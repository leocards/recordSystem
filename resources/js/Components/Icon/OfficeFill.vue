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
    <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 000 1.5v16.5h-.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5h-.75V3.75a.75.75 0 000-1.5h-15zM9 6a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm-.75 3.75A.75.75 0 019 9h1.5a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM9 12a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm3.75-5.25A.75.75 0 0113.5 6H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM13.5 9a.75.75 0 000 1.5H15A.75.75 0 0015 9h-1.5zm-.75 3.75a.75.75 0 01.75-.75H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM9 19.5v-2.25a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75h-4.5A.75.75 0 019 19.5z" clip-rule="evenodd" />
</svg>
</template>