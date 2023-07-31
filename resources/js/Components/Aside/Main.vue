<script setup>
import { useLayoutStore } from '@/Store/LayoutStore'
import Xmark from '@/Components/Icon/Xmark.vue';
import CircleButton from '@/Components/Buttons/CircleButton.vue';
import Modal from '@/Components/Modal.vue';

const storeLayout = useLayoutStore()

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

</script>

<template>
    <Transition
        enter-active-class="aside-in"
        enter-from-class="aside-from"
        enter-to-class="aside-to"
        leave-active-class="aside-leave"
        leave-from-class="asideLeave-from"
        leave-to-class="asideLeave-to"
    >
        <div class="shrink-0 max-w-[20.75rem] w-full h-[calc(100vh-8.25rem)] pl-3 lg:flex hidden overflow-hidden" v-if="show && storeLayout.windowSize >= 1024">
            <div class="bg-white shrink-0 w-[20rem] grow flex flex-col rounded-2xl overflow-hidden relative" data-aside>
                <!-- Head -->
                <div class="p-2 px-2.5 flex items-center h-14 pointer-events-none">
                    <div 
                        class="pointer-events-none Oneline font-medium" 
                        v-text="storeLayout.selectedItem.item?storeLayout.selectedItem.item.name:'Header Content'"
                    ></div>
                    <CircleButton tooltip_label="Close" class="ml-auto pointer-events-auto shrink-0 z-20" @click="storeLayout.closeAside">
                        <Xmark />
                    </CircleButton>
                </div>

                <slot />

            </div>
        </div>
    </Transition>

    <Modal
        maxWidth="lg"
        :show="show && storeLayout.windowSize < 1024"
    >
        <div class="">
            <div class="bg-white shrink-0 w-full h-[calc(100vh-3rem)] grow flex flex-col rounded-lg overflow-hidden" data-aside>
                <!-- Head -->
                <div class="p-2 px-2.5 flex items-center h-14 pointer-events-none">
                    <div 
                        class="pointer-events-none Oneline"
                        v-text="storeLayout.aside.header?storeLayout.aside.header:'Header Content'"
                    >
                    </div>
                    <CircleButton tooltip_label="Close" class="ml-auto pointer-events-auto shrink-0" @click="storeLayout.closeAside">
                        <Xmark />
                    </CircleButton>
                </div>

                <slot />

            </div>
        </div>
    </Modal>
    
</template>

<style scoped>
.aside-in {
    @apply ease-out duration-200
}
.aside-from {
    @apply w-[0rem]
}
.aside-to {
    @apply w-[20.75rem]
}
.asideLeave-from {
    @apply w-[20.75rem]
}
.asideLeave-to {
    @apply w-[0rem]
}
.aside-leave {
    @apply ease-in duration-200
}

</style>