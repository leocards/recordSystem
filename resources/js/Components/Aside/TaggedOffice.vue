<script setup>
import AsideContents from './AsideContents.vue';
import OfficeFill from '../Icon/OfficeFill.vue';
import Empty from './Empty.vue';
import New from '../Buttons/New.vue';
import NewIcon from '../Icon/New.vue';

const emits = defineEmits([
    'handleAdd'
])

</script>

<template>
    <AsideContents>
        <template #subheader>
            <div class="text-sm">Tagged Office</div>

            <New 
                :class="'pointer-events-auto gr ow justify-center'"
                margin="ml-auto"
                :mainSize="948"
                label="Add"
                @click="$emit('handleAdd')"
            >
                <NewIcon />
            </New>
        </template>
        <div class="pointer-events-none text-sm flex flex-col grow">
            <div class="w-full rounded-lg bg-gray-100 min-h-[3.5rem] overflow-hidden p-1" v-if="false">
                <div class="flex">
                    <div class="ring-1 grow">
                        Office of the Vice President
                    </div>
                    <div class="w-6">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-gray-100 overflow-hidden" v-if="false">
                
                <div class="hover:bg-gray-200/80 pointer-events-auto transition-200 rounded-lg h-16" v-for="(item, index) in 10" :key="index" data-aside></div>

            </div>

            <Empty
                label="No office added"
            >
                <OfficeFill size="max2" />
            </Empty>
        </div>
    </AsideContents>
</template>