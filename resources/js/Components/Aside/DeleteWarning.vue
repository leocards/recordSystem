<script setup>
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/Buttons/DangerButton.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';

const storeLayout = useLayoutStore()

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    removeType: {
        type: String,
        default: 'office'
    },
    name: String
})

const emits = defineEmits([
    'handleRemove',
    'handleCancel',
])

</script>

<template>
    <Modal
        :show="show"
        maxWidth="md"
        center
    >
        
        <div class="p-4 flex flex-col text-sm">
            <h4>Remove {{ removeType }}</h4>

            <div class="my-4">
                Do you want to remove access to <span class="font-medium">{{ storeLayout.selectedItem.item.name }}</span> for <span class="font-medium">{{ name }}</span>?
            </div>

            <div class="flex ml-auto mt-4">
                <SecondaryButton
                    @click="$emit('handleCancel')"
                >
                    Cancel
                </SecondaryButton>
                <DangerButton
                    class="ml-3"
                    @click="$emit('handleRemove')"
                >
                    Remove
                </DangerButton>
            </div>
        </div>

    </Modal>
</template>