<script setup>

const props = defineProps({
    withText: {
        type: Boolean,
        default: true
    }
})

</script>

<template>
    <div class="text-[10px] 3xl:text-sm font-medium w-fit mx-auto text-[#287a56]">
        <div class="flex items-center justify-between">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <span v-if="withText">LOADING</span>
    </div>
</template>
  
<style scoped>
    .bounce1,
    .bounce2,
    .bounce3 {
        width: 10px;
        height: 10px;
        background-color: #15a868;
        border-radius: 50%;
        margin: 2px;
        animation: bounce 1s infinite ease-in-out;
    }
    
    .bounce1 {
        animation-delay: -0.32s;
    }
    
    .bounce2 {
        animation-delay: -0.16s;
    }
    
    @keyframes bounce {
        0%,
        80%,
        100% {
            transform: scale(0);
        }
        40% {
            transform: scale(1);
        }
    }
</style>