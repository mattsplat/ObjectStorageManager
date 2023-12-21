<template>
    <div v-if="isImage"
        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80 border-dashed border-2 border-sky-500">
        <img :src="image.url" alt="Asset Image." @click="select"
             class="h-full mx-auto object-cover object-center bg-gray-700 dark:bg-gray-300" :id="`image-${image.url}`" @load="getDimensions">
    </div>
    <div v-else class="aspect-h-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="fill-slate-700 dark:fill-slate-200 ">
            <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/>
        </svg>
    </div>
    <div class="mt-4 flex justify-between">
        <div>
            <span class="mt-1 mr-2 text-sm text-blue-500" >
                {{ image.path?.split('/').pop() }}
            </span>
            <span v-if="dimensions.width" class="text-sm text-gray-400">{{ dimensions.width }}x{{ dimensions.height }}</span>
        </div>
    </div>
</template>

<script setup>
import {computed, defineProps, inject, ref} from 'vue'

const emit = defineEmits(['selected'])
const props = defineProps({
    image: {
        type: Object,
        required: true
    },
    errors: {
        type: Object,
        default: () => ({})
    }
})
const fileExtension = ref(props.image.path.split('.').pop())
const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']
const isImage = computed(() => {
    return imageExtensions.includes(fileExtension.value)
})

const dimensions = ref({})
const getDimensions = () => {
    if (!props.image.url) return
    const image = document.getElementById(`image-${props.image.url}`)
    if (!image) return
    dimensions.value = {
        width: image.naturalWidth,
        height: image.naturalHeight
    }
}
const select = () => {
    emit('selected')
}
</script>
