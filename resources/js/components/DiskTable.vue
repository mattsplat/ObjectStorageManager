<template>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden min-h-[600px]">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button type="button"
                        class="ml-auto flex items-center justify-center dark:text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        @click="showDiskModal()"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512" class="mr-3">
                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                    </svg>
                    Add Project
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Disk Name</th>
                    <th scope="col" class="px-4 py-3">Path</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b dark:border-gray-700" v-for="(disk, index) in disks" :key="index">
                    <td class="px-4 py-3 text-2xl">{{ disk.name }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="apple-imac-27-dropdown-button">
                            <li>
                                <a :href="`/disk/${disk.id}`"
                                   class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-green-600">Show</a>
                            </li>
                            <li>
                                <a :href="`/disk/${disk.id}`" @click.prevent="showDiskModal(disk)"
                                   class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-green-600">Edit</a>
                            </li>
                            <li>
                                <a href="#" @click.prevent="deleteDisk(disk.id)"
                                   class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-600">Delete</a>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr v-if="disks && disks.length <  1">
                    <td colspan="3" class="text-center py-4 text-2xl text-white">No disks found.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <DiskFormModal v-if="showDiskFormModal" @close="showDiskFormModal = false" :disk="selectedDisk"
                    @update="getDisks"
                      @addProject="getDisks"></DiskFormModal>
</template>

<script setup>
import {onMounted, ref} from "vue";
import DiskFormModal from "./DiskFormModal.vue";
import {useToast} from "vue-toastification";

const toast = useToast();
const disks = ref([]);
const showDiskFormModal = ref(false);

onMounted(() => {
    getDisks()
})
const selectedDisk = ref(null);
const getDisks = () => {
    axios.get('/api/disk')
        .then(response => {
            disks.value = response.data;
        })
        .catch(error => {
            toast.error('Something went wrong');
            console.log(error);
        });
}

const deleteDisk = (id) => {
    axios.delete(`/api/disk/${id}`)
        .then(_ => {
            toast.success('Disk deleted successfully');
            getDisks();
        })
        .catch(error => {
            toast.error('Something went wrong');
            console.log(error);
        });
}

const showDiskModal = (disk = null) => {
    selectedDisk.value = disk;
    showDiskFormModal.value = true;
}

</script>

<style scoped>

</style>
