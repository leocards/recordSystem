<script setup>
import Modal from '@/Components/Modal.vue';
import SearchInput from '@/Components/Inputs/SearchInput.vue';
import CircleButton from '@/Components/Buttons/CircleButton.vue';
import Xmark from '@/Components/Icon/Xmark.vue';
import { ref } from 'vue';
import Filter from '../Icon/Filter.vue';
import { computed } from 'vue';
import LoadingAnimation from '../LoadingAnimation.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    mainSize: Number
})
const emits = defineEmits([
    'handleClose'
])

const searches = ref(null)
const searchFilters = ref(1)
const isShowFilters = ref(false)

const data = ref([1,2,3])

const searchLabels = computed(() => {
    return {
        1: '',
        2: 'records',
        3: 'documents',
    }[searchFilters.value]
})

const getSearchValues = search => {
    searches.value = search
}
const closeFilterDropDown = () => isShowFilters.value = false

</script>

<template>
    <Modal 
        :show="show"
        maxWidth="3xl"
    >
        <div class="p-4 pr-2 h-[calc(100vh-3rem)] overflow-y-hidden flex flex-col">
            <div class="flex pr-2">
                <div class="relative w-fit" v-click-outside="closeFilterDropDown">
                    <button 
                        class="flex items-center text-sm mr-3 rounded-full w-32 px-2 h-full transition duration-200 hover:shadow-insetShadow"
                        :class="[isShowFilters?'bg-green-700 text-white':'hover:bg-gray-100 ']"
                        @click="isShowFilters = !isShowFilters"
                    >
                        <Filter />

                        <div class="ml-2 capitalize">{{ searchLabels?searchLabels:'All' }}</div>
                    </button>

                    <Transition
                        enter-active-class="duration-100 ease-out"
                        enter-from-class="opacity-0 h-0"
                        enter-to-class="opacity-100 h-36"
                        leave-active-class="ease-in duration-200"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div 
                            class="text-sm absolute left-0 top-10 w-40 rounded-xl overflow-hidden shadow-lg bg-white p-1.5"
                            v-if="isShowFilters"
                        >
                            <div class="[10px] text-slate-400/80 w-fit">Search filter</div>
                            <div class="mt-3"> 
                                <div class="w-full text-left p-1.5 rounded-lg hover:bg-gray-100 cursor-pointer" @click="searchFilters = 1, isShowFilters = false">All</div>
                                <div class="w-full text-left p-1.5 rounded-lg hover:bg-gray-100 cursor-pointer" @click="searchFilters = 2, isShowFilters = false">Records</div>
                                <div class="w-full text-left p-1.5 rounded-lg hover:bg-gray-100 cursor-pointer" @click="searchFilters = 3, isShowFilters = false">Documents</div>
                            </div>
                        </div>
                    </Transition>
                </div>
                
                <SearchInput
                    :mainSize="mainSize"
                    @handleSearch="getSearchValues"
                    :searchLabels="searchLabels"
                />

                <CircleButton
                    tooltip_label="Close"
                    :class="' ml-2'"
                    @click="$emit('handleClose'), closeFilterDropDown()"
                >
                    <Xmark />
                </CircleButton>
            </div>

            <div class="overflow-y-auto text-sm mt-3 pr-2 grow flex flex-col">

                <div class="mb-2">
                    <div class="mb-3">Recent uploads</div>
                    <div class="grid grid-cols-4 gap-2 p-3 px-0">
                        <div class="col-span-1 h-32 border rounded-lg shrink-0"></div>
                        <div class="col-span-1 h-32 border rounded-lg shrink-0"></div>
                        <div class="col-span-1 h-32 border rounded-lg shrink-0"></div>
                        <div class="col-span-1 h-32 border rounded-lg shrink-0"></div>
                    </div>
                </div>

                <div>Results</div>

                <div class="grow mt-2">
                    
                    <div 
                        class="h-12 border border-slate-700/20 hover:bg-gray-50"
                        :class="[
                            data.length === 1 ? 'rounded-xl' : 
                                index === 0 ? 'rounded-t-xl border-b-0' : 
                                    index === data.length-1 ? 'rounded-b-xl border-t' 
                                    : 'border-t border-x border-b-0' 
                        ]"
                        v-for="(item, index) in data" :key="index"
                    ></div>

                </div>

                <LoadingAnimation />
                
            </div>

        </div>
    </Modal>
</template>

<style scoped>
.searchCard {
    @apply rounded-lg h-12 p-1.5 mt-1.5 ring-1 ring-inset
}
</style>