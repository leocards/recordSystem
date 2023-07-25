<script setup>
import { ref } from 'vue';
import ContextMenu from '@/Components/ContextMenu.vue';
import TopMenu from '@/Components/Navigations/TopMenu.vue';
import SideNavigation from '@/Components/Navigations/Side.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useLayoutStore } from '@/Store/LayoutStore'
import { onUnmounted } from 'vue';
import { onMounted } from 'vue';
import ToastNotification from '@/Components/ToastNotification.vue';
import Asides from '@/Components/Aside/Asides.vue';
import Hamburger from '@/Components/Buttons/Hamburger.vue';
import TopNavigation from '@/Components/Navigations/TopNavigation.vue';
import SearchDocuments from '@/Components/Documents/Search.vue';
import Notifications from '@/Components/Aside/SideModals/Notifications.vue';
import ChatSidePannel from '@/Components/Chat/ChatSidePannel.vue';
import ChatContainer from '@/Components/Chat/ChatContainer.vue';
import Messages from '@/Components/Chat/Messages.vue';
import PageLoading from '@/Components/PageLoading.vue';
import { resizedElement } from '@/Store/JS/windowElement'

const storeLayout = useLayoutStore()
const emits = defineEmits([
    'handleClick',
    'handleContextmenu',
    'handleGetMainSize',
    'comments',
    'edit',
    'track'
])

let mainContent = null;
const main = ref(null)
const newChat = ref(false)
const openSide = ref(false)
const showSideModal = ref(null)
const showingNavigationDropdown = ref(false);

const isSearchDocument = ref(false)

const clicksOutside = e => {
    emits('handleClick', e)
}
const onContextMenu = e => {
    emits('handleContextmenu', e)
}

onMounted(() => {
    mainContent = main.value
    window.addEventListener('contextmenu', storeLayout.preventDefaults)
    resizedElement(main.value, () => {
        emits('handleGetMainSize', mainContent.offsetWidth)
    })

    window.addEventListener("click", e => {
        if(!showSideModal.value && e.target.closest('.notif_mess') && !e.target.closest('.notifCloseBtn')){
            showSideModal.value = showSideModal.value
        } else if (showSideModal.value && !e.target.closest('.notif_mess') && !e.target.closest('.notifCloseBtn')){
            showSideModal.value = null
        }
    })

})

onUnmounted(()=>{
    window.removeEventListener('contextmenu', storeLayout.preventDefaults)
})

</script>

<template>
    <div class="h-screen overflow-auto -hidden" @click="clicksOutside">
        <div :class="{'mr-16':newChat}">
            <nav class="">
                <!-- Primary Navigation Menu -->
                <div class=" mx-auto px-4">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>
                        </div>

                        <TopNavigation />

                        <div class="hidden sm:flex sm:items-center">
                            <TopMenu 
                                @handleSearch="isSearchDocument = !isSearchDocument" 
                                @handleNotification="showSideModal = 'notif'"
                                @handleMessage="showSideModal = 'message'"
                            />
                        </div>

                        <!-- Hamburger -->
                        <Hamburger :menu="showingNavigationDropdown" @button-click="showingNavigationDropdown = !showingNavigationDropdown" />
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="height flex">
                <!-- Side navigation -->
                <SideNavigation :winSize="storeLayout.windowSize" />
                <!-- end of Side navigation -->

                <div class="flex flex-col grow height main_bg shadow-insetShadow" :class="[newChat?'md:rounded-t-2xl':'md:rounded-tl-2xl']">
                    <header class="z-10" v-if="$slots.header">
                        <div class="flex items-center justify-between mx-auto h-14 px-3 text-green-300">
                            <div>
                                <slot name="header" />
                            </div>
                            
                        </div>
                    </header>

                    <!-- Main -->
                    <div class="flex sm:px-3">
                        <div class="flex flex-col grow overflow-hidden bg-white dark-bg rounded-2xl h-[calc(100vh-8.2rem)]" ref="main">
                            <!-- Content header -->
                            <div class="px-2 h-12 shrink-0 flex items-center mb-4 mt-2" data-content v-if="$slots.contentHeader">
                                <slot name="contentHeader" />
                            </div>
                            <!--end of Content header -->

                            <!-- Contents -->
                            <div class="overflow-y-auto grow p-2 relative" :class="{'pt-0':$slots.contentHeader}" id="__content" @contextmenu="onContextMenu">
                                <slot />
                            </div>
                            <!-- end of Contents -->
                        </div>

                        <Asides />
                    </div>
                    
                </div>
            </main>
        </div>
    </div>

    <ContextMenu 
        @comments="$emit('comments')"
        @edit="$emit('edit')"
        @track="$emit('track')"
    />

    <SearchDocuments
        :show="isSearchDocument" 
        :mainSize="mainContent?mainContent.offsetWidth:null"
        @handleClose="isSearchDocument = false"
    />

    <Notifications
        :showNotification="(showSideModal == 'notif')"
        @handleClose="showSideModal = null"
    />

    <Messages 
        :show-messages="(showSideModal == 'message')"
        @handleClose="showSideModal = null"
    />

    <ChatSidePannel 
        v-if="newChat"
        @handleClose="newChat = false"
    />

    <ChatContainer 
        :open="newChat"
    />

    <ToastNotification />
    
    <PageLoading />

</template>

<style scoped>
.height {
    @apply h-[calc(100vh-4rem)]
}
.main_bg {
    @apply sm:bg-slate-400/10 sm:dark:bg-neutral-800
}

.aside-leave-active,
.aside-enter-active {
    transition: 0.2s ease;
}

.aside-enter-from {
    width: 0rem;
    opacity: 0;
}
.aside-leave-from {
    width: 22.5rem;
    opacity: 1;
}

.aside-enter-to {
    width: 22.5rem;
    opacity: 1;
}
.aside-leave-to {
    width: 0rem;
    opacity: 0;
}
</style>
