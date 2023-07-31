<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import OfficeSmall from '@/Components/Icon/OfficeSmall.vue';

const props = defineProps({
    item: Object,
    index: Number,
    lastElement: Boolean
})

const emits = defineEmits([
    'handleGetOffice'
])

</script>

<template>
    <div
        class="h-12 text-sm px-4 flex flex-col hover:bg-gray-200 transition-150 select-none"
    >
        <div class="flex grow items-center">
            <div class="text-slate-600">
                <OfficeSmall /> 
            </div>
            <div class="Oneline grow ml-2"> {{ item.name }} </div>
            <PrimaryButton 
                padding="py-1.5 px-3"
                @click="$emit('handleGetOffice')"
                v-if="!item.added"
            >
                Add
            </PrimaryButton>
            <button class="capsule-fit ml-auto bg-slate -200 transition-150 text-xs font-medium px-2 py-1.5
            disabled:opacity-40 disabled:pointer-events-none select-none" :disabled="item.added" v-else>
                Added
            </button>
        </div>
        <div 
            class="border-b border-slate-200 w-full mt-auto" 
            v-if="lastElement"
        ></div>
    </div>
</template>