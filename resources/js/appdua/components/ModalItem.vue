<script setup>
defineProps({
    title: String,
    content: String,
    handleDeleteCategory: Function,
    closeModalDeleteCategory: Function,
    category: Object,
});
</script>
<template>
    <div
        class="fixed top-0 w-full h-screen bg-black opacity-90 pt-20 flex justify-center z-20"
    >
        <div
            class="bg-white flex flex-col h-60 animate__animated animate__fadeInDown"
        >
            <div class="flex flex-row justify-between px-4 py-4">
                <h2 class="text-md font-bold text-black">{{ title }}</h2>
                <button
                    class="bg-transparent text-black text-lg"
                    @click="$emit('closeModalDeleteCategory')"
                >
                    x
                </button>
            </div>
            <div class="px-4 py-10">
                {{ content }}
            </div>
            <div class="flex flex-row justify-end px-2 py-4">
                <button
                    class="bg-blue-600 text-white font-bold px-4 py-2 rounded-md mr-4 hover:bg-blue-800"
                    @click="$emit('handleDeleteCategory', category.id)"
                >
                    Delete
                </button>
                <button
                    class="bg-slate-600 text-white font-bold px-4 py-2 rounded-md hover:bg-slate-800"
                    @click="$emit('closeModalDeleteCategory')"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>
