<script setup>
import OfficeSmall from '@/Components/Icon/OfficeSmall.vue';
import Right from '@/Components/Icon/Right.vue';
import { ref, watchEffect } from 'vue';
import Remove from '@/Components/Icon/Remove.vue';
import Edit from '@/Components/Icon/Edit.vue';
import axios from 'axios';
import DeleteWarning from '@/Components/Aside/DeleteWarning.vue';

const props = defineProps({
    index: Number,
    item: Object,
    lastItem: Boolean
})
const emits = defineEmits([
    'removeOffice'
])

const isShowMore = ref(false)
const showDelete = ref(false)

const setDelete = () => {
    axios.post(route('or_deleteTag'), {
        id: props.item.id
    }).then(res => {
        isShowMore.value = false
        emits('removeOffice', props.index)
        showDelete.value = false
    })
}

</script>

<template>
    <div class="hover:bg-gray-200/80 pointer-events-auto transition-200 rounded-lg min-h-[3rem] px-4 pt-3 cursor-default overflow-hidden flex flex-col" :key="index" data-aside>
        <div class="flex items-center pointer-events-none">
            <OfficeSmall />
            <div class="Oneline ml-2 pointer-events-none">
                {{ item.name }}
            </div>
            <button 
                data-button 
                @click="isShowMore = !isShowMore" 
                :class="[isShowMore?'-rotate-90':'rotate-90']"
                class="rounded-full hover:bg-gray-300 ml-auto w-7 h-7 transition-150 flex items-center justify-center pointer-events-auto">
                <Right :size="13" />
            </button>
        </div>
        <Transition
            enter-active-class="duration-150 ease-in"
            enter-from-class="opacity-0 h-0"
            enter-to-class="opacity-100 h-16"
            leave-active-class="duration-150 ease-in"
            leave-from-class="opacity-100 h-16"
            leave-to-class="opacity-0 h-0"
        >
            <div v-if="isShowMore" class="flex flex-col pointer-events-none mt-4">
                <div>
                    Due: <span class="text-xs">August 23, 2023 10 days left</span>
                </div>

                <div class="flex text-xs mt-4 ml-auto gap-0.5">
                    <button data-button class="rounded-full h-8 w-8 flex items-center justify-center transition-150 hover:bg-gray-300 pointer-events-auto">
                        <Edit size="xs" />
                    </button>
                    <button 
                        data-button 
                        @click="showDelete = true"
                        class="rounded-full h-8 w-8 flex items-center justify-center transition-150 hover:bg-red-300/60 pointer-events-auto hover:text-red-600"
                    >
                        <Remove size="xs" />
                    </button>
                </div>
            </div>
        </Transition>

        <div class="mt-3 border-gray-300" :class="{'border-b':lastItem}" ></div>
    </div>

    <DeleteWarning
        :name="item.name"
        :show="showDelete"
        @handleRemove="setDelete"
        @handleCancel="showDelete = false"
    />
</template>