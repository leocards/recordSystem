<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import { Head, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const storeLayout = useLayoutStore()

onMounted(() => {
    storeLayout.closeAside()
    storeLayout.selectedItem.reset()

    storeLayout.previousComponent = usePage().component
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        
    </AuthenticatedLayout>
</template>