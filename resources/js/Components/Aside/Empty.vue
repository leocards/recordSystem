<script setup>
import { computed } from 'vue';


const props = defineProps({
    label: String,
    size: {
        type: String,
        default: 'md'
    }
})

const emptySize = computed(() => {
    return {
        sm: 'w-40 h-40',
        normal: 'w-48 h-48',
        md: 'w-56 h-56',
        lg: 'w-64 h-64',
        xl: 'w-72 h-72',
        '2xl': 'w-86 h-86',
        '3xl': 'w-96 h-96',
    }[props.size]
})

</script>

<template>
    <div 
        class="mx-auto my-auto rounded-full justify-center bg-gray-100 flex flex-col items-center opacity-60 text-gray-400" 
        :class="emptySize"
    >
        <div class="flex items-center flex-col">
            
            <slot />

            <div class="text-sm select-none" v-if="label" v-text="label"></div>
        </div>
    </div>
</template>