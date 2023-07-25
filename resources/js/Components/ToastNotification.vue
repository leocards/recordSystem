<script setup>
import { useLayoutStore } from '@/Store/LayoutStore';
import NotificationCard from '@/Components/NotificationCard.vue'

const storeLayout = useLayoutStore()

/* storeLayout.notifications.push(
    {
        state: null,
        message: 'null',
        link: null,
        timeClose: 5
    },
    {
        state: null,
        message: 'null',
        link: null,
        timeClose: 4
    },
    {
        state: null,
        message: 'null',
        link: null,
        timeClose: 2
    }
)

const close = (notif, index) => {
    let timeout = notif.timeClose * 1000

    setTimeout(() => {
        storeLayout.notifications.splice(index, 1)
    }, timeout)
}
storeLayout.notifications.push(
        {
            state: null,
            message: 'null',
            link: null,
            timeClose: 5,
            show: true
        }
    )
setTimeout(() => {
    
}, 2000)
 */
</script>

<template>
    <Teleport to="body" v-if="false">
        <div class="absolute top-5 right-0">
            <NotificationCard v-for="(item, index) in storeLayout.notifications" :key="index" :notif="item" :index="index" />
        </div>
    </Teleport>
</template>