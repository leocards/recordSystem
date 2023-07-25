<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Profile from '../Icon/Profile.vue';
import SearchIcon from '../Icon/Search.vue';
import Message from '../Icon/Message.vue';
import MessageFill from '../Icon/MessageFill.vue';
import Notification from '../Icon/Notification.vue';
import NotificationFill from '../Icon/NotificationFill.vue';


const emits = defineEmits([
    'handleSearch',
    'handleNotification',
    'handleMessage'
])

</script>

<template>
    <button class="mx-1 rounded-full p-2.5 md:w-28 flex items-center justify-center rin-1 ring-inset hover:shadow-insetShadow
        ring-slate-700/20 hover:ring-green-700/70 active:text-white active:bg-green-700 /20 hover:bg-gray-100 transition duration-200" 
        data-button
        @click="$emit('handleSearch')"
    >
        <SearchIcon  /> <span class="text-sm ml-2 pointer-events-none">Search</span>
    </button>

    <button 
        class="notif_mess p-2.5 ml-1 hover:bg-gray-100 rounded-full relative active:text-white active:bg-green-700 transition duration-200 hover:shadow-insetShadow"
        data-button
        @click="$emit('handleMessage')"
    >
        <Message v-if="true" />
        <MessageFill v-else />
        <span class="pointer-events-none"></span>
        <span class="absolute top-2 right-2 flex h-3 w-3 pointer-events-none">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#15a868] ring-[1.5px] ring-white"></span>
        </span>
    </button>

    <button 
        class="notif_mess p-2.5 mx-1 mr-1.5 hover:bg-gray-100 rounded-full relative active:text-white active:bg-green-700 transition duration-200 hover:shadow-insetShadow"
        data-button
        @click="$emit('handleNotification')"
    >
        <Notification v-if="true" />
        <NotificationFill v-else />
        <span class="pointer-events-none"></span>
        <span class="absolute top-2 right-2 flex h-3 w-3 pointer-events-none">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-500 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-700 ring-[1.5px] ring-white"></span>
        </span>
    </button>

    <!-- Settings Dropdown -->
    <div class="relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <span class="inline-flex rounded-md">
                    <button
                        data-button
                        type="button"
                        class="inline-flex items-center p-1.5 border border-transparent text-sm leading-4 font-medium rounded-full hover:bg-gray-200 text-gray-500 bg-gray-100 hover:text-gray-700 
                        focus:outline-none transition ease-in-out duration-150 grou transition-200 shadow-insetShadow"
                    >
                        <div class="w-8 h-8 r ing-1 ring-slate-400 group-hover:ring-slate-600 rounded-full
                        flex items-center justify-center group-hover:text-green-700 text-green-700/80 bg-green-700/20 pointer-events-none">
                            <Profile size="sm" :stroke="1.7" />
                        </div>
                        <div class="md:block hidden text-sm ml-2 Oneline pointer-events-none">
                            {{ $page.props.auth.user.name }}
                        </div>
                    </button>
                </span>
            </template>
            <template #content>
                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                </DropdownLink>
            </template>
        </Dropdown>
    </div>
</template>