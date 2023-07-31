<script setup>
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watchEffect, nextTick } from 'vue';
import InputError from '@/Components/Inputs/InputError.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import { useLayoutStore } from '@/Store/LayoutStore';

const storeLayout = useLayoutStore(); //access pinia store
const page = usePage().props // access page props

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
})

const emits = defineEmits([
    'handleCancel',
    'handleCreate'
])

const record = ref(null)
const recordForm = useForm({
    id: null,
    name: 'Untitled record',
    parent: null
})

//create records route and update
const createRecord = () => {
    if(!props.isEdit){
        recordForm.post(route('records.new'), {
            preserveScroll: true,
            onSuccess: page => {
                emits('handleCreate')
            }
        });
    }else 
        recordForm.post(route('records.update', recordForm.id), {
            preserveScroll: true,
            onSuccess: page => {
                if(storeLayout.selectedItem.item)
                   storeLayout.selectedItem.item.name =  recordForm.name
                emits('handleCreate')
            }
        });
}

//get the input form 
const getInputElement = el => {
    record.value = el
}
const pressEnter = e => {
    if(e.keyCode === 13 && !recordForm.errors.name)
        createRecord()
    else {
        recordForm.errors.name = null
    }
}

watchEffect(() => {
    if(props.show) {
        nextTick(() => {
            record.value.focus()
            record.value.setSelectionRange(0, recordForm.name.length)
        })

        if(props.isEdit) {
            recordForm.id = storeLayout.selectedItem.item.id
            recordForm.name = storeLayout.selectedItem.item.name
        }
        if (page.current) {
            recordForm.parent = page.current.id
        }
    }else {
        recordForm.clearErrors()
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

            <div class="text-lg"><span v-text="(!isEdit?'New':'Update')"></span> record</div>

            <div class="mt-4 flex flex-col h-full">
                <InputError :message="recordForm.errors.name" />
                <TextInput 
                    type="text"
                    class="w-full text-sm"
                    v-model="recordForm.name"
                    @handleRef="getInputElement"
                    @keyup="pressEnter"
                    :error="recordForm.errors.name"
                />

                <div class="mt-5 mb-2 ml-auto flex gap-2">
                    <SecondaryButton @click="$emit('handleCancel'), recordForm.reset()" :disabled="recordForm.processing">
                        Cancel
                    </SecondaryButton>
                    <PrimaryButton @click="createRecord" :disabled="recordForm.processing || recordForm.errors.name || recordForm.name.trim() === ''">
                        {{ (!isEdit?'Create':'Update') }}
                    </PrimaryButton>
                </div>
            </div>
        </div>

    </Modal>

</template>