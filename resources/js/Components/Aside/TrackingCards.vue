<script setup>
import { ref } from 'vue';


const props = defineProps({
    tracking: Object,
    index: Number,
    length: Number
})

const firstTrack = ref(
    props.index === 0 ? true : false
)

</script>

<template>
    <div>
        <div class="relative flex " :class="firstTrack? 'text-green-600': 'pt-6'" v-if="!tracking.trackType">
            <!-- track lines -->
            <div class="absolute w-0.5 top-0 left-[0.69rem] h-6 bg-gray-300" v-if="index+1 === length"></div><!-- last track -->
            <div class="absolute w-0.5 top-0 left-[0.69rem] h-full bg-gray-300" v-else></div>
            <!-- end of tracking line -->
            <div class="shrink-0 w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center mr-2.5 relative z-10">
                <div class="w-2 h-2 rounded-full ring-1 ring-inset" :class="firstTrack?'bg-green-400 ring-green-700/50':'bg-white ring-slate-700/40'"></div>
            </div>
            <div class="flex grow mt-1">
                <div class="grow text-xs">
                    <span class="font-medium"> {{ tracking.name }} </span>
                    <span class="font-normal ml-1" :class="firstTrack?'text-green-600/80':'text-gray-500/80'"> {{ tracking.action }} </span>
                </div>
                <div class="max-w-[6.5rem] shrink-0 px-1 text-[10px] [11px] text-end self-start"> {{ tracking.date }} </div>
            </div>
        </div>
        
        <div class="relative flex pt-6" v-if="tracking.trackType == 'comment'">
            <!-- track lines -->
            <div class="absolute w-0.5 top-0 left-[0.69rem] h-6 bg-gray-300" v-if="index+1 === length"></div><!-- last track -->
            <div class="absolute w-0.5 top-0 left-[0.69rem] h-full bg-gray-300" v-else></div>
            <!-- end of tracking line -->
            <div class="shrink-0 w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center mr-2.5 relative z-10">
                <div class="w-2 h-2 rounded-full bg-white ring-1 ring-inset ring-slate-700/40"></div>
            </div>
            <div class="flex flex-col grow ring-1 p-2 rounded-xl ring-inset ring-slate-700/20">
                <div class="grow flex items-center">
                    <div class="grow text-xs font-medium">
                        <span class="font-medium"> {{ tracking.name }} </span>
                        <span class="text-gray-500/80 font-normal ml-1"> {{ tracking.action }} </span>
                    </div>
                    <div class="max-w-[6.5rem] shrink-0 px-1 text-[10px] [11px] text-end"> {{ tracking.date }} </div>
                </div>
                <div class="grow text-sm text-gray-500/80 mt-1">
                    {{ tracking.comment }}
                </div>
            </div>
        </div>
    </div>
</template>