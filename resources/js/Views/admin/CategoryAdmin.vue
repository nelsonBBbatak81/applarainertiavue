<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "../../appdua/layouts/AdminLayout.vue";
import ListCategory from "../../appdua/components/Category/ListCategory.vue";
import AddCategory from "../../appdua/components/Category/AddCategory.vue";
import EditCategory from "../../appdua/components/Category/EditCategory.vue";
import JetSpinner from "../../appdua/components/Spinner.vue";
import JetModalItem from "../../appdua/components/ModalItem.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";

defineProps({
    categories: {
        type: Object,
    },
});
</script>
<script>
export default {
    data() {
        return {
            form: {
                title: null,
                meta_info: null,
                urlphoto: null,
            },
            category: {},
            isFormAdd: false,
            isFormEdit: false,
            isListTable: true,
            previewImage: null,
            isLoading: false,
            titleDelete: "Delete Category",
            contentDelete: "Are you sure want to delete this category ?",
            isShowModalDelete: false,
        };
    },
    methods: {
        backButton() {
            this.isFormAdd = false;
            this.isFormEdit = false;
            this.isListTable = true;
            this.form.title = null;
            this.form.meta_info = null;
            this.category = {};
            this.previewImage = null;
        },
        showFormAdd() {
            this.isListTable = false;
            this.isFormAdd = true;
            this.form.title = null;
            this.form.meta_info = null;
            this.previewImage = null;
        },
        showFormEdit(category) {
            console.log(category);
            this.category = category;
            this.isListTable = false;
            this.isFormEdit = true;
            this.form.title = category.title;
            this.form.meta_info = category.meta_info;
            this.previewImage = `/storage/images/category/${category.urlphoto}`;
            console.log(`/storage/images/category/${category.urlphoto}`);
        },

        clearFile() {
            this.previewImage = null;
        },
        pickFile(url) {
            this.previewImage = url;
        },

        async handleAddCategory() {
            // console.log("lagi saja");
            // await this.$inertia.post("/categories/add", this.form, {
            //     onStart: () => {
            //         this.isLoading = true;
            //     },
            //     onFinish: () => {
            //         this.isLoading = false;
            //         this.backButton();
            //     },
            //     onError: (err) => {
            //         this.isLoading = false;
            //         console.log(err);
            //     },
            // });
            Inertia.post("/categories/add", this.form, {
                preserveScroll: false,
                onBefore: () => {
                    console.log("OnBefore");
                },
                onStart: (visit) => {
                    console.log("onStart");
                    console.log(visit);
                },
                onSuccess: (page) => {
                    console.log(page);
                    this.isLoading = false;
                    this.backButton();
                    console.log("success");
                },
                onError: (errors) => {
                    this.isLoading = false;
                    console.log(errors);
                },
            });

            // let item = new FormData();
            // item.append("title", this.form.title);
            // item.append("meta_info", this.form.meta_info);
            // item.append("urlphoto", this.form.urlphoto);
            // axios
            //     .post("/categories/add", item)
            //     .then((res) => {
            //         console.log(res);
            //         this.isLoading = false;
            //         Inertia.get("/categories");
            //     })
            //     .catch((err) => {
            //         console.log(err);
            //         this.isLoading = false;
            //     });
            // Inertia.post("/categories/add", this.form);
        },
        handleUpdateCategory() {
            console.log(this.category);
            Inertia.post(`/categories/update/${this.category.id}`, this.form, {
                preserveScroll: true,
                onBefore: () => {},
                onStart: (visit) => {},
                onSuccess: (page) => {
                    this.isLoading = false;
                    this.backButton();
                    console.log("success delete");
                },
                onError: (errors) => {
                    this.isLoading = false;
                    console.log(errors);
                    console.log("failure delete");
                },
            });
        },
        submit() {
            this.isLoading = true;
            if (this.category.hasOwnProperty("id")) {
                console.log("update");
                this.handleUpdateCategory();
            } else {
                console.log("save");
                this.handleAddCategory();
            }
        },
        deleteCategory(data) {
            this.isShowModalDelete = true;
            this.category = data;
            this.$page.props.flash.message = null;
        },
        closeModalDeleteCategory() {
            this.isShowModalDelete = false;
        },
        async handleDeleteCategory(id) {
            this.isShowModalDelete = false;
            this.isLoading = true;
            await this.$inertia.delete(`/categories/delete/${id}`, {
                preserveScroll: true,
                onBefore: () => {},
                onStart: (visit) => {},
                onSuccess: (page) => {
                    this.isLoading = false;
                },
                onError: (errors) => {
                    this.isLoading = false;
                },
            });
        },
    },
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
            <!-- Show form add -->
            <div
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
                        v-on:showFormEdit="showFormEdit"
                        :categories="categories.data"
                        v-on:deleteCategory="deleteCategory"
                    />
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
