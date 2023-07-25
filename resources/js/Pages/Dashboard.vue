<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useLayoutStore } from '@/Store/LayoutStore';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const storeLayout = useLayoutStore()

onMounted(() => {
    storeLayout.closeAside()
    storeLayout.selectedItem.reset()
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="p-3">
            <div class="max-w- 4xl w-full rounded-lg h-36 sm:h-60 overflow-hidden relative shadow">
                <img src="../../../public//files/DNSC_thumbnail.png" class="object-cover w-full h-full opacity-40">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-emerald-800 to-yellow-200/70 opacity-60 z-10" ></div>
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-tr from-emerald-800 opacity-60 z-10" ></div>
                <div class="absolute top-0 left-0 w-full h-full z-20 flex flex-col p-3 justify-center">
                    <div class="h-10 flex items-center"><span class="sm:text-2xl text-xl text-white font-bold uppercase">welcome</span> <span class=" text-white sm:text-xl text-lg font-semibold ml-3">Leomas</span> </div>
                    <div class="flex items-center"><span class="sm:text-5xl text-3xl text-white font-bold uppercase">Rekords</span></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
