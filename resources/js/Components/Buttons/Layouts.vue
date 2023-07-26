<script setup>
import CircleButton from '@/Components/Buttons/CircleButton.vue'
import Bars from "@/Components/Icon/Bars.vue";
import Left from "@/Components/Icon/Left.vue";
import GridViewIcon from "@/Components/Icon/GridViews.vue";
import List from "@/Components/Icon/List.vue";
import { ref } from "vue";

const props = defineProps({
    mainSize: Number
})

const showViewTypes = ref(false);
const layout = ref(1)

const clickOutside = () => {
    showViewTypes.value = false
}

</script>

<template>
    <div class="inline-flex ml-auto relative select-none" data-button v-click-outside="clickOutside">
        <Transition name="viewtypes">
            <div class="mr-2.5 flex gap-1" v-if="showViewTypes && mainSize > 740">
                <CircleButton tooltip_label="Grid layout" @click="layout = 1" :active="layout == 1">
                    <GridViewIcon />
                </CircleButton>
                <CircleButton tooltip_label="Bars layout" @click="layout = 2" :active="layout == 2">
                    <Bars />
                </CircleButton>
                <CircleButton tooltip_label="List layout" @click="layout = 3" :active="layout == 3">
                    <List />
                </CircleButton>
            </div>
        </Transition>
        <button
            :class="[showViewTypes?'bg-green-700/10 text-green-700':' hover:bg-gray-100']"
            class="text-sm transition duration-200 px-3 pr-3.5 rounded-full h-10 flex items-center gap-2 layout-button relative"
            @click="showViewTypes = !showViewTypes"
            data-button
        >
            <span
                class="h-4 w-4 rounded-full flex items-center justify-center transition duration-200 pointer-events-none"
                :class="{'-rotate-90':!showViewTypes}"
            >
                <Left :size="12" />
            </span>
            <GridViewIcon v-if="layout == 1" class="w-[17px] h-[17px]" />
            <Bars v-if="layout == 2" />
            <List v-if="layout == 3" />

            <span class="layout-label">
                {{ (layout == 1? 'Grid layout':layout==2?'Bars layout':layout==3?'List layout':'') }}
            </span>
        </button>

        <Transition
            name="layout_more"
        >
            <div 
                data-button
                class="w-52 h-fit py-2 bg-white shadow-md rounded-md text-sm text-gray-500 absolute z-30 right-[4.3rem] overflow-hidden"
                v-if="showViewTypes && mainSize <= 740"
            >
                <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                    <span class="mr-2 flex w-7 items-center justify-center pointer-events-none"><GridViewIcon /></span> Grid layout
                </div>
                <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                    <span class="mr-2.5 flex w-7 items-center justify-center pointer-events-none"><Bars /></span> Bars layout
                </div>
                <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                    <span class="mr-2.5 flex w-7 items-center justify-center pointer-events-none"><List /></span> List layout
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.layout-label {
    @apply absolute opacity-0 pointer-events-none bg-gray-700 text-white text-xs px-2 py-1 rounded whitespace-nowrap top-10 left-[50%] -translate-x-[50%]
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.layout-button:hover .layout-label {
    animation-name: fadeIn;
    animation-delay: 1.5s;
    animation-duration: .2s;
    animation-fill-mode: forwards;
    opacity: 0;
}

.layout_more-enter-active {
    @apply ease-out duration-150
}
.layout_more-enter-from {
    @apply h-0 opacity-0
}
.layout_more-enter-to {
    @apply h-[7.75rem] opacity-100
}

.layout_more-leave-active {
    @apply ease-in duration-150
}
.layout_more-leave-from {
    @apply h-[7.75rem] opacity-100
}
.layout_more-leave-to {
    @apply h-0 opacity-0
}
</style>