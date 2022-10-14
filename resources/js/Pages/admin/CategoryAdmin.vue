<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ListCategory from "@/Components/Category/ListCategory.vue";
import AddCategory from "@/Components/Category/AddCategory.vue";
import EditCategory from "@/Components/Category/EditCategory.vue";
import ShowCategory from "@/Components/Category/ShowCategory.vue";
import JetSpinner from "@/Components/Spinner.vue";
import JetModalItem from "@/Components/ModalItem.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import axios from "axios";

defineProps({
    categories: {
        type: Object,
    },
});

let category = ref({});
let idCategory = ref(0);
let isFormAdd = ref(false);
let isFormEdit = ref(false);
let isFormShowCategory = ref(false);
let isListTable = ref(true);
let previewImage = ref(null);
let isLoading = ref(false);
let isShowModalDelete = ref(false);
const titleDelete = "Delete Category";
const contentDelete = "Are you sure want to delete this category ?";

const form = useForm({
    title: "",
    meta_info: "",
    urlphoto: "",
});

const backButton = () => {
    isFormAdd.value = false;
    isFormEdit.value = false;
    isFormShowCategory.value = false;
    isListTable.value = true;
    form.title = null;
    form.meta_info = null;
    category.value = {};
    previewImage.value = null;
    idCategory.value = 0;
};

const showFormCategory = (data) => {
    isListTable.value = false;
    isFormShowCategory.value = true;
    console.log(data);
    category.value = data;
};

const showFormAdd = () => {
    isListTable.value = false;
    isFormAdd.value = true;
    form.title = null;
    form.meta_info = null;
    previewImage.value = null;
};

const showFormEdit = (data) => {
    // console.log(data.id);
    // category.value = data;
    idCategory.value = data.id;
    isListTable.value = false;
    isFormEdit.value = true;
    form.title = data.title;
    form.meta_info = data.meta_info;
    previewImage.value = `/storage/images/category/${data.urlphoto}`;
    console.log(`/storage/images/category/${data.urlphoto}`);
};

const clearFile = () => {
    previewImage.value = null;
};

const pickFile = (url) => {
    console.log(url);
    previewImage.value = url;
};

const saveCategory = () => {
    if (form.processing) {
        return false;
    }
    form.post("/categories/add", {
        onFinish: () => {
            console.log("save");
            isLoading.value = false;
            backButton();
        },
    });
};

const updateCategory = () => {
    form.post(`/categories/update/${idCategory.value}`, {
        onFinish: () => {
            console.log("save");
            isLoading.value = false;
            backButton();
            idCategory.value = 0;
        },
    });
};

const submit = () => {
    isLoading.value = true;
    if (idCategory.value > 0) {
        console.log("update");
        updateCategory();
    } else {
        console.log("save");
        saveCategory();
    }
};

const deleteCategory = (data) => {
    isShowModalDelete.value = true;
    // category.value = data;
    idCategory.value = data.id;
    console.log(data);
};

const closeModalDeleteCategory = () => {
    isShowModalDelete.value = false;
};

const handleDeleteCategory = async () => {
    // console.log(category);
    isShowModalDelete.value = false;
    isLoading.value = true;
    await Inertia.delete(`/categories/delete/${idCategory.value}`, {
        preserveScroll: true,
        onBefore: () => {},
        onStart: (visit) => {},
        onSuccess: (page) => {
            isLoading.value = false;
            idCategory.value = 0;
        },
        onError: (errors) => {
            isLoading.value = false;
        },
    });
};
</script>

<template>
    <div>
        <div v-show="isShowModalDelete">
            <JetModalItem
                :title="titleDelete"
                :content="contentDelete"
                v-on:closeModalDeleteCategory="closeModalDeleteCategory"
                v-on:handleDeleteCategory="handleDeleteCategory"
                :category="category"
            />
        </div>

        <AdminLayout title="Category Admin">
            <div v-show="isLoading">
                <JetSpinner />
            </div>

            <!-- Show item category -->
            <div
                v-show="isFormShowCategory"
                class="animate__animated animate__fadeInDown"
            >
                <ShowCategory
                    :category="category"
                    v-on:backButton="backButton"
                />
            </div>
            <!-- Show form add -->
            <div
                v-on:backButton="backButton"
                v-show="isFormAdd"
                class="animate__animated animate__fadeInDown"
            >
                <AddCategory
                    v-on:backButton="backButton"
                    :form="form"
                    :previewImage="previewImage"
                    v-on:pickFile="pickFile"
                    v-on:submit="submit"
                    :isLoading="isLoading"
                />
            </div>

            <Transition name="fadeDown">
                <div v-show="isFormEdit">
                    <EditCategory
                        v-on:backButton="backButton"
                        :form="form"
                        :category="category"
                        :previewImage="previewImage"
                        v-on:pickFile="pickFile"
                        v-on:submit="submit"
                    />
                </div>
            </Transition>

            <!-- Show list category -->
            <Transition name="fadeUp">
                <div v-show="isListTable">
                    <ListCategory
                        v-on:showFormAdd="showFormAdd"
                        v-on:showFormCategory="showFormCategory"
                        v-on:showFormEdit="showFormEdit"
                        :categories="categories.data"
                        v-on:deleteCategory="deleteCategory"
                    />
                    <div
                        v-if="categories.total > categories.per_page"
                        class="py-4 flex flex-row justify-center"
                    >
                        <Pagination :data="categories.links" />
                    </div>
                </div>
            </Transition>
        </AdminLayout>
    </div>
</template>
<style scoped>
.fadeUp-enter-active {
    animation: fadeInUp 1s;
}
.fadeDown-enter-active {
    animation: fadeInDown 1s;
}
</style>
