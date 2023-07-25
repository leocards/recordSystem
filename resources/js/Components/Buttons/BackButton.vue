<script setup>
import Back from '@/Components/Icon/Back.vue';
import CircleButton from '@/Components/Buttons/CircleButton.vue';

</script>

<template>
    <CircleButton
        tooltip_label="Back"
        bg-hover-darker
    >
        <Back :stroke="2"/>
    </CircleButton>
</template>

<style scoped>

/*     button {
        @apply w-10 h-10 rounded-full sm:hover:bg-gray-200 hover:bg-gray-100 flex items-center justify-center transition duration-200
    } */

</style>