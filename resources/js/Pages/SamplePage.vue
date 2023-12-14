<template>
    <form>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Page HTML</label>
                        <div class="mt-2">
                            <button @click.prevent="copyPageHtmlToClipboard" class="text-white b">Copy Page HTML to Clipboard
                            </button>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Folder</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 "
                            >
                                <input :value="folder" disabled placeholder="Folder name"
                                         class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                >
                                <button @click.prevent="getFolder" class="text-white">Choose Folder
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Image File</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 "
                            >
                                <input :value="file" disabled placeholder="file name"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-1  text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                >
                                <button @click.prevent="getFile" class="text-white">Choose File
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Text Area</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <textarea v-model="clipboard" type="text" name="clipboard" id="clipboard"
                                          ref="clipboardField"
                                          class="block flex-1 border-0 focus:ring-0 bg-transparent py-1.5 pl-1 text-white placeholder:text-gray-400  sm:text-sm sm:leading-6"
                                          placeholder=""></textarea>

                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"
                             class="mt-2 ml-2"
                             v-if="clipboard"  fill="lightgray"
                             role="button"
                             @click="copyTextToClipboard(clipboard)"
                        >
                            <path d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
const folder = ref('')
const file = ref('')
const clipboard = ref('')
const clipboardField = ref(null)

const copyTextToClipboard = (text) => {
    axios.post('/ajax/native/clipboard', {
        type: 'text',
        data: text,
    }).then(response => {
        console.log(response)
    })
}


const getFolder = () => {
    axios.get('/ajax/native/dialog', {
        params: {
            folders: true,
        }
    }).then(response => {
        folder.value = response.data
    })
}

const getFile = () => {
    axios.get('/ajax/native/dialog', {
        params: {
            filters: {
                images: ['png', 'jpg', 'jpeg', 'gif', 'svg'],
            },
        }
    }).then(response => {
        file.value = response.data
    })
}

const copyPageHtmlToClipboard = () => {
    axios.post('/ajax/native/clipboard', {
        type: 'html',
        data: document.documentElement.outerHTML,
    }).then(response => {
        console.log(response)
    })
}

onMounted(() => {
    console.log('mounted')
    // const wsConnection = new WebSocket('ws://localhost:6001/')
    // wsConnection.onmessage = (event) => {
    //     console.log(event)
    // }
    // wsConnection.onopen = (event) => {
    //     console.log(event)
    // }
    // wsConnection.onerror = (event) => {
    //     console.log(event)
    // }

})
</script>

<style scoped>

</style>
