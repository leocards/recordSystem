<script setup>
import Modal from '@/Components/Modal.vue';
import SearchInput from '@/Components/Inputs/SearchInput.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import SearchIcon from '@/Components/Icon/Search.vue'
import Empty from '../Empty.vue';
import { ref } from 'vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'; 
import LoadingAnimationVue from '@/Components/LoadingAnimation.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect } from 'vue';
import TagCard from './TagCard.vue';
import AddedTags from './AddedTags.vue';

const storeLayout = useLayoutStore()

const props = defineProps({
    show: Boolean,
    record: Object
})

const emits = defineEmits([
    'handleClose'
])

const search = ref(null)
const addOfficeForm = useForm({
    offices: [],
    record: props.record?props.record.id:null,
    filters: []
})
const isNext = ref(false)

const getSearches = async (val) => {
    if(!val || val.trim() == '') return search.value = null;

    search.value = 1

    let getSearch = await axios.post(route('or_search', [val]))
    let response = getSearch.data

    response.forEach((res, index) => {
        if(addOfficeForm.filters.includes(res.id))
            response[index].added = true
        else
            response[index].added = false
    })

    response.length === 0 ? search.value = 2 : search.value = response
}

const debounces = _.debounce(getSearches, 700, {
    leading: true,
    trailing: true
})

const getOffice = (office, index) => {
    addOfficeForm.offices.push(office)
    addOfficeForm.filters.push(office.id)
    search.value[index].added = true
}

const removeOffice = (index) => {
    addOfficeForm.offices.splice(index, 1)
    let removed = addOfficeForm.filters.splice(index, 1)
    search.value[search.value.findIndex(val => val.id == removed)].added = false
}

watchEffect(() => {
    if(!props.show) {
        search.value = null, addOfficeForm.reset(),isNext.value = false
    }
})

</script>

<template>
    <Modal
        center
        :show="show"
        max-width="md"
    >
        <div class="p-4 pr-3.5">
            
            <div class="mb-4 text-lg">
                Add office to " {{ record.name }} "
            </div>

            <div>
                <div class="flex mb-3 pr-0.5">
                    <SearchInput @handleSearch="debounces" searchLabels="office" />
                </div>
                
                <div class="h-[20rem] flex flex-col overflow-y-hidden">
                    <div class="grow overflow-y-auto pr-0.5" v-if="search !== 2 && search && search !== 1">
                        <div class="bg-slate-100/80 rounded-2xl overflow-hidden">
                            <TagCard 
                                v-for="(item, index) in search" :key="index"
                                @handle-get-office="getOffice(item, index)"
                                :index="index"
                                :last-element="(index !== search.length-1)"
                                :item="item"
                            />
                        </div>
                    </div>

                    <div class="my-auto mx-auto" v-if="(search && search == 2) || !search">
                        <Empty :label="search == 2 ? 'No results found' : 'Start Searching'">
                            <SearchIcon size="max" />
                        </Empty>
                    </div>

                    <div class="my-auto" v-if="search == 1">
                        <LoadingAnimationVue />
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap mb-3 mt-5 border border-slate-700/10 rounded-lg p-1 max-h-[10rem] overflow-y-auto" v-if="addOfficeForm.offices.length > 0">
                <AddedTags 
                    v-for="(item, index) in addOfficeForm.offices"
                    :index="index"
                    :item="item"
                    @handle-remove-office="removeOffice(index)"
                />
            </div>

            <div class="flex flex-row-reverse justify-between mt-3 pr-0.5">
                <div class="w-fit">
                    <SecondaryButton
                        @click="$emit('handleClose')"
                        :disabled="addOfficeForm.processing"
                    >
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :disabled="addOfficeForm.offices.length === 0 || addOfficeForm.processing"
                    >
                        Add office
                    </PrimaryButton>
                </div>
                
                <button class="capsule hover:bg-gray-100 transition-150 text-xs font-medium px-6 
                disabled:opacity-40 disabled:pointer-events-none select-none" v-if="addOfficeForm.offices.length !== 0">
                    Next
                </button>
            </div>
        </div>
    </Modal>
</template> 
