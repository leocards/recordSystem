<script setup>
import Modal from "@/Components/Modal.vue";
import CircleButton from "@/Components/Buttons/CircleButton.vue";
import Xmark from "@/Components/Icon/Xmark.vue";
import SearchInput from "@/Components/SearchInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useLayoutStore } from "@/Store/LayoutStore";
import SearchIcon from "@/Components/Icon/Search.vue";
import Empty from "../Empty.vue";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { router } from "@inertiajs/vue3";
import LoadingAnimationVue from "@/Components/LoadingAnimation.vue";

const storeLayout = useLayoutStore();

const props = defineProps({
    show: Boolean,
});

const emits = defineEmits(["handleClose"]);

const search = ref(null);

const getSearches = async (val) => {
    let getSearch = await axios.post(route("or_search", [val]));

    let response = getSearch.data;

    response.length === 0 ? (search.value = 2) : (search.value = response);
};

const debounces = (val) => {
    if (!val || val.trim() == "") return (search.value = null);

    search.value = 1;

    _.debounce(getSearches(val), 700);
};
</script>

<template>
    <Modal center :show="show" max-width="md">
        <div class="p-4 pr-3.5">
            <div class="flex mb-3 pr-0.5">
                <SearchInput @handleSearch="debounces" searchLabels="office" />
            </div>

            <div class="h-80 flex flex-col overflow-y-hidden">
                <div
                    class="grow overflow-y-auto pr-0.5"
                    v-if="search !== 2 && search && search !== 1"
                >
                    <div class="bg-slate-100/80 rounded-2xl overflow-hidden">
                        <div
                            v-for="(item, index) in search"
                            :key="index"
                            class="h-12 text-sm px-2 items-center flex hover:bg-gray-200"
                            v-text="item.name"
                        ></div>
                    </div>
                </div>

                <div
                    class="my-auto mx-auto"
                    v-if="(search && search == 2) || !search"
                >
                    <Empty
                        :label="
                            search == 2 ? 'No results found' : 'Start Searching'
                        "
                    >
                        <SearchIcon size="max" />
                    </Empty>
                </div>

                <div class="my-auto" v-if="search == 1">
                    <LoadingAnimationVue />
                </div>
            </div>

            <div class="flex mt-3 pr-0.5">
                <button
                    class="capsule hover:bg-gray-100 transition-150 text-gray-500 text-xs font-medium px-6"
                >
                    Back
                </button>

                <div class="w-fit ml-auto">
                    <SecondaryButton @click="$emit('handleClose')">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton class="ml-3"> Add office </PrimaryButton>
                </div>
            </div>
        </div>
    </Modal>
</template>
