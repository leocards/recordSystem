<script setup>
import New from "@/Components/Icon/New.vue";
import Xmark from "@/Components/Icon/Xmark.vue";
import GridView from "@/Layouts/GridView.vue";
import NewBtn from '@/Components/Buttons/New.vue';
import Search from "@/Components/Icon/Search.vue";
import GridCards from "@/Layouts/GridCards.vue";
import NewRecord from '@/Components/Records/New.vue';
import BreadCrumbs from "@/Components/BreadCrumbs.vue";
import Buttons from '@/Components/Records/Buttons.vue';
import Layouts from '@/Components/Buttons/Layouts.vue';
import RightCrumbs from "@/Components/Icon/RightCrumbs.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from "vue";
import { useLayoutStore } from "@/Store/LayoutStore";
import { Head, router, usePage, Link } from "@inertiajs/vue3";
import ListView from "@/Layouts/ListView.vue";
import { handleClickElement } from '@/Store/JS/windowElement'

const storeLayout = useLayoutStore()
const page = usePage().props

const search = ref(null);
const searchbar = ref(null);//getting search element
const searchFocus = ref(false);
const isEditRecord = ref(false)
const selectedItem = ref(null)
const mainSize = ref(0)

const isCreateRecord = ref(false)

const getMainSize = size => {
    mainSize.value = size
}

const selectItem = item => {
    selectedItem.value = item.id
    storeLayout.selectedItem.item = item
}

const onSearch = () => {
    if(mainSize.value > 947)
        searchbar.value.focus()
}

const clearSearch = (searchVal) => {
    search.value = null;
    searchFocus.value = false;
};

const closeModal = () => {
    isCreateRecord.value = false
}

const clicksOutside = e => {
    const attribs = ['data-record', 'data-button', 'data-search', 'data-aside', 'data-content']
    handleClickElement(e, attribs, () => {
        if(page.current){
            selectItem(page.current)
            storeLayout.closeAside()
        } else {
            selectedItem.value = null
            storeLayout.closeAside()
            storeLayout.selectedItem.reset()
        }
    }, page.current, () => {
        selectItem(page.current)
    })
}

const onContext = e => {
    if(e.target.closest("#__content") && !e.target.closest(".recordCards"))
    {
        /* selectedItem.value = null
        storeLayout.closeAside()
        storeLayout.selectedItem.reset()
        console.log('asdasf') */
    }
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

const route_back = () => {
    if (page.crumbs.length > 0) {
        router.get(
            route("records.open", [page.crumbs[page.crumbs.length - 1].id])
        );
    } else {
        router.get(route("records"));
    }
};

onMounted(() => {
    if(storeLayout.previousComponent != 'Record') {
        storeLayout.closeAside()
        storeLayout.selectedItem.reset()
    }

    storeLayout.previousComponent = usePage().component

    if(page.current){
        selectItem(page.current)
    }
})

</script>

<template>
    <Head title="Records" />

    <AuthenticatedLayout 
        @handleClick="clicksOutside"
        @handleGetMainSize="getMainSize"
        @comments="showComments"
        @edit="isCreateRecord = true, isEditRecord = true"
        @handleContextmenu="onContext"
        @track="TrackDocument"
    >
        <template #header>
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center">
                <BreadCrumbs 
                    :show-back="page.current != null"
                    @handle-back="route_back"
                >
                    <Link :href="route('records')" @click="storeLayout.closeAside" class="hover:text-[#15a868] transition duration-150" v-if="page.current">Records</Link>
                    <div v-else>Records</div>
                    <RightCrumbs :stroke="3" v-if="page.crumbs" />
                    
                </BreadCrumbs>
            </h2>
        </template>

        <template #contentHeader>
            <div class="mr-3 ml-1" v-if="false">
                <div
                    @click="onSearch"
                    :class="{ 'border-grey-600': searchFocus }, [mainSize <= 947 ? 'hover:bg-green-700/10 cursor-pointer' : '']"
                    class="rounded-full h-10 flex items-center px-1 bg-slate-100 dark:bg-neutral-800 mr-1"
                    data-search
                >
                    <input
                        :value="search"
                        type="text"
                        placeholder="Search record"
                        class="h-8 text-sm bg-transparent outline-none border-none px-1.5 focus:ring-0 focus:border-none shadow-none mr-1.5 ml-1.5"
                        @input="(event) => (search = event.target.value)"
                        @focus="searchFocus = true"
                        @focusout="searchFocus = false"
                        ref="searchbar"
                        data-search
                        v-if="mainSize > 947"
                    />
                    <button
                        @click="clearSearch"
                        :class="[search ? '' : ''], [mainSize > 947 ? 'hover:bg-green-700/10' : '']"
                        class=" h-8 w-8 flex items-center justify-center rounded-full text-gray-700"
                        data-button
                    >
                        <Xmark v-if="search" />
                        <Search v-else />
                    </button>
                </div>
            </div>
            
            <NewBtn 
                :mainSize="mainSize" 
                label="New record" 
                labelPosition="top-11 -left-0"
                @click="isCreateRecord = true, isEditRecord = false"
            >
                <New />
            </NewBtn>

            <Layouts :mainSize="mainSize" />

            <Buttons 
                :exlcudes="[3]"
                :mainSize="mainSize"
                :selects="selectedItem"
                @handleEdit="isCreateRecord = true, isEditRecord = true"
                @handleDetails="showDetails"
                @handlePersonel="showPersonnel"
                @handleTaggedOffice="showTaggedOffice"
            />
        </template>

        <div class="">
            <GridView >
                <GridCards 
                    v-for="(item, index) in usePage().props.records" 
                    :key="index" 
                    :active="selectedItem == item.id"
                    styles="recordCards"
                    @click="selectItem(item)"
                    @contextmenu="selectItem(item)"
                    @handle-context="storeLayout.toggleRepo(true)"
                    @dblclick="storeLayout.getRouteTo(route('records.open', [item.id]), false)"
                >

                    <div 
                        class="pointer-events-none h-full flex items-center px-3" 
                    >
                        <div class="Oneline pointer-events-none " v-text="item.name"></div>
                    </div>

                </GridCards>
            </GridView>

            <ListView>
            
            </ListView>

        </div>
    </AuthenticatedLayout>

    <NewRecord 
        :isEdit="isEditRecord"
        :show="isCreateRecord"
        @handleCancel="closeModal"
        @handleCreate="closeModal"
    />
</template>

