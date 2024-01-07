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
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                                        {{ props.disk?.id ? 'Update ' : 'Save ' }} Disk</h2>
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.name" type="text" name="name" id="name"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="Name of Disk">
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
                                                           placeholder="Key">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-6">
                                            <label for="secret"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Secret</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.secret" :type="passwordIsVisible ? 'text' : 'password'" name="secret" id="secret"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="Secret Key">
                                                    <div class="control">
                                                        <button class="button" @click.prevent="passwordIsVisible = !passwordIsVisible">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                                     width="18" viewBox="0 0 576 512" class="mt-2 mr-2">
                                                                    <path v-if="passwordIsVisible"
                                                                        d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"
                                                                    />
                                                                    <path v-else
                                                                        d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"
                                                                    />
                                                                </svg>
                                                              </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="region"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Region</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.region" type="text" name="region"
                                                           id="region"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="us-east-2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="bucket"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Bucket</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.bucket" type="text" name="bucket"
                                                           id="bucket"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="bucket-thing-name">
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
                                                           placeholder="">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="sm:col-span-6">
                                            <label for="endpoint"
                                                   class="block text-sm font-medium leading-6 text-gray-900">Endpoint</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input v-model="disk.endpoint" type="text" name="endpoint"
                                                           id="endpoint"
                                                           class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           placeholder="For S3 Compatible Systems">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <div class="flex items-center mb-4">
                                                <input id="use_path_style_endpoint" type="checkbox"
                                                       v-model="disk.use_path_style_endpoint"
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="use_path_style_endpoint"
                                                       class="ms-2 text-sm font-medium text-gray-900">
                                                    Use Path Style Endpoint
                                                </label>
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
    secret: props.disk?.secret ?? "",
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
    }).then(response => {
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
const passwordIsVisible = ref(false)
</script>

<style scoped>

</style>
