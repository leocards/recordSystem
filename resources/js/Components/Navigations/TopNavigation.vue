<script setup>
import Office from '../Icon/Office.vue';
import OfficeFill from '../Icon/OfficeFill.vue';
import Records from '../Icon/Records.vue';
import RecordsFill from '../Icon/RecordsFill.vue';
import Documents from '../Icon/Documents.vue';
import DocumentsFill from '../Icon/DocumentsFill.vue';
import Dashboard from '../Icon/Dashboard.vue';
import DashboardFill from '../Icon/DashboardFill.vue';
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <div class="max_md:flex hidden items-center px-2 gap-1">
        <Link :href="route('dashboard')"
            class="flex flex-col items-center justify-center gap-1 rounded-lg w-20 py-1.5 relative h-11"
            :class="[$page.url.startsWith('/dashboard')?'text-white bg-green-700':'text-gray-500 hover:bg-gray-100']"
        >
            <Dashboard v-if="!$page.url.startsWith('/dashboard')" />
            <DashboardFill v-else />
            <div class="text-sm font-medium absolute top-12 p-2 ring-1 w-fit rounded-md text-center">Dashboard</div>
        </Link>

        <Link :href="route('offices')"
            class="flex flex-col items-center justify-center gap-1 rounded-lg w-20 py-1.5 relative h-11"
            :class="[$page.url.startsWith('/offices')?'text-white bg-green-700':'text-gray-500 hover:bg-gray-100']"
        >
            <Office v-if="!$page.url.startsWith('/offices')" />
            <OfficeFill v-else />
            <div class="text-sm font-medium absolute top-12 p-2 ring-1 w-fit rounded-md text-center">Offices</div>
        </Link>

        <Link :href="route('records')"
            class="flex flex-col items-center justify-center gap-1 rounded-lg w-20 py-1.5 relative h-11"
            :class="[$page.url.startsWith('/records')?'text-white bg-green-700':'text-gray-500 hover:bg-gray-100']"
        >
            <Records v-if="!$page.url.startsWith('/records')" />
            <RecordsFill v-else />
            <div class="text-sm font-medium absolute top-12 p-2 ring-1 w-fit rounded-md text-center">Records</div>
        </Link>

        <Link :href="route('documents')"
            class="flex flex-col items-center justify-center gap-1 rounded-lg w-20 py-1.5 relative h-11"
            :class="[$page.url.startsWith('/documents')?'text-white bg-green-700':'text-gray-500 hover:bg-gray-100']"
        >
            <Documents v-if="!$page.url.startsWith('/documents')" />
            <DocumentsFill v-else />
            <div class="text-sm font-medium absolute top-12 p-2 ring-1 w-fit rounded-md text-center">Documents</div>
        </Link>
    </div>
</template>