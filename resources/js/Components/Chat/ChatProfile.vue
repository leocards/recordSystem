<script setup>
import Xmark from "@/Components/Icon/Xmark.vue";
import { computed } from "vue";
import { ref } from "vue";

const props = defineProps({
    profile: {
        type: Object,
        default: null
    },
    hasXmark: Boolean,
    active: Boolean,
    size: {
        type: String,
        default: '3xl'
    }
});
const emits = defineEmits(["remove"]);

const profileSize = computed(() => {
    return {
        sxxs: 'w-3 h-3',
        xxs: 'w-4 h-4',
        xs: 'w-5 h-5',
        sm: 'w-6 h-6',
        base: 'w-7 h-7',
        md: 'w-8 h-8',
        lg: 'w-9 h-9',
        xl: 'w-10 h-10',
        '2xl': 'w-11 h-11',
        '3xl': 'w-12 h-12',
        '4xl': 'w-14 h-14',
        '5xl': 'w-16 h-16',
    }[props.size]
})

</script>

<template>
    <div
        ref="profile"
        class="rounded-full ring ring-transparent relative transition duration-150 group bg-gray-100 cursor-pointer shrink-0"
        :class="profileSize, [active?'ring-green-600/70 hover:ring-green-700':'hover:ring-slate-700/10']"
    >



        <button
            v-if="hasXmark"
            class="p-1 bg-gray-300 absolute -top-2 -right-1 rounded-full opacity-50 group-hover:block hidden hover:opacity-100 transition duration-150"
            @click="$emit('remove')"
        >
            <Xmark :size="15" />
        </button>
    </div>
</template>
