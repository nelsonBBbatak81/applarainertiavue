<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navigation from "../components/Navigation.vue";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />

    <Navigation />

    <!-- Page Content -->
    <main>
        <slot />
    </main>
</template>
