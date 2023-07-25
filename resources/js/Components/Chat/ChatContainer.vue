<script setup>
import Xmark from '../Icon/Xmark.vue';
import ChatProfile from './ChatProfile.vue';
import PanelRight from '@/Components/Icon/PanelRight.vue'
import Minimize from '@/Components/Icon/Minimize.vue'

const props = defineProps({
    open: Boolean,
})

</script>

<template>
    <Teleport to="body">
        <Transition>
            
            <div 
                class="fixed bottom-2 rounded-xl bg-white w-[21rem] h-[28rem] z-500 shadow-lg myshadow"
                :class="[open?'right-[4.8rem]':'right-5']"
                v-if="open"
            >

                <div class="h-14 flex items-center px-2">
                    <ChatProfile
                        size="xl"
                    />

                    <div class="Oneline text-sm ml-2 mr-3">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab officia quas saepe enim laudantium nesciunt iste quia. Et deserunt explicabo quod, saepe exercitationem aliquid eaque incidunt rerum, assumenda maiores quibusdam!
                    </div>


                    <div class="ml-auto flex items-center">
                        <button class="hover:btn-bg transition-150 p-1.5 rounded-full mr-1">
                            <Minimize />
                        </button>
                        <button class="hover:btn-bg transition-150 p-1.5 rounded-full">
                            <Xmark size="20" />
                        </button>
                    </div>
                </div>
                
            </div>

        </Transition>
    </Teleport>
</template>

<style scoped>
.myshadow {
    box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}

</style>