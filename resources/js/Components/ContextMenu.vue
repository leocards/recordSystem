<script setup>
import OpenNew from '@/Components/Icon/OpenNew.vue';
import Attach from '@/Components/Icon/Attach.vue';
import Manage from '@/Components/Icon/Manage.vue';
import Track from '@/Components/Icon/Track.vue';
import Move from '@/Components/Icon/Move.vue';
import Edit from '@/Components/Icon/Edit.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import Comment from '@/Components/Icon/Comment.vue';
import Upload from './Icon/Upload.vue';
import { useLayoutStore } from '@/Store/LayoutStore';

const storeLayout = useLayoutStore()

const emits = defineEmits([
    'edit',
    'comments',
    'track',
])

const context = ref(null);
const toggleContext = ref(false);

const clickOuteside = () => {
    toggleContext.value = false;
}

const getComments = () => {
    emits('comments')
    clickOuteside()
}
const getEdits = () => {
    emits('edit')
    clickOuteside()
}
const getTrack = () => {
    emits('track')
    clickOuteside()
}

const hieghtCheck = () => {
    console.log(context.value.offsetHeight)
}

onMounted(() => {
    //console.log(context.value.offsetWidth)
    window.addEventListener("resize", () => {
        clickOuteside()
    });

    window.addEventListener("contextmenu", (e) => {
        if(e.target.closest("#context")) return 
        if(!context.value) context.value = document.getElementById('context') 

        toggleContext.value = false;
        setTimeout(() => {
            if (e.target.closest(".recordCards")) {
                toggleContext.value = true;
    
                let x = e.clientX,
                    y = e.clientY,
                    winWidth = window.innerWidth,
                    winHeight = window.innerHeight,
                    cmWidth =
                        context.value.offsetWidth == 0
                            ? 240
                            : context.value.offsetWidth,
                    cmHeight =
                        context.value.offsetHeight == 0
                            ? 322
                            : context.value.offsetHeight; 

                x = x > winWidth - cmWidth ? winWidth - (cmWidth + 20) : x;
                y = y > winHeight - cmHeight ? winHeight - (cmHeight + 10) : y;
    
                context.value.style.top = y + "px";
                context.value.style.left = x + "px";
            } else {
                if (!e.target.closest(".contxtmenu")) toggleContext.value = false;
            }
        }, 50);
    });
})

</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-click-outside="clickOuteside"
                id="context"
                v-show="toggleContext"
                ref="context"
                class="fixed bg-white dark:bg-tertiaryDarkBg ring-1 ring-black ring-opacity-5 w-[15rem] z-40 top-10 rounded-2xl shadow-lg dark:text-secondaryWhite 
                overflow-hidden contxtmenu text-sm text-gray-600"
            >

                <ul class="rounded-2xl p-2">
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3 ">
                            <OpenNew />
                        </div>
                        Open
                    </li>
                    <hr class="my-1">
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                        @click="getEdits"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3 ">
                            <Edit />
                        </div>
                        Edit
                    </li>
                    <li
                        v-if="storeLayout.isRepo"
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3">
                            <Upload />
                        </div>
                        Upload
                    </li>
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3">
                            <Move />
                        </div>
                        Move
                    </li>
                    <hr class="my-1">
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                        @click="getComments"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3 ">
                            <Comment />
                        </div>
                        Comments
                    </li>
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3 ">
                            <Attach />
                        </div>
                        Attach to record
                    </li>
                    
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3">
                            <Manage />
                        </div>
                        Manage version
                    </li>
                    <li
                        class="hover:dark:bg-white/10 hover:bg-gray-200/60 dark:bg-tertiaryDarkBg flex items-center h-9 px-3 cursor-pointer hover:text-gray-800 transition duration-200"
                        @click="getTrack"
                    >
                        <div class="w-5 h-5 items-center flex justify-center mr-3 ">
                            <Track />
                        </div>
                        Track document
                    </li>
                </ul>

            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>

li {
    @apply rounded-lg
}

</style>