<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
</script>

<template>
    <AdminLayout title="HomeAdmin">
        <h4 class="text-lg font-bold">
            Welcome {{ $page.props.user.email }} in admin page
        </h4>
    </AdminLayout>
</template>
