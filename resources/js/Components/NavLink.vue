<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out bg-green-700 text-white green-700'
        : `inline-flex items-center px-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 dark:text-neutral-300/90
        focus:border-gray-300 transition duration-150 ease-in-out hover:bg-gray-100 dark:hover:bg-neutral-800`
);
</script>

<template>
    <Link :href="href" :class="classes" class="lg:w-full w-12 lg:px-3 lg:h-10 h-12 shrink-0 rounded-xl lg:justify-normal justify-center" data-button>
        <slot />
    </Link>
</template>
