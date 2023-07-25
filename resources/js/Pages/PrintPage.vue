<script setup>
import {ref, onMounted } from "vue"
import Table from "@/Components/Table.vue";

onMounted(() => {
    
})

const data = ref([
    {
        title: 'data 1',
        rate: 4,
        children: [
            {
                title: 'sub data 1',
                rate: 4,
                children: [
                    {
                        title: 'sub data 1',
                        rate: 4,
                        children: [
                                            {
                                title: 'sub data 1',
                                rate: 4,
                                children: [
                                    
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    },
    {
        title: 'data 2',
        rate: 4,
        children: [
            {
                title: 'sub data 2',
                rate: 4,
                children: [
                    {
                        title: 'sub data 2',
                        rate: 4,
                        children: [
                                            {
                                title: 'sub data 2',
                                rate: 4,
                                children: [
                                    
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    },
    
])

</script>

<template>
    <div>
        
    </div>
</template>