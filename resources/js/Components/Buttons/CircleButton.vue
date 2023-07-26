<script setup>
const props = defineProps({
    tooltip_label: String,
    tooltip_position: {
        type: String,
        default: '-bottom-6'
    },
    active: Boolean,
    bgHoverDarker: {
        type: Boolean,
        default: false
    }
})

const bghovers = props.bgHoverDarker?'hover:bg-gray-200':'hover:bg-gray-100'

</script>

<template>
    <button :class="[active?'circle_button_active':(bgHoverDarker?'circle_button hover:bg-gray-200':'circle_button hover:bg-gray-100')], bghovers" data-button>
        <slot />
        <span :class="tooltip_position">
            {{ tooltip_label }}
        </span>
    </button>
</template>

<style scoped>

button {
    @apply w-10 h-10 rounded-full flex items-center justify-center relative pointer-events-auto disabled:hover:pointer-events-none hover:shadow-insetShadow select-none
}

span {
    @apply absolute opacity-0 pointer-events-none bg-gray-700 text-white text-xs px-2 py-1 rounded mt-2 whitespace-nowrap font-normal
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

button:hover span {
    animation-name: fadeIn;
    animation-delay: 1.5s;
    animation-duration: .2s;
    animation-fill-mode: forwards;
    opacity: 0;
}

</style>