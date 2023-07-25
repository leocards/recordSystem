<script setup>
import SideModal from "./SideModal.vue";
import Notification from "@/Components/Icon/Notification.vue";
import { ref } from "vue";
import NotificationCard from "./NotificationCard.vue";

const props = defineProps({
    showNotification: Boolean,
});
const emits = defineEmits(["handleClose", "handleOutside"]);

const isAllNotif = ref(true);
const newlist = ref(["h-full", "h-[5rem]", "h- [5.5rem]"]);
const list = ref([
    "h-full",
    "h-[5rem]",
    "h- [5.5rem]",
]);

const clicksOutside = () => {
    emits('handleOutside')
}
</script>

<template>
    <SideModal 
        :showSideModal="showNotification"
        @handleOutside="clicksOutside"
        @handleClose="$emit('handleClose')"
    >
        <template #header>
            <div class="flex items-center font-medium">
                <Notification :stroke="2"/>
                <span class="ml-2">Notifications</span>
                <span class="text-xs min-w-[1.25rem] text-center px-2 py-0.5 ml-2 text-white rounded-full bg-red-600">0</span>
            </div>
        </template>

        <template #subHeader>
            <button
                class="w-full rounded-full transition duration-150 relative"
                :class="[
                    isAllNotif
                        ? 'text-green-700 font-medium'
                        : 'hover:bg-gray-100',
                ]"
                @click="isAllNotif = true"
            >
                <span>All</span>
                <div
                    v-if="isAllNotif"
                    class="h-1 rounded-full absolute bottom-0 bg-green-600 w-24 left-1/2 -translate-x-1/2"
                ></div>
            </button>
            <button
                class="w-full rounded-full transition duration-150 relative"
                :class="[
                    !isAllNotif
                        ? 'text-green-700 font-medium'
                        : 'hover:bg-gray-100',
                ]"
                @click="isAllNotif = false"
            >
                <span>Unread</span>
                <div
                    v-if="!isAllNotif"
                    class="h-1 rounded-full absolute bottom-0 bg-green-600 w-24 left-1/2 -translate-x-1/2"
                ></div>
            </button>
        </template>

        <div>
            <div class="mb-2 font-medium text-sm">Today</div>

            <div class="rounded-2xl bg-gray-100/70 overflow-hidden shadow-sm">
                <NotificationCard
                    :border_b="index !== newlist.length-1"
                    v-for="(item, index) in newlist"
                    :key="index"
                />
            </div>
            <!-- :class="[
                    newlist.length - 1 === index ? 'mb-0' : 'mb-2',
                ]" -->
        </div>

        <div class="mt-5">
            <div class="mb-2 font-medium text-sm">Yesterday</div>

            <div class="rounded-2xl bg-gray-100/70 overflow-hidden shadow-sm">
                <NotificationCard
                    :class="[
                        index === list.length - 1 ? 'mb-0' : 'mb-2',
                    ]"
                    v-for="(item, index) in list"
                    :key="index"
                />
            </div>
        </div>

        <div class="mt-5">
            <div class="mb-2 font-medium text-sm">Old</div>

            <div class="rounded-2xl bg-gray-100/70 overflow-hidden shadow-sm">
                <NotificationCard
                    :class="[
                        index === list.length - 1 ? 'mb-0' : 'mb-2',
                    ]"
                    v-for="(item, index) in list"
                    :key="index"
                />
            </div>
        </div>

    </SideModal>
</template>
