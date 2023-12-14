<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref, defineEmits} from 'vue'

const name = ref('')
const path = ref('')

const emit = defineEmits(['addProject', 'close'])
const addProject = () => {
    axios.post('/api/project', {
        name: name.value,
        path: path.value
    }).then(response => {
        console.log(response.data)
        emit('addProject', response.data)
        close()
    }).catch(error => {
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
