<template>
    <Transition
        enter-active-class="ease-in duration-150 delay-200"
        enter-from-class="translate-x-1/2 opacity-0"
        enter-to-class="translate-x-0 opacity-100"
        leave-active-class="ease-out duration-150 absolute top-[3.5rem] h-[calc(100vh-11.75rem)] w-full"
        leave-from-class="translate-x-0 opacity-100"
        leave-to-class="-translate-x-1/2 opacity-0"
    >
        <slot />
    </Transition>
</template>