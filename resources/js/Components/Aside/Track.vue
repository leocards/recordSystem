<script setup>
import { ref } from 'vue';
import AsideContents from './AsideContents.vue';
import TrackingCards from './TrackingCards.vue';
import OpenNew from '../Icon/OpenNew.vue';
import CircleButton from '../Buttons/CircleButton.vue';

const trackings = ref([
    {
        name: 'John Doe',
        action: 'Approved to office 1',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'printed this document',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'Approved to office 1',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'Commented',
        trackType: 'comment',
        comment: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus a magnam sunt, illo perferendis aut dolores ea maxime, eveniet deserunt aliquid commodi fugiat voluptatem itaque adipisci velit? Aliquid, sunt.',
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'submitted this document',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'Approved to office 1',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
    {
        name: 'John Doe',
        action: 'Approved to office 1',
        trackType: null,
        date: 'Jan 01, 2023',
        time: '4:30 AM'
    },
])

</script>

<template>
    <AsideContents
        subheadheight="fit"
    >
        <template #subheader>
            <div class="flex items-center justify-between grow pointer-events-none">
                <div class="text-sm pointer-events-none">Tracking details</div>
                <button
                    data-button
                    class="w-9 h-9 flex items-center justify-center shrink-0 rounded-full hover:bg-gray-100 pointer-events-auto text-gray-500"
                >
                    <OpenNew />
                </button>
            </div>
        </template>

        <div class="pointer-events-none grow p-1.5 pr-3 rounded-2xl bg-gray-100">
            <TrackingCards v-for="(item, index) in trackings" :key="index" :tracking="item" :index="index" :length="trackings.length" />
        </div>
    </AsideContents>
</template>