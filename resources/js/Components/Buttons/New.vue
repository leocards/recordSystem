<script setup>

const props = defineProps({
    label: String,
    mainSize: Number,
    labelPosition: String,
    margin: {
        type: String,
        default: 'ml-1'
    }
})

</script>

<template>
    <button
        data-button
        :class="[mainSize?'px-2.5':'px-4']"
        v-bind:class="margin"
        class="capsule"
    >
        <span class="text-slate-100 pointer-events-none">
            <slot/>
        </span>
        <span v-if="mainSize > 947" class="mr-1 pointer-events-none">{{ label }}</span>
        <span class="label" :class="labelPosition" v-if="mainSize <= 947">{{ label }}</span>
    </button>
</template>

<style scoped>
button {
    @apply bg-green-700 hover:bg-green-700/90 hover:shadow-md rounded-full hover:text-white transition duration-200 flex items-center gap-2 text-white relative
    active:bg-green-800 focus:outline-none
}
.label {
    @apply absolute opacity-0 pointer-events-none bg-gray-700 text-white text-xs px-2 py-1 rounded whitespace-nowrap
}
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
button:hover .label {
    animation-name: fadeIn;
    animation-delay: 1.5s;
    animation-duration: .2s;
    animation-fill-mode: forwards;
    opacity: 0;
}

</style>