<script setup>
import { ref } from 'vue';
import MoreV from '../Icon/MoreV.vue';

const props = defineProps({
    winSize: Number,
    isShowPinned: Boolean
})
const array = ref([1,2,3,4,5,6,7,8,9,0])

const remove = i => {
    array.value.splice(i, 1)
}
</script>

<template>
    <div class="flex flex-col mt-4 grow overflow-y-auto overflow-x-hidden" v-if="winSize > 1023">
        <TransitionGroup name="list" tag="div" class="relative">
            <div class="border border-gray-300 rounded-lg h-12 shrink-0  w-full flex items-center p-1 hover:bg-gray-100"
            :class="[index===0?'mt-0':'mt-1.5']"
            v-if="isShowPinned" data-record v-for="(item, index) in array" :key="item">
                <span class="pointer-events-none"></span>
                <div class="Oneline relative pointer-events-none pl-1">lorem </div>
                <button class="hover:bg-gray-300/80 trnasition duration-150 rounded-full h-6 w-6 shrink-0 flex items-center justify-center ml-auto text-gray-800 pointer-events-auto" 
                @click="remove(index)" data-button><MoreV :size="16" /></button>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
::-webkit-scrollbar {
    @apply bg-transparent w-[7px] !important
}
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
  position: absolute;
}
</style>