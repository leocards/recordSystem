<script setup>
import { useLayoutStore } from '@/Store/LayoutStore';
import MainAside from '@/Components/Aside/Main.vue';
import Details from '@/Components/Aside/Details.vue';
import Personel from '@/Components/Aside/Personel.vue';
import TaggedOffice from '@/Components/Aside/TaggedOffice.vue';
import Track from '@/Components/Aside//Track.vue';
import AsideTransitions from './AsideTransitions.vue';
import AddOffice from './TagOffice.vue/AddOffice.vue';
import { ref } from 'vue';

const storeLayout = useLayoutStore()

const isAddOffice = ref(false)

</script>

<template>
    <MainAside :show="storeLayout.showAside">

        <AsideTransitions>
            <div class="grow inline-flex flex-col overflow-y-auto" data-aside v-if="storeLayout.aside.header == 'Details'">
                <Details />
            </div>
        </AsideTransitions>
        <AsideTransitions>
            <div class="grow inline-flex flex-col overflow-y-auto" data-aside v-if="storeLayout.aside.header == 'Personnel'">
                <Personel />
            </div>
        </AsideTransitions>
        <AsideTransitions>
            <div class="grow inline-flex flex-col overflow-y-auto" data-aside v-if="storeLayout.aside.header == 'Tagged Office'">
                <TaggedOffice 
                    @handleAdd="isAddOffice = true"
                />
            </div>
        </AsideTransitions>
        <AsideTransitions>
            <div class="grow inline-flex flex-col overflow-y-auto" data-aside v-if="storeLayout.aside.header == 'Track document'">
                <Track />
            </div>
        </AsideTransitions>

    </MainAside>
    
    <AddOffice 
        :show="isAddOffice"
        @handleClose="isAddOffice = false"
    />
</template>