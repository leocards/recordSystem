<script setup>
import RightCrumbs from "@/Components/Icon/RightCrumbs.vue";
import BackButton from "@/Components/Buttons/BackButton.vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import { useLayoutStore } from "@/Store/LayoutStore";

const page = usePage().props;
const storeLayout = useLayoutStore()
const props = defineProps({
    showBack: Boolean
})
const emits = defineEmits([
    'handleBack'
])

</script>

<template>
    <div class="flex items-center">
        <BackButton class="mr-2" v-if="showBack"  @click="$emit('handleBack')" />
        
        <slot />

        <ul
            class="ml-2 text-base font-normal flex items-center"
            v-if="page.crumbs"
        >
            <li
                class="flex items-center max-w-[10rem] min-w-[4rem] cursor-pointer select-none group"
                v-for="(item, index) in page.crumbs"
                :key="index"
                @click="storeLayout.getRouteTo(route('records.open', [item.id]))"
            >
                <div class="p-1 group-hover:bg-gray-200 transition duration-200 rounded-md">
                    <div class="Oneline">{{ item.name }}</div>
                </div>
                <div class="shrink-0 pointer-events-none">
                    <RightCrumbs size="xs" :stroke="3" :class="'mx-1.5'" />
                </div>
            </li>
        </ul>

        <div
            class="Oneline max-w-[13rem] text-base font-normal ml-1"
            v-if="page.current"
        >
            {{ page.current.name }}
        </div>
    </div>
</template>
