<script setup>
import { computed } from 'vue';


const props = defineProps({
    subheadheight: {
        type: String,
        default: 'normal'
    }
})

const subheaderHeight = computed(() => {
    return {
        'fit': 'h-fit py-1',
        xs: 'h-9',
        sm: 'h-10',
        md: 'h-11',
        'normal': 'h-12',
        lg: 'h-14',
        xl: 'h-16'
    }[props.subheadheight]
})

</script>

<template>
    <!-- Sub Header -->
    <div class="shrink-0 pointer-events-none flex items-center px-2 gap-2" :class="subheaderHeight" v-if="$slots.subheader">
        <slot name="subheader" />
    </div>
    <div class="px-1.5 p-2 grid grid-cols-1 overflow-y-auto grow" data-aside>
        <div class="overflow-y-auto flex flex-col grow px-1 pr-1" data-aside>
            <slot />
        
        </div>
    </div>
    <div class="min-h-[3rem] ring-1 shrink-0" v-if="$slots.footer">
        <slot name="footer" />
    </div>
</template>