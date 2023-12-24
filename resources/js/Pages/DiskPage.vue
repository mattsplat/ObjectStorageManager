<template>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden min-h-[600px]" >
        <div class="absolute bg-white bg-opacity-60 z-10 h-full w-full flex items-center justify-center" v-if="isLoading">
            <div class="flex items-center">
                <span class="text-3xl mr-4">Loading</span>
                <svg class="animate-spin h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </div>


        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert"
             v-if="error">
            <span class="font-medium">Danger alert!</span> {{ error }}
            <svg class="w-8 h-8 inline-block ms-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                 fill="currentColor" id="closeIcon" @click="error = null">
                <path fill-rule="evenodd"
                      d="M10.293 8.293a1 1 0 0 1 1.414 0L14 10.586l2.293-2.293a1 1 0 1 1 1.414 1.414L15.414 12l2.293 2.293a1 1 0 1 1-1.414 1.414L14 13.414l-2.293 2.293a1 1 0 1 1-1.414-1.414L12.586 12l-2.293-2.293a1 1 0 0 1 0-1.414z"/>
            </svg>
        </div>

        <nav class="flex px-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse my-5">
                <li class="inline-flex items-center">
                    <a href="#" @click.prevent="path = ''; getPathContents()"
                       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        {{ disk.name }}
                    </a>
                </li>
                <li v-for="breadCrumb in breadCrumbs">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="#" @click="path = breadCrumb.path; getPathContents()"
                           class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            {{ breadCrumb.name }}
                        </a>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="grid grid-cols-4 gap-4 p-5">
            <button type="button"
                    class="p-2 rounded-md relative inline-flex items-center w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white "
                    v-for="folder in folders" @click="path = folder.path; getPathContents()"
            >
                <svg class="w-3 h-3 me-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H286.6c-10.6 0-20.8-4.2-28.3-11.7L213.1 87c-4.5-4.5-10.6-7-17-7H64z"/>
                </svg>
                {{ folder.path.split('/').pop() }}
            </button>
        </div>
        <section class="">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6" v-if="files.length > 0">
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                    <div v-for="file in visibleFiles" class="group relative border-gray-200">
                        <ImageCard :image="file" @selected="selectedFile = file"></ImageCard>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ (file.file_size / 1024).toFixed(2) }} KB
                        </p>
                    </div>
                </div>
                <h3 @click="loadMore" class="text-center text-blue-300 mt-5 cursor-pointer"
                    v-if="totalResults-(page * perPage) > 0">Showing {{ perPage * page }} of {{ totalResults }} Load More</h3>
            </div>
            <div v-else class="p-12 mt-8 mx-auto text-center">
                <span class="text-2xl text-center text-white">No files found.</span>
            </div>
        </section>
        <FileDrawerSlide v-if="selectedFile" @close="selectedFile = null" :file="selectedFile" :disk="disk" @update="getPathContents"></FileDrawerSlide>
    </div>
</template>

<script setup>
import {ref, onMounted, computed} from 'vue'
import ImageCard from "../components/ImageCard.vue";
import FileDrawerSlide from "../components/FileDrawerSlide.vue";
import Toast from "../components/Toast.vue";

const folder = ref('')
const file = ref('')
const clipboard = ref('')
const clipboardField = ref(null)
const selectedFile = ref(null)

const props = defineProps({
    disk: {
        type: Object,
        required: true,
    },
})

const path = ref('')
const folders = ref([])
const files = ref([])
// get url params
const urlParams = new URLSearchParams(window.location.search)
const pathParam = urlParams.get('path')
if (pathParam) {
    path.value = pathParam
}
const isLoading = ref(false)
const getPathContents = () => {
    isLoading.value = true
    page.value = 1
    axios.get('/api/disk/' + props.disk.id, {
        params: {
            path: path.value,
        }
    }).then(response => {
        folders.value = response.data?.filter(row => row.type === 'dir')
        files.value = response.data?.filter(row => row.type === 'file')
        isLoading.value = false
    }).catch(e => {
        error.value = e
        isLoading.value = false
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

const breadCrumbs = computed(() => {
    const parts = path.value.split('/')
    const crumbs = []
    parts.forEach((part, index) => {
        crumbs.push({
            name: part,
            path: parts.slice(0, index + 1).join('/'),
        })
    })

    return crumbs
})
const error = ref(null)
const page = ref(1)
const perPage = ref(10)
const visibleFiles = computed(() => {
    return files.value.slice(0, page.value * perPage.value)
})
const totalResults = computed(() => {
    return files.value.length
})
const loadMore = () => {
    page.value++
}

onMounted(() => {
    getPathContents()
})
</script>

<style scoped>

</style>
