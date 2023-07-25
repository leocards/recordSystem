<script setup>
import GridView from '@/Layouts/GridView.vue';
import GridCards from '@/Layouts/GridCards.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import MoreV from '@/Components/Icon/MoreV.vue';
import New from '@/Components/Icon/New.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import { ref, onMounted } from 'vue';
import NewBtn from '@/Components/Buttons/New.vue';
import Buttons from '@/Components/Records/Buttons.vue';
import Layouts from '@/Components/Buttons/Layouts.vue';
import NewModal from '@/Components/Offices/New.vue';
import { handleClickElement } from '@/Store/JS/windowElement'

const storeLayout = useLayoutStore()

const mainSize = ref(0)
const selectedItem = ref(null)
const isEditOffice = ref(false)
const isCreateOffice = ref(false)

const getMainSize = size => {
    mainSize.value = size
}
const closeModal = () => {
    isEditOffice.value = false
    isCreateOffice.value = false
}
const selectItem = item => {
    selectedItem.value = item.id.toString()
    storeLayout.selectedItem.item = item
}
const TrackDocument = () => {
    storeLayout.aside.header = 'Track document'
    storeLayout.openAside()
}

// Buttons methods
const showDetails = () => {
    storeLayout.aside.header = 'Details'
    storeLayout.openAside()
}
const showComments = () => {
    storeLayout.aside.header = 'Comments'
    storeLayout.openAside()
}
const showPersonnel = () => {
    storeLayout.aside.header = 'Personnel'
    storeLayout.openAside()
}
const showTaggedOffice = () => {
    storeLayout.aside.header = 'Tagged Office'
    storeLayout.openAside()
}

const clicksOutside = e => {
    const attribs = ['data-record', 'data-button', 'data-search', 'data-aside']
    handleClickElement(e, attribs, () => {
        selectedItem.value = null
        storeLayout.closeAside()
    })
}

onMounted(() => {
    storeLayout.closeAside()
    storeLayout.selectedItem.reset()
})
</script>

<template>
    <Head title="Offices" />

    <AuthenticatedLayout 
        @handleClick="clicksOutside"
        @handleGetMainSize="getMainSize"
        @edit="isCreateOffice = true, isEditOffice = true"
        @track="TrackDocument"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Offices</h2>
        </template>

        <template #contentHeader>
            <NewBtn 
                :mainSize="mainSize" 
                label="New Office" 
                labelPosition="top-10 -left-0"
                @click="isCreateOffice = true, isEditOffice = false"
            >
                <New />
            </NewBtn>

            <Layouts :mainSize="mainSize" />

            <Buttons 
                :selects="selectedItem"
                :mainSize="mainSize"
                :exlcudes="[4]"
                @handleEdit="isCreateOffice = true, isEditOffice = true"
                @handleDetails="showDetails"
                @handlePersonel="showPersonnel"
            />
        </template>

        <div class="">
            <GridView>
                <GridCards 
                    v-for="(item, index) in $page.props.offices" 
                    :key="index" 
                    :active="selectedItem == item.id"
                    styles="recordCards" 
                    @click="selectItem(item)"
                    @contextmenu="selectItem(item)"
                >
                    <div 
                        class="pointer-events-none h-full flex items-center px-2" 
                    >
                        <div class="Oneline pointer-events-none " v-text="item.name"></div>
                    </div>
                </GridCards>
            </GridView>

            <GridView v-if="false">
                <GridCards v-for="(item, index) in 10" :key="index" styles="recordCards">
                    
                </GridCards>
            </GridView>

            <div class="px-2 mt-5" v-if="false">
                Documents
            </div>
            <GridView gridSize="md" v-if="false">
                <GridCards v-for="(item, index) in 10" :key="index" styles="p-2 flex flex-col hover:bg-gray-100/80 recordCards" height="4xl">
                
                    <div class="shrink-0 h-20 rounded-lg overflow-hidden object-cover">
                        <img src="../../../public/files/sample.jpg" alt="">
                    </div>

                    <div class="grow mt-1 rounded flex flex-col pointer-events-none" >
                        <div class="flex grow">
                            <div class="grow flex flex-col">
                                <div>Lorem ipum dolor est</div>
                                <div class="text-xs text-gray-500/80">Lorem ipum dolor est</div>
                            </div>
                            <div class="w-8 shrink-0 flex items-center justify-center">
                                <button class="rounded-full hover:bg-gray-300/70 transition duration-200 w-7 h-7 flex items-center justify-center pointer-events-auto">
                                    <MoreV />
                                </button>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 mt-auto">comment 1</div>

                    </div>

                </GridCards>
            </GridView>

            <NewModal 
                :show="isCreateOffice" 
                :isEdit="isEditOffice" 
                @handleCancel="closeModal"
                @handleCreate="closeModal"
            />

        </div>
    </AuthenticatedLayout>
</template>
