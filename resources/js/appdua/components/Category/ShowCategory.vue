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
    <div class="flex flex-col mx-auto">
        <div class="flex flex-row justify-end mb-5">
            <JetButton
                type="button"
                v-on:method="$emit('backButton')"
                classes="bg-stone-600 hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-stone-900 focus:ring focus:ring-stone-300"
                >Back</JetButton
            >
        </div>
        <p>{{ category.title }}</p>
    </div>
</template>
