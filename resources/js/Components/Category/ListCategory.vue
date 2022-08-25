<script setup>
import JetButton from "@/Components/Button.vue";

defineProps({
    showFormAdd: {
        type: Function,
    },
    categories: {
        type: Object,
    },
});

const data = () => {
    console.log("log");
};
</script>

<template>
    <div class="py-5">
        <h1 class="text-xl font-bold mb-10 text-center">List of Category</h1>
        <div class="flex flex-row justify-end mb-1">
            <JetButton
                type="button"
                classes="bg-teal-500 hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300"
                v-on:method="$emit('showFormAdd')"
                >Create Category</JetButton
            >
        </div>
        <div class="overflow-x-auto relative">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="py-3 px-6">Title</th>
                        <th scope="col" class="py-3 px-6">Slug</th>
                        <th scope="col" class="py-3 px-6">Meta Description</th>
                        <th scope="col" class="py-3 px-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <th
                            scope="row"
                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ category.title }}
                        </th>
                        <td class="py-4 px-6">{{ category.slug }}</td>
                        <td class="py-4 px-6">{{ category.meta_info }}</td>
                        <td class="py-4 px-6">
                            <JetButton
                                type="button"
                                classes="bg-slate-100 text-black border border-solid border-slate-300 mr-1 hover:bg-slate-500 active:bg-slate-900 focus:outline-none focus:border-slate-900 focus:ring focus:ring-slate-300"
                                v-on:method="$emit('showFormAdd')"
                                >Show</JetButton
                            >
                            <JetButton
                                type="button"
                                classes="bg-emerald-400 mr-1 hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring focus:ring-emerald-300"
                                v-on:method="$emit('showFormAdd')"
                                >Edit</JetButton
                            >
                            <JetButton
                                type="button"
                                classes="bg-rose-500 hover:bg-rose-700 active:bg-rose-900 focus:outline-none focus:border-rose-900 focus:ring focus:ring-rose-300"
                                v-on:method="$emit('showFormAdd')"
                                >Delete</JetButton
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
