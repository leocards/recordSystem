<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-full font-medium text-xs text-gray-700 
        normal-case tracking-wide shadow-sm hover:bg-gray-100 focus:outline-none active:bg-gray-200
        disabled:opacity-25 transition ease-in-out duration-150 select-none"
        data-button
    >
        <slot />
    </button>
</template>
