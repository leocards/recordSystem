<script setup>
import { computed } from 'vue';

const props = defineProps({
    height: {
        type: String,
        default: 'xs'
    },
    styles: String,
    active: Boolean
})

const emits = defineEmits(['handleContext'])

const height = computed(() => {
    return {
        xs: 'h-12',
        sm: 'h-16',
        md: 'h-20',
        lg: 'h-24',
        xl: 'h-28',
        '2xl': 'h-32',
        '3xl': 'h-36',
        '4xl': 'h-40',
    }[props.height];
});

</script>

<template>
    <div class="h-fit p-1.5 pointer-events-none">
        <div 
            class="rounded-xl cursor-pointer pointer-events-auto select-none"
            :class="
                height, styles,
                [active?'bg-green-600/20 border-gree n-700/30':'hover:bg-gray-200 border-gray-300 bg-slate-100 [#f6f6f6] gray-100/80 card-dark']
            " 
            data-record
            @contextmenu="$emit('handleContext')"
        >
            <slot />
        </div>
    </div>
</template>