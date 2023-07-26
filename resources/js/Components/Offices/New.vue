<script setup>
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watchEffect, nextTick } from 'vue';
import InputError from '@/Components/Inputs/InputError.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import { useLayoutStore } from '@/Store/LayoutStore';

const storeLayout = useLayoutStore()
const page = usePage().props

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    isEdit: Boolean
})

const emits = defineEmits([
    'handleCancel',
    'handleCreate'
])

const office = ref(null)
const officeForm = useForm({
    id: null,
    name: 'Untitled office',
    parent: null
})

const getInputElement = el => {
    office.value = el
}
const pressEnter = e => {
    if(e.keyCode === 13 && !officeForm.errors.name)
        createRecord()
    else {
        officeForm.errors.name = null
    }
}

//create office route
const createRecord = () => {
    if(!props.isEdit)
        officeForm.post(route('offices.new'), {
            preserveScroll: true,
            onSuccess: page => {
                emits('handleCreate')
            }
        });
    else 
        officeForm.post(route('offices.update', officeForm.id), {
            preserveScroll: true,
            onSuccess: page => {
                if(storeLayout.selectedItem.item)
                   storeLayout.selectedItem.item.name =  officeForm.name
                emits('handleCreate')
            }
        });
}

watchEffect(() => {
    if(props.show) {
        nextTick(() => {
            office.value.focus()
            office.value.setSelectionRange(0, officeForm.name.length)
        })

        if(props.isEdit) {
            officeForm.id = storeLayout.selectedItem.item.id
            officeForm.name = storeLayout.selectedItem.item.name
        }
    }
})

</script>

<template>
    <Modal
        max-width="sm"
        :show="show"
        :center="true"
    >

        <div class="p-4">

            <div class="text-lg"><span v-text="(!isEdit?'New':'Update')"></span> office</div>

            <div class="mt-4 flex flex-col h-full">
                <InputError :message="officeForm.errors.name" />
                <TextInput 
                    type="text"
                    class="w-full text-sm"
                    v-model="officeForm.name"
                    @handleRef="getInputElement"
                    @keypress="pressEnter"
                    :error="officeForm.errors.name"
                />

                <div class="mt-5 mb-2 ml-auto flex gap-2">
                    <SecondaryButton @click="$emit('handleCancel'), officeForm.reset()">
                        Cancel
                    </SecondaryButton>
                    <PrimaryButton @click="createRecord">
                        {{ (!isEdit?'Create':'Update') }}
                    </PrimaryButton>
                </div>
            </div>
        </div>

    </Modal>
</template>