<script setup>
import SideModal from '../Aside/SideModals/SideModal.vue';
import Message from '../Icon/Message.vue';
import SearchInput from '../SearchInput.vue';

const props = defineProps({
    showMessages: Boolean
})
const emits = defineEmits(["handleClose", "handleOutside"]);

const clicksOutside = () => {
    emits('handleOutside')
}
</script>

<template>
    <SideModal
        :show-side-modal="showMessages"
        @handleClose="$emit('handleClose')"
        @handleOutside="clicksOutside"
    >
        <template #header>
            <div class="flex items-center font-medium">
                <Message :stroke="2" />
                <span class="ml-2">Chats</span>
                <span class="text-xs min-w-[1.25rem] text-center px-2 py-0.5 ml-2 text-white rounded-full bg-green-600">0</span>
            </div>
        </template>

        <template #subHeader>
            <div class="grow">
                <SearchInput
                    searchLabels="user"
                />
            </div>
        </template>

        <!-- <div 
            class="bg-gray-100/80 h-16 rounded-xl mb-1.5 hover:bg-gray-200/70" 
            v-for="(item, index) in 5" :key="index"
            @click=""
        >

        </div> -->

        <div class="">
            <div class="mb-2 font-medium text-sm">Now</div>

            <div class="rounded-2xl bg-gray-100/70 overflow-hidden shadow-sm">
                
                <div class="h-16 hover:bg-gray-200/80 rounded-lg transition-200" v-for="(item, index) in 3" :key="index"></div>

            </div>
        </div>

        <div class="mt-5">
            <div class="mb-2 font-medium text-sm">old</div>

            <div class="rounded-2xl bg-gray-100/70 overflow-hidden shadow-sm">
                
                <div class="h-16 hover:bg-gray-200/80 rounded-lg transition-200" v-for="(item, index) in 3" :key="index"></div>

            </div>
        </div>

    </SideModal>
</template>