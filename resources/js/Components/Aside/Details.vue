<script setup>
import { ref } from "vue";
import AsideContents from "./AsideContents.vue";
import Empty from "./Empty.vue";
import InfoFill from "@/Components/Icon/InfoFill.vue"
import ActivityFill from '@/Components/Icon/ActivityFill.vue'

const isDetail = ref(true);
</script>

<template>
    <AsideContents>
        <template #subheader>
            <button
                data-button
                class="text-sm h-11 w-full pointer-events-auto transition duration-150 rounded-full"
                :class="[isDetail?'bg-green-600/10 text-green-800 font-medium':'hover:bg-gray-100/70']"
                @click="isDetail = true"
            >
                Details
            </button>
            <button
                data-button
                class="text-sm h-11 w-full pointer-events-auto transition duration-150 rounded-full"
                :class="[!isDetail?'bg-green-600/10 text-green-800 font-medium':'hover:bg-gray-100/70']"
                @click="isDetail = false"
            >
                Activity
            </button>
        </template>

        <div class="pointer-events-none rounded-2xl bg-gray-100 flex grow" v-if="false">
            <div 
                class="h-16"
                v-for="(item, index) in 7" :key="index"
                v-if="!isDetail"
            >
            </div>

            <div
                class="ring-1 ring-inset"
                v-if="isDetail"
            >
                d
            </div>
        </div>

        <Empty
            label="Select item"
        >
            <InfoFill size="max" v-if="isDetail" />
            <ActivityFill size="max" v-if="!isDetail" />
        </Empty>
    </AsideContents>
</template>
