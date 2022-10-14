<script setup>
import JetButton from "../Button.vue";

defineProps({
    category: {
        type: Object,
    },
    backButton: {
        type: Function,
    },
});
</script>

<template>
    <div class="max-w-md flex flex-col mx-auto">
        <div class="flex flex-row justify-end mb-5">
            <JetButton
                type="button"
                v-on:method="$emit('backButton')"
                classes="bg-stone-600 hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-stone-900 focus:ring focus:ring-stone-300"
                >Back</JetButton
            >
        </div>
        <div class="w-full bg-cyan-400 flex flex-row mb-3">
            <div class="w-2/5"><strong>Title</strong></div>
            <div class="w-full">
                <p>{{ category.title }}</p>
            </div>
        </div>
        <div class="w-full flex flex-row mb-3">
            <div class="w-2/5"><strong>Slug</strong></div>
            <div class="w-full">
                <p>{{ category.slug }}</p>
            </div>
        </div>
        <div class="w-full flex flex-row mb-3">
            <div class="w-2/5"><strong>Meta Info</strong></div>
            <div class="w-full">
                <p>{{ category.meta_info }}</p>
            </div>
        </div>
        <div class="w-full flex flex-row mb-3">
            <div class="w-2/5"><strong>Figure</strong></div>
            <div class="w-full">
                <img
                    :src="'/storage/images/category/' + category.urlphoto"
                    alt="Image Category"
                    class="w-full h-16 rounded-md"
                />
            </div>
        </div>
    </div>
</template>
