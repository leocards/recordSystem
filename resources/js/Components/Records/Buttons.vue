<script setup>
import Edit from "@/Components/Icon/Edit.vue";
import Info from "@/Components/Icon/Info.vue";
import Trash from "@/Components/Icon/Trash.vue";
import Personel from "@/Components/Icon/Personel.vue";
import Office from "@/Components/Icon/Office.vue";
import CircleButton from '@/Components/Buttons/CircleButton.vue';
import MoreV from "../Icon/MoreV.vue";
import { useLayoutStore } from "@/Store/LayoutStore";
import { ref } from "vue";

const storeLayout = useLayoutStore()

const props = defineProps({
    selects: String,
    mainSize: Number,
    exlcudes: {
        type: Array,
        default: []
    }
})
const emits = defineEmits([
    'handleEdit',
    'handleDetails',
    'handlePersonel',
    'handleTaggedOffice',
    'handleDelete'
])

const show = ref(false)

const clickOutside = () => {
    show.value = false
}


</script>

<template>
    <div class="flex mr-2 ml-2" data-content>
        <CircleButton 
            :disabled="!selects" 
            v-if="!exlcudes.includes(1) && mainSize >= 530" 
            tooltip_label="Details" 
            :active="storeLayout.aside.header == 'Details'" 
            @click="$emit('handleDetails')"
        >
            <Info />
        </CircleButton>
        <CircleButton 
            :disabled="!selects" 
            v-if="!exlcudes.includes(2) && mainSize >= 530" 
            tooltip_label="Edit" 
            @click="$emit('handleEdit')"
        >
            <Edit />
        </CircleButton>
        <CircleButton 
            :disabled="!selects" 
            v-if="!exlcudes.includes(3) && mainSize >= 530" 
            tooltip_label="Personnel" 
            :active="storeLayout.aside.header == 'Personnel'" 
            @click="emits('handlePersonel')"
        >
            <Personel />
        </CircleButton>
        <CircleButton 
            :disabled="!selects"
            v-if="!exlcudes.includes(4) && mainSize >= 530" 
            tooltip_label="Tag office" 
            :active="storeLayout.aside.header == 'Tagged Office'" 
            :tooltip_position="selects?'-bottom-6':'-left-6 -bottom-6'"
            @click="emits('handleTaggedOffice')"
        >
            <Office />
        </CircleButton>
        <CircleButton 
            v-if="(selects && (!$page.props.current || $page.props.current.id != selects)) && mainSize >= 530 && !exlcudes.includes(5)" 
            tooltip_label="Remove"
            @click="$emit('handleDelete')"
        >
            <Trash />
        </CircleButton>

        <div v-if="mainSize <= 529" class="flex relative" v-click-outside="clickOutside" data-content>
            <CircleButton tooltip_label="More" @click="show = !show" :active="show">
                <MoreV />
            </CircleButton>

            <Transition
                name="more"
            >
                <div
                    class="w-52 h-fit py-2 bg-white shadow-md rounded-md text-sm text-gray-500 absolute z-30 right-10 overflow-hidden" 
                    data-button v-if="show"
                >
                    <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                        <span class="mr-2 flex w-7 items-center justify-center pointer-events-none"><Info /></span> Details
                    </div>
                    <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                        <span class="mr-2.5 flex w-7 items-center justify-center pointer-events-none"><Edit /></span> Edit
                    </div>
                    <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                        <span class="mr-2.5 flex w-7 items-center justify-center pointer-events-none"><Personel /></span> Personel
                    </div>
                    <div class="pl-2 flex items-center hover:text-gray-700 cursor-pointer h-9 hover:bg-gray-100" data-button>
                        <span class="mr-2.5 flex w-7 items-center justify-center pointer-events-none"><Office /></span> Tag office
                    </div>
                </div>
            </Transition>
        </div>
    </div>
</template>

<style scoped>
.more-enter-active {
    @apply ease-out duration-150
}
.more-enter-from {
    @apply h-0 opacity-0
}
.more-enter-to {
    @apply h-40 opacity-100
}

.more-leave-active {
    @apply ease-in duration-150
}
.more-leave-from {
    @apply h-40 opacity-100
}
.more-leave-to {
    @apply h-0 opacity-0
}

</style>