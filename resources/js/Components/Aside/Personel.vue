<script setup>
import AsideContents from './AsideContents.vue';
import PersonelFill from '../Icon/PersonelFill.vue';
import Empty from './Empty.vue'; 
import New from '../Buttons/New.vue';
import NewIcon from '../Icon/New.vue';
import CircleButton from '../Buttons/CircleButton.vue';

</script>

<template>
    <AsideContents>

        <template #subheader>
            <div class="text-sm">Personnel</div>
            
            <New 
                :class="'pointer-events-auto gr ow justify-center'"
                margin="ml-auto"
                :mainSize="948"
                label="Add"
            >
                <NewIcon />
            </New>


            <!-- <CircleButton tooltip_label="Add" class="ml-auto">
                <NewIcon />
            </CircleButton> -->
        </template>

        <div class="pointer-events-none grow flex flex-col">
            <div class="rounded-2xl bg-gray-100 overflow-hidden" v-if="false">
                <div class="hover:bg-gray-200/80 pointer-events-auto transition-200 rounded-lg h-16" v-for="(item, index) in 20" :key="index" data-aside></div>
            </div>

            <Empty
                label="No personnel added"
            >
                <PersonelFill size="max2" />
            </Empty>
        </div>
    </AsideContents>
</template>