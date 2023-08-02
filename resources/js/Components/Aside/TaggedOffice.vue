<script setup>
import AsideContents from './AsideContents.vue';
import OfficeFill from '../Icon/OfficeFill.vue';
import Empty from './Empty.vue';
import New from '../Buttons/New.vue';
import NewIcon from '../Icon/New.vue';
import { ref } from 'vue';
import { __conditioned_array } from '@/Store/JS/Arrays'
import { onBeforeMount } from 'vue';
import { watchEffect } from 'vue';
import TaggedCard from './TagOffice/TaggedCard.vue';
import LoadingAnimation from '../LoadingAnimation.vue';

const props = defineProps({
    record: Object,
    added: Object
})

const emits = defineEmits([
    'handleAdd',
    'handleExcludes'
])

const tagged = ref(null)

const removeOffice = index => {
    tagged.value.splice(index, 1)
}

onBeforeMount(() => {
    watchEffect(() => {
        if(props.record){
            tagged.value = null

            axios.get(route('or_taaged_office', [props.record.id]))
            .then(res => {
                let response = res.data
                tagged.value = response

                let newRes = response.map(({id}) => {
                    return id
                })

                emits('handleExcludes', newRes)
            })
        }
    })
})

watchEffect(() => {
    if(props.added.hasNew) {
        tagged.value.push(...props.added.new)
    }
})

</script>

<template>
    <AsideContents>
        <template #subheader>
            <div class="text-sm">Tagged Office</div>

            <New 
                :class="'pointer-events-auto gr ow justify-center'"
                margin="ml-auto"
                :mainSize="948"
                label="Add"
                fit="capsule-fit py-[0.400rem]"
                @click="$emit('handleAdd')"
            >
                <NewIcon />
            </New>
        </template>
        <div class="pointer-events-none text-sm flex flex-col grow">
            <div class="w-full rounded-lg bg-gray-100 min-h-[3.5rem] overflow-hidden p-1" v-if="false">
                <div class="flex">
                    <div class="ring-1 grow">
                        Office of the Vice President
                    </div>
                    <div class="w-6">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-gray-100 overflow-hidden" v-if="tagged && __conditioned_array(tagged, '>', 0)">
                
                <TaggedCard :lastItem="index !== tagged.length-1"  v-for="(item, index) in tagged" :index="index" :item="item" @removeOffice="removeOffice" />

            </div>

            <Empty
                label="No office added"
                v-if="Array.isArray(tagged) ? tagged.length == 0 : false"
            >
                <OfficeFill size="max2" />
            </Empty>

            <div class="my-auto" v-if="!tagged">
                <LoadingAnimation />
            </div>
        </div>
    </AsideContents>
</template>