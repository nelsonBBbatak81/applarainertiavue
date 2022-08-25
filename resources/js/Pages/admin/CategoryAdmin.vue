<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ListCategory from "@/Components/Category/ListCategory.vue";
import AddCategory from "@/Components/Category/AddCategory.vue";

defineProps({
    categories: {
        type: Object,
    },
});

const isListTable = ref(true);
const isFormAdd = ref(false);

const backButton = () => {
    isFormAdd.value = false;
    isListTable.value = true;
};

const showFormAdd = () => {
    isListTable.value = false;
    isFormAdd.value = true;
};
</script>

<template>
    <AdminLayout title="Category Admin">
        <!-- Show form add -->
        <div v-show="isFormAdd">
            <AddCategory v-on:backButton="backButton" />
        </div>

        <!-- Show list category -->
        <div v-show="isListTable">
            <ListCategory
                v-on:showFormAdd="showFormAdd"
                :categories="categories.data"
            />
        </div>
    </AdminLayout>
</template>
