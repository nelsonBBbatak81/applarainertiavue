<script setup>
import JetButton from "@/Components/Button.vue";
import JetLabel from "@/Components/Label.vue";
import JetInput from "@/Components/Input.vue";
import JetSpinner from "@/Components/Spinner.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";
</script>
<script>
export default {
    props: {
        backButton: Function,
        form: Object,
        category: Object,
        previewImage: String,
        submit: Function,
    },
    data() {
        return {
            isLoading: false,
            isUpload: false,
        };
    },
    methods: {
        selectImage() {
            this.$refs.fileInput.click();
        },
        pickFile() {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onloadstart = (e) => {
                    this.isUpload = true;
                    // console.log(e.target.result);
                    console.log("start");
                };
                reader.onload = (e) => {
                    // this.previewImage = e.target.result;
                    this.$emit("pickFile", e.target.result);
                    // this.$refs.preview.style.backgroundImage = `url(${e.target.result})`;
                    // console.log(this.$refs.preview.style.backgroundImage);
                };
                reader.onloadend = (e) => {
                    this.isUpload = false;
                    // console.log(e.target.result);
                    console.log("end");
                };
                reader.readAsDataURL(file[0]);
                this.form.urlphoto = file[0];
            }
        },
    },
};
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
            <h2 class="text-lg font-bold text-center">Edit Category</h2>
            <form @submit.prevent="$emit('submit')">
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
                <div class="mb-3">
                    <JetLabel for="Figure" value="Figure" />
                    <input
                        ref="fileInput"
                        type="file"
                        class="mt-1 block w-full"
                        @input="pickFile"
                    />
                    <div v-if="isUpload">Wait uploading ....</div>
                    <div
                        class="imagePreviewWrapper"
                        v-show="previewImage !== null"
                        ref="preview"
                        :style="{
                            'background-image': `url(${previewImage})`,
                        }"
                        @click="selectImage"
                    ></div>
                </div>
                <div class="bg-red-200 w-full">
                    <button
                        type="submit"
                        class="w-full py-2 inline-flex justify-center bg-teal-600 text-white font-bold rounded-md hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
.imagePreviewWrapper {
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: cover;
    background-position: center center;
    transition: all 1s ease-out;
}
</style>
