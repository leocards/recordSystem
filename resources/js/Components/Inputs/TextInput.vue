<script setup>
import { onMounted, ref, computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    error: {
        type: String,
        default: null
    },
    height: {
        trype: String,
        default: 'md'
    }
});

const emits = defineEmits(['update:modelValue', 'handleRef']);

const input = ref(null);

const inputHeight = computed(() => {
    return {
        xs: 'h-9',
        sm: 'h-10',
        md: 'h-11',
        lg: 'h-12',
    }[props.height];
});

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
    emits('handleRef', input.value)
});

defineExpose({ focus: () => input.value.focus() });

</script>

<template>
    <input
        class="rounded-xl shadow- sm text-sm"
        :class="[error?'error':'border-gray-300 focus:border-green-500 focus:ring-green-600 bg-gray-100/40'], inputHeight"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<style scoped>

.error {
    @apply border-red-400 focus:border-red-500 focus:ring-red-600 bg-pink-100/20
}

</style>
