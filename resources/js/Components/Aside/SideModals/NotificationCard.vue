<script setup>

const props = defineProps({
    border_b: {
        type: Boolean,
        default: true
    }
})

</script>

<template>
    <div class="max-h-[7rem] min-h-[4rem] grid transition-200 px-2.5 hover:bg-gray-200/70 rounded-lg">
        <div 
            class="grow"
        >

        </div>
    </div>
</template>

<style scoped>

</style>