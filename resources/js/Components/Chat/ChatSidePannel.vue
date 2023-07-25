<script setup>
import MessageFill from '@/Components/Icon/MessageFill.vue'
import ChatProfile from '@/Components/Chat/ChatProfile.vue'
import Xmark from '@/Components/Icon/Xmark.vue'
import CircleButton from '@/Components/Buttons/CircleButton.vue'
import { onMounted, ref } from 'vue'
import { nextTick } from 'vue'
import { useLayoutStore } from '@/Store/LayoutStore'

const storeLayout = useLayoutStore()

const emits = defineEmits([
    'handleClose'
])

const isShow = ref(false)
const showClose = ref(false)
const lastElement = ref(null)
const array = ref([])

const dataContruct = () => {
    array.value.push([..._.takeRight(storeLayout.sampleData, [4])])
}

const addToList = () => {
    array.value.push({id: array.value.length+1, name: 'Leo', age: 22})
}

/* const limits = ref([..._.takeRight(array.value, [4])])

const getNewArray = () => {
    array.value = array.value.filter(({id}) => !limits.value.some(user => user.id === id))
}
getNewArray()
lastElement.value = array.value[array.value.length - 1]
array.value.pop() */




const remove = (item, i) => {
    array.value.splice(i, 1)

    /* if(array.value.length > 0){
        limits.value.push(array.value[array.value.length - 1])
        array.value.pop()
        lastElement.value = array.value[array.value.length - 1]
        array.value.pop()
    } */

    if(array.value.length == 0)
        emits('handleClose')
}

onMounted(() => {
    nextTick(() => {
        setTimeout(() => {
            isShow.value = true
        }, 200);
    })
})

</script>

<template>
    <Teleport to="body">
        <div 
            class="fixed top-0 right-0 w-16 h-screen pb-2 pt-0 flex flex-col justify-end overflow-hidden"
            @mouseover="showClose = true"
            @mouseleave="showClose = false"
            @dblclick="addToList"
        >
            <Transition
                enter-active-class="ease-out duration-200"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
            >
                
                <div class="" v-if="isShow">
                    <Transition
                        enter-active-class="ease-out duration-150"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="ease-in duration-100"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div 
                            class="h-12 w-full flex items-center justify-center z-10"
                            v-show="showClose"
                        >
                            <CircleButton 
                                tooltip_label="Close"
                                @click="$emit('handleClose')"
                                tooltip_position="z-50 -bottom-6"
                            >
                                <Xmark :size="22" />
                            </CircleButton>
                        </div>
                    </Transition>

                    <div class=" pb-1" :class="{'max-h-[19rem] overflow-hidden':array.length>4}">
                        <TransitionGroup
                            name="list"
                            tag="div" 
                            class="relative flex-col-reverse flex items-center"
                        >
                            <ChatProfile 
                                v-for="(item, index) in array" :key="item"
                                @remove="remove(item, index)"
                                has-xmark
                                :profile="item"
                                :class="'mt-3'"
                            />
                        </TransitionGroup>
                    </div>

                    <div class="mt-6 mb-3 opacity -30 flex flex-col items-center text-green-600 relative">

                        <span class="absolute -top-3.5 right-2 bg-red-600 text-xs rounded-full py-0.5 px-1.5 text-white"
                            v-if="array.length > 5"
                        >+ {{ (array.length-5) }}</span>

                        <MessageFill size="lg" />
                    </div>
                </div>
        
            </Transition>
        </div>

    </Teleport>
</template>

<style scoped>
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
  transition: all 0.25s ease;
}

.list-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.list-leave-to {
  opacity: 0;
  transform: translateX(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {

}
</style>