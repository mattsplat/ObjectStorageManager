<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <form>
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">{{props.disk?.id ? 'Update ': 'Save '}} Disk</h2>
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.name" type="text" name="name" id="name"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="key" class="block text-sm font-medium leading-6 text-gray-900">Key</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.key" type="text" name="key" id="key"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-6">
                                            <label for="secret"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Secret</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.secret" type="text" name="secret" id="secret"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="region"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Region</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.region" type="text" name="region" id="region"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="bucket"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Bucket</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.bucket" type="text" name="bucket" id="bucket"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="folder"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Folder</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.folder" type="text" name="folder" id="folder"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="url"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Url</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.url" type="text" name="url" id="url"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="sm:col-span-6">
                                            <label for="endpoint"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Endpoint</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.endpoint" type="text" name="endpoint" id="endpoint"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="New Laravel Disk">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <div class="flex items-center mb-4">
                                                <input id="use_path_style_endpoint" type="checkbox" v-model="disk.use_path_style_endpoint" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="use_path_style_endpoint" class="ms-2 text-sm font-medium text-gray-900">Use Path Style Endpoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" class="text-sm font-semibold leading-6 text-gray-900"
                                        @click="close">Cancel
                                </button>
                                <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click.prevent="saveDisk"
                                >Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref, defineEmits} from 'vue'
import {useToast} from "vue-toastification";


const toast = useToast();
const props = defineProps({
    disk: {
        type: Object,
        default: null
    }
})

const name = ref('')
const path = ref('')

const emit = defineEmits(['update', 'close'])

const disk = ref({
    driver: props.disk?.driver ?? "s3",
    name: props.disk?.name ?? "",
    key: props.disk?.key ?? "",
    secret:  props.disk?.secret ?? "",
    region: props.disk?.region ?? "",
    bucket: props.disk?.bucket ?? "",
    folder: props.disk?.folder ?? "",
    cdn_endpoint: props.disk?.cdn_endpoint ?? "",
    url: props.disk?.url ?? "",
    endpoint: props.disk?.endpoint ?? "",
    use_path_style_endpoint: props.disk?.use_path_style_endpoint ?? "",
})

const saveDisk = () => {
    let method = 'post'
    let url = '/api/disk'
    if (props.disk && props.disk?.id) {
        method = 'put'
        url = '/api/disk/' + props.disk.id
    }
    axios(url, {
        method: method,
        data: disk.value
    } ).then(response => {
        console.log(response.data)
        toast.success('Disk saved successfully')
        emit('update', response.data)
        close()
    }).catch(error => {
        toast.error('Something went wrong ' + error.response.data)
        console.log(error)
    })
}

const openFileDialog = async () => {
    axios('/api/dashboard/get-path').then(response => {
        console.log(response.data)
        path.value = response.data
    }).catch(error => {
        console.log(error)
    })
}

const close = () => {
    emit('close')
}

</script>

<style scoped>

</style>
