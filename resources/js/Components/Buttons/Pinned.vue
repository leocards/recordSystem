<script setup>
import Pin from '@/Components/Icon/Pin.vue';
import Right from '@/Components/Icon/Right.vue';

const props = defineProps({
    active: Boolean
})

</script>

<template>
    <div
        class="lg:w-full w-12 lg:h-10 h-12 rounded-lg flex items-center justify-center lg:justify-normal px-2 shrink-0
        cursor-pointer mx-auto lg:mx-0 relative transition duration-150 btn group ring-1"
        :class="[active?'bg-green-700/20 text-green-700 ring-green-600/60':'hover:bg-gray-100 text-gray-600 hover:text-gray-800 ring-slate-700/10']"
        data-button
    >
        <span class="text-slate-500"><Pin :size="21"/></span> <span class="lg:block hidden group-hover:block pinned">Pinned documents</span>

        <div class="ml-auto mr-2 lg:block hidden pointer-events-none transition duration-200" :class="[active?'rotate-90':'-rotate-90']"><Right :size="10" /></div>

        <span class="absolute lg:top-0 lg:left-4 lg:right-0 lg:w-fit pointer-events-none top-1.5 right-0.5 rounded-full bg-red-600 min-w-[1rem] px-0.5 pt-px h-4 flex 
        items-center justify-center text-[11px] leading-[1px] text-white">1</span>
    </div>
</template>

<style scoped>

.pinned {
    @apply max_lg:absolute lg:relative lg:opacity-100 opacity-0 pointer-events-none max_lg:bg-gray-700 max_lg:text-white text-sm px-2 py-1 rounded whitespace-nowrap max_lg:-bottom-7 
    max_lg:left-0
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
@media only screen and (max-width: 1023px) {
    .btn:hover .pinned {
        animation-name: fadeIn;
        animation-delay: 1.5s;
        animation-duration: .2s;
        animation-fill-mode: forwards;
        opacity: 0;
    }
}
</style>
