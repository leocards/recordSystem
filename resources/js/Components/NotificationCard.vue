<script setup>
import { watchEffect } from 'vue';
import Check from './Icon/Check.vue';
import Xmark from './Icon/Xmark.vue';
import { useLayoutStore } from '@/Store/LayoutStore';

const storeLayout = useLayoutStore()

const props = defineProps({
    notif: Object,
    index: Number
})

const timeout = props.notif.timeClose * 1000

watchEffect(() => {
    if(props.notif.show) {
        setTimeout(() => {
            storeLayout.notifications[props.index].show = false

            setTimeout(() => {
                storeLayout.notifications.splice(props.index, 1)
            }, 10)

        }, timeout)
    }
})



</script>

<template>
    <Transition 
        enter-active-class="ease-out duration-300"
        enter-from-class="opacity-0 -translate-x-0"
        enter-to-class="opacity-100 -translate-x-6"
    >
        <div class="rounded-lg shadow-lg shadow-black/5 mb-1 -translate-x-6" v-if="notif.show">
            <div class="toast-notification rounded-lg flex flex-col">
                <div class="grow flex">
                    <div class="w-14 flex items-center justify-center shrink-0">
                        <Check :class="'text-green-500'" />
                    </div>

                    <div class="p-2 flex flex-col justify-center grow">
                    </div>

                    <div class="w-10 flex justify-center items-center ml-auto mr-1">
                        <button class="w-8 h-8 rounded-full flex justify-center items-center hover:bg-gray-100">
                            <Xmark :size="17" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.toast-notification {
    @apply xxs:max-w-[18rem] xxs:min-w-[16.5rem] xxs:min-h-[3.5rem] text-sm bg-white shadow-[inset_0_1px_0_0_hsl(0deg_0%_100%_/_5%)] ring-slate-700/10 ring-1 overflow-hidden
        
}

</style>