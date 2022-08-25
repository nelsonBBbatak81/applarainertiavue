//
<script setup>
// import { Inertia } from "@inertiajs/inertia";
// import { useForm } from "@inertiajs/inertia-vue3";
// import JetButton from "@/Components/Button.vue";
// import JetLabel from "@/Components/Label.vue";
// import JetInput from "@/Components/Input.vue";

// defineProps({
//     backButton: {
//         type: Function,
//     },
//     errors: {
//         type: Object,
//     },
// });

// const form = useForm({
//     title: "",
//     meta_info: "",
// });

// const submit = () => {
//     Inertia.post("/categories/add", form);
// };
//
</script>

<template>
    <div>
        <div v-show="isLoading">
            <JetSpinner />
        </div>
        <div class="flex flex-row justify-end mb-5">
            <JetButton
                type="button"
                v-on:method="$emit('backButton')"
                classes="bg-stone-600 hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-stone-900 focus:ring focus:ring-stone-300"
                >Back</JetButton
            >
        </div>
        <div class="max-w-md mx-auto">
            <JetValidationErrors class="mb-4" />
            <h2 class="text-lg font-bold text-center">Add Category</h2>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <JetLabel for="title" value="Title" />
                    <JetInput
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full"
                    />
                </div>
                <div class="mb-3">
                    <JetLabel for="Meta Description" value="Meta Description" />
                    <textarea
                        v-model="form.meta_info"
                        cols="30"
                        rows="5"
                        class="mt-1 block w-full"
                    ></textarea>
                </div>
                <div class="bg-red-200 w-full">
                    <JetButton
                        type="submit"
                        classes="w-full justify-center bg-teal-500 hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300"
                        >Save</JetButton
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import JetButton from "@/Components/Button.vue";
import JetLabel from "@/Components/Label.vue";
import JetInput from "@/Components/Input.vue";
import JetSpinner from "@/Components/Spinner.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";

export default {
    props: {
        backButton: Function,
    },
    data() {
        return {
            form: {
                title: null,
                meta_info: null,
            },
            isLoading: false,
        };
    },
    methods: {
        async submit() {
            this.isLoading = true;
            await this.$inertia.post("/categories/add", this.form, {
                preserveScroll: true,
                onBefore: () => {},
                onStart: (visit) => {},
                onSuccess: (page) => {
                    this.isLoading = false;
                    this.$emit("backButton");
                },
                onError: (errors) => {
                    this.isLoading = false;
                },
            });
            console.log(this.errors);
        },
    },
};
</script>
