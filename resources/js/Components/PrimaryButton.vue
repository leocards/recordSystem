<template>
    <button
        data-button
    >
        <slot />
    </button>
</template>

<style scoped>
button {
    @apply inline-flex items-center px-4 py-2.5 bg-green-700 border border-transparent rounded-full tracking-wide font-medium text-xs 
        text-white normal-case hover:bg-green-700/90 focus:bg-green-700/90 active:bg-green-800 focus:outline-none 
        transition ease-in-out duration-150 disabled:opacity-50 disabled:hover:bg-green-700
}
</style>
