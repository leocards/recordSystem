<script setup>
import Xmark from "@/Components/Icon/Xmark.vue";
import CircleButton from "@/Components/Buttons/CircleButton.vue";

const props = defineProps({
    showSideModal: Boolean,
});
const emits = defineEmits(["handleClose", "handleOutside"]);

const clicksOutside = () => {
    emits('handleOutside')
}
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="ease-out duration-300"
            enter-from-class="translate-x-3/4 opacity-0"
            enter-to-class="translate-x-0 opacity-100"
            leave-active-class="ease-in duration-200"
            leave-from-class="translate-x-0 opacity-100"
            leave-to-class="translate-x-3/4 opacity-0"
        >
            <div
                class="notif_mess fixed grid grid-cols-1 grid-rows-[3.5rem,2.5rem,1fr] top-0 right-0 w-[23rem] h-screen bg-white shadow-xl shrink-0 overflow-hidden px-2 pb-2 gap-1 z-[500]"
                v-show="showSideModal"
                v-click-outside="clicksOutside"
            >
                <div class="text-lg flex items-center justify-between p-2.5">
                    <slot name="header" />

                    <CircleButton
                        tooltip_label="Close"
                        @click="$emit('handleClose')"
                        :class="'notifCloseBtn'"
                    >
                        <Xmark />
                    </CircleButton>
                </div>

                <div class="flex px-1.5">
                    <slot name="subHeader" />
                </div>

                <div
                    class="flex flex-col h-full overflow-y-auto p-2 py-0 pt-3"
                >
                    <slot />
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
