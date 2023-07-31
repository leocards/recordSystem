<script setup>
import Office from '@/Components/Icon/Office.vue';
import OfficeFill from '@/Components/Icon/OfficeFill.vue';
import Records from '@/Components/Icon/Records.vue';
import RecordsFill from '@/Components/Icon/RecordsFill.vue';
import Documents from '@/Components/Icon/Documents.vue';
import DocumentsFill from '@/Components/Icon/DocumentsFill.vue';
import Dashboard from '@/Components/Icon/Dashboard.vue';
import DashboardFill from '@/Components/Icon/DashboardFill.vue';
import NavLink from '@/Components/NavLink.vue';
import Pinned from '@/Components/Buttons/Pinned.vue';
import PinnedDocuments from './PinnedDocuments.vue';
import { ref } from 'vue';
import User from '@/Components/Icon/User.vue';
import UserFill from '@/Components/Icon/UserFill.vue';


const props = defineProps({
    winSize: Number
})

const isShowPinned = ref(false)
const array = ref([])

</script>

<template>
    <div class="hidden md:flex flex-col gap-1.5 md:w-[5rem] md:items-center lg:w-[14.5rem] shrink-0 h-full lg:overflow-y-auto py-2 px-2">
        <NavLink :href="route('dashboard')" :active="$page.url.startsWith('/dashboard')" class="mt-3 relative group link">
            <div class="flex items-center gap-2 lg:mx-2 pointer-events-none">
                <span :class="{ 'text-slate-50':$page.url.startsWith('/dashboard') }">
                    <Dashboard v-if="!$page.url.startsWith('/dashboard')"/>
                    <DashboardFill v-else />
                </span>
                <div class="sideLabel">Dashboard</div>
            </div>
        </NavLink>
        <NavLink :href="route('offices')" :active="$page.url.startsWith('/offices')" class="relative group link">
            <div class="flex items-center gap-2 lg:mx-2 pointer-events-none">
                <span :class="{ 'text-slate-50':$page.url.startsWith('/offices') }">
                    <Office v-if="!$page.url.startsWith('/offices')"/>
                    <OfficeFill v-else/>
                </span>
                <div class="sideLabel">Offices</div>
            </div>
        </NavLink>
        <NavLink :href="route('records')" :active="$page.url.startsWith('/records')" class="relative group link">
            <div class="flex items-center gap-2 lg:mx-2 pointer-events-none">
                <span :class="{ 'text-slate-50':$page.url.startsWith('/records') }">
                    <Records v-if="!$page.url.startsWith('/records')"/>
                    <RecordsFill v-else/>
                </span>
                <div class="sideLabel">Records</div>
            </div>
        </NavLink>
        <NavLink :href="route('documents')" :active="$page.url.startsWith('/documents')" class="relative group link">
            <div class="flex items-center gap-2 lg:mx-2 pointer-events-none">
                <span :class="{ 'text-slate-50':$page.url.startsWith('/documents') }">
                    <Documents v-if="!$page.url.startsWith('/documents')"/>
                    <DocumentsFill v-else/>
                </span>
                <div class="sideLabel">Documents</div>
            </div>
        </NavLink>
        <NavLink :href="route('users')" :active="$page.url.startsWith('/users')" class="relative group link">
            <div class="flex items-center gap-2 lg:mx-2 pointer-events-none">
                <span :class="{ 'text-slate-50':$page.url.startsWith('/users') }">
                    <User v-if="!$page.url.startsWith('/users')"/>
                    <UserFill v-else/>
                </span>
                <div class="sideLabel">Users</div>
            </div>
        </NavLink>

        <div class="grow lg:overflow-y-auto w-full pt-3 text-sm border-t-2 border-gray-200 mt-3 flex-col flex px-1" v-show="array.length > 0">
            <Pinned :active="isShowPinned" @click="isShowPinned = !isShowPinned" />

            <PinnedDocuments :winSize="winSize" :isShowPinned="isShowPinned" />
        </div>
    </div>
</template>

<style scoped>
::-webkit-scrollbar {
    @apply bg-transparent w-[7px] !important
}
.sideLabel {
    @apply  whitespace-nowrap lg:block lg:relative lg:top-0 lg:-translate-y-0 lg:left-0 lg:bg-transparent absolute top-[50%] -translate-y-[50%] left-14 bg-gray-700 px-2 py-1 
        rounded z-20 pointer-events-none max_lg:group-hover:text-white group-hover:block hidden 
}

.sideLabel::before {
    @apply max_lg:content-[''] max_lg:absolute top-1/2 -translate-y-1/2 border-t-[10px] border-t-transparent -left-1.5
    border-r-[10px] border-r-gray-700
    border-b-[10px] border-b-transparent;

    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

</style>