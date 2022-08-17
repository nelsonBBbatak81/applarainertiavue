<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import JetBanner from "@/Components/Banner.vue";
import NavAdmin from "@/Components/Shared/NavAdmin.vue";
import Footer from "@/Components/Shared/Footer.vue";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />
    <div>
        <div class="flex w-full h-full">
            <div class="bg-cyan-600 w-96 px-10 py-5">
                <NavAdmin />
            </div>
            <div class="w-full bg-slate-100 px-5 py-5">
                <JetBanner />

                <slot />
            </div>
        </div>

        <Footer />
    </div>
</template>
