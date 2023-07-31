<script setup>
import GridView from '@/Layouts/GridView.vue';
import GridCards from '@/Layouts/GridCards.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage, Link } from '@inertiajs/vue3';
import MoreV from '@/Components/Icon/MoreV.vue';
import New from '@/Components/Icon/New.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import { ref, onMounted } from 'vue';
import NewBtn from '@/Components/Buttons/New.vue';
import Buttons from '@/Components/Records/Buttons.vue';
import Layouts from '@/Components/Buttons/Layouts.vue';
import NewModal from '@/Components/Offices/New.vue';
import { handleClickElement } from '@/Store/JS/windowElement'
import BreadCrumbs from '@/Components/BreadCrumbs.vue';
import RightCrumbs from "@/Components/Icon/RightCrumbs.vue";
import Empty from '@/Components/Aside/Empty.vue';
import OfficeFill from '@/Components/Icon/OfficeFill.vue';
import { __conditioned_array } from '@/Store/JS/Arrays';
import RecordsFill from '@/Components/Icon/RecordsFill.vue';

const storeLayout = useLayoutStore()
const page = usePage().props

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
const getDelete = () => {
    router.post(route('offices.delete', [selectedItem.value]))
}


const clicksOutside = e => {
    const attribs = ['data-record', 'data-button', 'data-search', 'data-aside']
    handleClickElement(e, attribs, () => {
        selectedItem.value = null
        storeLayout.closeAside()
    })
}

const route_back = () => {
    if (page.crumbs.length > 1) {
        router.get( route("records.open", [page.crumbs[page.crumbs.length - 1].id]) );
    } else if(page.crumbs.length === 1) {
        // office link here
    } else router.get(route("records"));
};

onMounted(() => {
    storeLayout.closeAside()
    storeLayout.selectedItem.reset()

    storeLayout.previousComponent = usePage().component
})
</script>

<template>
    <Head title="Offices" />

    <AuthenticatedLayout 
        @handleClick="clicksOutside"
        @handleGetMainSize="getMainSize"
        @edit="isCreateOffice = true, isEditOffice = true"
        @track="storeLayout.asideButtons('Track document')"
    >
        <template #header>
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center">
                <BreadCrumbs 
                    :show-back="($page.props.current || $page.props.office) != null"
                >
                    <Link :href="route('offices')" @click="storeLayout.closeAside" class="hover:text-[#15a868] transition duration-150" v-if="$page.props.current || $page.props.office">Offices</Link>
                    <div v-else>Offices</div>
                    <RightCrumbs :stroke="3" v-if="$page.props.crumbs || $page.props.office" />

                    <div class="font-semibold text-lg" v-if="$page.props.office">
                        <Link :href="route('offices')" @click="storeLayout.closeAside" class="hover:text-[#15a868] transition duration-150" v-if="$page.props.crumbs">
                            {{ $page.props.office.name }}
                        </Link>
                        <div v-else>{{ $page.props.office.name }}</div>
                    </div>
                    <RightCrumbs :stroke="3" v-if="$page.props.crumbs" />
                </BreadCrumbs>
            </h2>
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
                @handleDetails="storeLayout.asideButtons('Details')"
                @handlePersonel="storeLayout.asideButtons('Personnel')"
                @handleDelete="getDelete"
            />
        </template>

        <div class="h-full flex flex-col">
            <GridView>
                <GridCards 
                    v-for="(item, index) in $page.props.offices" 
                    :key="index" 
                    :active="selectedItem == item.id"
                    styles="recordCards" 
                    @click="selectItem(item)"
                    @contextmenu="selectItem(item)"
                    @dblclick="
                        router.visit(route('offices', [item.id]), {
                            method: 'get',
                            data: {
                                open: true
                            }
                        })
                    "
                >
                    <div 
                        class="pointer-events-none h-full flex items-center px-3" 
                    >
                        <div class="Oneline pointer-events-none " v-text="item.name"></div>
                    </div>
                </GridCards>
            </GridView>

            <div class="px-2 mt-2" v-if="$page.props.records">
                Records
            </div>
            <GridView>
                <GridCards v-for="(item, index) in $page.props.records" :key="index" styles="recordCards">
                    <div 
                        class="pointer-events-none h-full flex items-center px-3" 
                    >
                        <div class="Oneline pointer-events-none " v-text="item.name"></div>
                    </div>
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

            <Empty 
                :label="($page.props.office?'No records added':'No office added')"
                size="3xl"
                v-if="(!$page.props.offices||__conditioned_array($page.props.offices, '==', 0)) && (!$page.props.records||__conditioned_array($page.props.records, '==', 0))"
            >
                <OfficeFill size="max4" />
                <div class=" text-slate-600 absolute translate-y-[115%] translate-x-[60%]" 
                v-if="(!$page.props.records||__conditioned_array($page.props.records, '==', 0)) && $page.props.office">
                    <RecordsFill size="4xl" />
                </div>
            </Empty>

            <NewModal 
                :show="isCreateOffice" 
                :isEdit="isEditOffice" 
                @handleCancel="closeModal"
                @handleCreate="closeModal"
            />

        </div>
    </AuthenticatedLayout>
</template>
