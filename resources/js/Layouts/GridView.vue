<script setup>
import { computed } from 'vue';

const props = defineProps({
    gridSize: {
        type: String,
        default: 'sm'
    }
})
const emits = defineEmits([
    'click',
    'contextmenu',
    'doubleclick',
])

const gridView = computed(() => {
    return {
        xs: 'grid grid-cols-[repeat(auto-fill,minmax(10rem,1fr))]',
        sm: 'grid grid-cols-[repeat(auto-fill,minmax(13rem,1fr))]',
        smd: 'grid grid-cols-[repeat(auto-fill,minmax(13.3rem,1fr))]',
        md: 'grid grid-cols-[repeat(auto-fill,minmax(14rem,1fr))]',
        lg: 'grid grid-cols-[repeat(auto-fill,minmax(15rem,1fr))]',
        xl: 'grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))]',
        '2xl': 'grid grid-cols-[repeat(auto-fill,minmax(17rem,1fr))]',
    }[props.gridSize];
});

</script>

<template>
    <div class="text-sm" :class="gridView">
        <slot />
    </div>
</template>