<script setup>
import LoadingAnimation from "./LoadingAnimation.vue";
</script>

<template>
    <Teleport to="body">
        <Transition>
            <div
                class="fixed top-0 left-0 h-screen w-full bg-black/30 z-[600] inline-flex items-center justify-center"
                v-if="false"
            >
                <div class="rounded-3xl bg-white p-8 px-14 h-fit">
                    <LoadingAnimation />
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
