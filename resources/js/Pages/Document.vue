<script setup>
import MoreV from '@/Components/Icon/MoreV.vue';
import GridView from '@/Layouts/GridView.vue';
import Upload from '@/Components/Icon/Upload.vue';
import GridCards from '@/Layouts/GridCards.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from "vue";
import { Head, usePage } from '@inertiajs/vue3';
import { useLayoutStore } from '@/Store/LayoutStore';
import New from "@/Components/Buttons/New.vue";
import Layouts from "@/Components/Buttons/Layouts.vue";

const storeLayout = useLayoutStore()

const mainSize = ref(0)
const showViewTypes = ref(false);

const getMainSize = size => {
    mainSize.value = size
}

const clicksOutside = e => {
    //console.log(e.target.hasAttribute('data-record'))
    //handleClickElement
}

onMounted(() => {
    storeLayout.closeAside()
    storeLayout.selectedItem.reset()

    storeLayout.previousComponent = usePage().component

})

</script>

<template>
    <Head title="Documents" />

    <AuthenticatedLayout 
        @handleClick="clicksOutside"
        @handleGetMainSize="getMainSize"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Documents</h2>
        </template>

        <template #contentHeader>
            <New 
                :mainSize="mainSize" 
                label="Upload"
                labelPosition="top-10 -left-0"
            >
                <Upload />
            </New>

            <Layouts :class="'mr-1'" :mainSize="mainSize"/>
        </template>

        <div class="">
            <GridView gridSize="md">
                <GridCards 
                    v-for="(item, index) in 10" 
                    :key="index" 
                    styles="p-2 flex flex-col hover:bg-gray-100/80 recordCards" 
                    height="4xl"
                    @handle-context="storeLayout.toggleRepo(false)"
                >
                    
                    <div class="shrink-0 h-20 rounded-lg overflow-hidden object-cover">
                        <img src="../../../public/files/sample.jpg" alt="">
                    </div>

                    <div class="grow mt-1 rounded flex flex-col">
                        <div class="flex grow">
                            <div class="grow flex flex-col">
                                <div>Lorem ipum dolor est</div>
                                <div class="text-[10px] text-gray-500/80 leading-4"> 
                                    <span class="font-bold text-xs">&#x2022; </span>
                                    Lorem ipum dolor est
                                    <span><span class="font-thin"> &#8226;</span> 1hr</span>
                                </div>
                            </div>
                            <div class="w-8 shrink-0 flex items-center justify-center">
                                <button class="rounded-full hover:bg-gray-300/70 transition duration-200 w-7 h-7 flex items-center justify-center">
                                    <MoreV />
                                </button>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 mt-auto">comment 1</div>

                    </div>

                </GridCards>
            </GridView>
        </div>
    </AuthenticatedLayout>
</template>
