<template>
    <TransitionRoot as="template" :show="true">
        <Dialog as="div" class="relative z-10" @close="close">
            <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                             enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100"
                             leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <TransitionChild as="template"
                                         enter="transform transition ease-in-out duration-500 sm:duration-700"
                                         enter-from="translate-x-full" enter-to="translate-x-0"
                                         leave="transform transition ease-in-out duration-500 sm:duration-700"
                                         leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto relative " :style="{'width': drawerWidth + 'px'}">
                                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                                                 enter-to="opacity-100" leave="ease-in-out duration-500"
                                                 leave-from="opacity-100" leave-to="opacity-0">
                                    <div class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
                                        <button type="button"
                                                class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                @click="close">
                                            <span class="absolute -inset-2.5"/>
                                            <span class="sr-only">Close panel</span>
                                            <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                        </button>
                                    </div>
                                </TransitionChild>
                                <div class="h-full overflow-y-auto bg-white p-8">
                                    <div class="space-y-6 pb-16">
                                        <div>
                                            <div
                                                class="aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-200 rounded-md"
                                            >
                                                <img
                                                    v-if="isImage"
                                                    :src="publicUrl"
                                                    :id="`image-${props.file.path}-drawer`"
                                                    @load="getDimensions"
                                                    alt="" class="object-scale-down"/>
                                                <div v-else class="">
                                                    <DocumentIcon class="h-48 m-auto"></DocumentIcon>
                                                </div>
                                            </div>

                                            <div class="mt-4 flex items-start justify-between">
                                                <div>
                                                    <h2 class="text-base font-semibold leading-6 text-gray-900"><span
                                                        class="sr-only">Details for </span>{{ file.path?.split('/').pop() }}
                                                    </h2>
                                                </div>
                                                <p class="text-sm font-medium text-gray-500">
                                                    {{ (file.file_size / 1024).toFixed(2) }} KB
                                                </p>
                                                <p class="text-sm font-medium text-gray-500" v-if="dimensions.width">
                                                    {{ dimensions.width }} x {{ dimensions.height }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Information</h3>
                                            <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                <div class="flex justify-between py-3 text-sm font-medium">
                                                    <dt class="text-gray-500">Last Modified</dt>
                                                    <dd class="text-gray-900">
                                                        {{ new Date(file.last_modified * 1000).toLocaleString() }}
                                                    </dd>
                                                </div>
                                            </dl>
                                            <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                <div class="flex justify-between py-3 text-sm font-medium">
                                                    <dt class="text-gray-500">Link</dt>
                                                    <dd class="text-blue-500">
                                                        <a :href="file.url" target="_blank"
                                                           rel="noopener noreferrer">{{ file.url }}</a>
                                                    </dd>
                                                </div>
                                            </dl>
                                            <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                <div class="flex justify-between py-3 text-sm font-medium">
                                                    <dt class="text-gray-500">Visibility</dt>
                                                    <dd class="text-gray-500">
                                                        {{ fileMeta.visibility }}
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                        <div class="flex">
                                            <button type="button" @click="downloadFile"
                                                    class="flex-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                Download
                                            </button>
                                            <button type="button" @click="deleteFile"
                                                    class="ml-3 flex-1 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>


<script setup>
import {computed, onMounted, ref} from 'vue'
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {HeartIcon, XMarkIcon, DocumentIcon} from '@heroicons/vue/24/outline'
import {PencilIcon, PlusIcon} from '@heroicons/vue/20/solid'

const emit = defineEmits(['close', 'update'])
const close = () => {
    emit('close')
}
const props = defineProps({
    file: {
        type: Object,
        required: true
    },
    disk: {
        type: Object,
        required: true
    }
})

const windowWidth = (window.outerWidth)
const drawerRatio = 0.8
const drawerWidth = computed(() => {
    return Math.floor(windowWidth * drawerRatio)
})

const fileName = props.file?.path?.split('/').pop()
const fileExtension = ref(props.file?.path?.split('.').pop() ?? null)
const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']
const isImage = computed(() => {
    return imageExtensions.includes(fileExtension.value)
})
const fileMeta = ref({})

const dimensions = ref({})
const getDimensions = () => {
    if (!props.file.url || !isImage) return
    const image = document.getElementById(`image-${props.file.path}-drawer`)
    if (!image) {
        console.log('no image found for ' + `image-${props.file.path}-drawer`)
        return
    }
    dimensions.value = {
        width: image.naturalWidth,
        height: image.naturalHeight
    }
}
// get url route
const getFileInfo = () => {
    if (!props.file.url) return
    axios.get(`/api/disk/${props.disk.id}/file/`, {
        params: {
            path: props.file.path,
        }
    }).then(response => {
        console.log(response.data)
        fileMeta.value = response.data
    }).catch(e => {
        console.log(e)
    })
}

const publicUrl = computed(() => {
    return fileMeta.value.url ?? props.file.url
})


onMounted(() => {
    getFileInfo()
})

const downloadFile = () => {
    axios.get(`/api/disk/${props.disk.id}/file/download`, {
        params: {
            path: props.file.path,
        }
    }).then(response => {
        console.log(response.data)
    }).catch(e => {
        console.log(e)
    })
}
const deleteFile = () => {
    if (!window.confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
        return
    }
    axios.delete(`/api/disk/${props.disk.id}/file/`, {
        params: {
            path: props.file.path,
        }
    }).then(response => {
        console.log(response.data)
        emit('update')
        close()
    }).catch(e => {
        console.log(e)
    })
}
</script>

<style scoped>

</style>
