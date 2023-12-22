<template>
    <div v-if="isImage"  @click="select"
        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80 border-dashed border-2 border-sky-500">
        <template v-if="image.url && !showLocked">
            <img :src="image.url" alt="Asset Image." style="height: -webkit-fill-available;"
                 class="h-full mx-auto  bg-gray-700 dark:bg-gray-300" :id="`image-${image.url}`"
                 @load="; imageLoading = false; getDimensions()"
                 @error="showLocked = true"
            >
            <div class="" v-if="imageLoading">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class='flex space-x-2 justify-center items-center'>
                        <span class='sr-only'>Loading...</span>
                        <div class='h-8 w-8 bg-gray-600 rounded-full animate-bounce [animation-delay:-0.3s]'></div>
                        <div class='h-8 w-8 bg-gray-600 rounded-full animate-bounce [animation-delay:-0.15s]'></div>
                        <div class='h-8 w-8 bg-gray-600 rounded-full animate-bounce'></div>
                    </div>
                </div>
            </div>
        </template>


        <div v-else class="aspect-h-1">
            <LockClosedIcon></LockClosedIcon>
        </div>
    </div>
    <div v-else class="aspect-h-1"  @click="select">
        <DocumentIcon class="dark:fill-white"></DocumentIcon>
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
import {LockClosedIcon, DocumentIcon} from "@heroicons/vue/24/outline/index.js";

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
const imageLoading = ref(true)

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
const showLocked = ref(false)
</script>
