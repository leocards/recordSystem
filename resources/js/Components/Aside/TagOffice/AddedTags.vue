<script setup>
import Xmark from '@/Components/Icon/Xmark.vue';

const props = defineProps({
    item: Object,
    index: Number
})

const emits = defineEmits([
    'handleRemoveOffice'
])

</script>

<template>
    <div class="p-1.5 px-2 pl-2.5 flex items-center text-sm bg-gray-100 rounded-full m-1" :key="index">
        <div class="Oneline max-w-[10rem]">
            {{ item.name }}
        </div>
        <button 
            class="flex items-center justify-center rounded-full transition-150 hover:bg-gray-300 p-1 ml-1.5"
            @click="$emit('handleRemoveOffice')"
        >
            <Xmark :size="17" />
        </button>
    </div>
</template>