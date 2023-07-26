<script setup>

const props = defineProps({
    padding: {
        type: String,
        default: 'py-2.5 px-4'
    }
})

</script>

<template>
    <button
        data-button
        :class="padding"
    >
        <slot />
    </button>
</template>

<style scoped>
button {
    @apply inline-flex items-center bg-green-700 border border-transparent rounded-full tracking-wide font-medium text-xs 
        text-white normal-case hover:bg-green-700/90 focus:bg-green-700/90 active:bg-green-800 focus:outline-none 
        transition ease-in-out duration-150 disabled:opacity-50 disabled:hover:bg-green-700 select-none
}
</style>
