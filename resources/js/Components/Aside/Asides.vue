<script setup>
import { useLayoutStore } from '@/Store/LayoutStore';
import MainAside from '@/Components/Aside/Main.vue';
import Details from '@/Components/Aside/Details.vue';
import Personel from '@/Components/Aside/Personel.vue';
import TaggedOffice from '@/Components/Aside/TaggedOffice.vue';
import Track from '@/Components/Aside//Track.vue';
import AsideTransitions from './AsideTransitions.vue';
import AddOffice from './TagOffice/AddOffice.vue';
import { ref } from 'vue';
import AddPersonel from '@/Components/Aside/Personnel/AddPersonel.vue'
import { useForm } from '@inertiajs/vue3';

const storeLayout = useLayoutStore()

const isAddOffice = ref(false)
const isAddPersonnel = ref(false)
const excludeTags = ref([])
const added = useForm({
    hasNew: false,
    new: []
})

const getExcludeTagged = ex => {
    excludeTags.value = ex
}
const getAddedTagOffice = val => {
    added.hasNew = true,
    added.new = val

    setTimeout(() => {
        added.reset()
    }, 500)
}

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
                <Personel 
                    @handleAdd="isAddPersonnel = true"
                />
            </div>
        </AsideTransitions>
        <AsideTransitions>
            <div class="grow inline-flex flex-col overflow-y-auto" data-aside v-if="storeLayout.aside.header == 'Tagged Office'">
                <TaggedOffice 
                    @handleAdd="isAddOffice = true"
                    @handleExcludes="getExcludeTagged"
                    :record="storeLayout.selectedItem.item"
                    :added="added"
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
        :record="storeLayout.selectedItem.item"
        :excludes="excludeTags"
        @handleClose="isAddOffice = false"
        @addedNew="getAddedTagOffice"
    />
    <AddPersonel 
        :show="isAddPersonnel"
        :personnel="storeLayout.selectedItem.item"
        @handleClose="isAddPersonnel = false"
    />

</template>