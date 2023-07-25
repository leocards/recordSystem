<script setup>
import Hamburger from '../Icon/Hamburger.vue';  

const props = defineProps({
    menu: Boolean
})

const emits = defineEmits([
    'buttonClick'
])

</script>

<template>
    <div class="-mr-2 flex items-center sm:hidden">
        <button
            @click="$emit('buttonClick')"
            class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
        >
            <Hamburger />
        </button>
    </div>
</template>