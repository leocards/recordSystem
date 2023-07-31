<script setup>
import Xmark from '@/Components/Icon/Xmark.vue';
import Search from '@/Components/Icon/Search.vue';
import { ref, onMounted } from 'vue';
import { nextTick } from 'vue';

const props = defineProps({
    mainSize: Number,
    searchLabels: String,
    searchVal: String
})

const emits = defineEmits([
    'handleSearch'
])

const search = ref(null);
const searchbar = ref(null);
const searchFocus = ref(false);

const onSearch = () => {
    searchbar.value.focus()
}
const getSearchValue = e => {
    search.value = e.target.value??null
    emits('handleSearch', search.value)
}
const clearSearch = (searchVal) => {
    search.value = null;
    searchFocus.value = false;
    emits('handleSearch', search.value)
};

onMounted(() => {
    nextTick(() => onSearch())
    if(props.searchVal)
        search.value = props.searchVal
})

</script>

<template>
    <div class="flex grow">
        <div
            @click="onSearch"
            :class="{ 'ring-1 ring-green-400 ring-offset-1 ring-offset-green-600/10 transition duration-200': searchFocus }"
            class="rounded-xl h-10 flex items-center px-1 bg-gray-100/70 dark:bg-neutral-800 cursor-text grow shadow-insetShadow"
            data-search
        >
            <input
                :value="search"
                type="text"
                :placeholder="'Search '+ searchLabels"
                class="h-8 w-full text-sm bg-transparent outline-none border-none px-1.5 focus:ring-0 focus:border-none shadow-none mr-1 ml-1.5"
                @input="getSearchValue"
                @focus="searchFocus = true"
                @focusout="searchFocus = false"
                ref="searchbar"
                data-search
            />
            <button
                @click="clearSearch"
                :class="[search ? '' : '']"
                class="hover:bg-green-700 hover:text-white h-8 w-8 flex items-center justify-center rounded-full text-gray-700 shrink-0 transition duration-150"
                data-button
            >
                <Xmark v-if="search" />
                <Search v-else />
            </button>
        </div>
    </div>
</template>