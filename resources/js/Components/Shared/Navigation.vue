<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "../ApplicationMark.vue";
import JetResponsiveNavLink from "../ResponsiveNavLink.vue";
</script>

<template>
    <div class="bg-slate-300 px-10 py-4">
        <div class="flex justify-center items-center">
            <Link :href="route('dashboard')">
                <JetApplicationMark class="block h-9 w-auto" />
            </Link>
            <div class="flex-grow"></div>
            <div class="flex-1 flex justify-between items-center">
                <div class="flex justify-evenly">
                    <JetResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="px-2 py-2"
                    >
                        Home
                    </JetResponsiveNavLink>
                    <JetResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="px-2 py-2"
                    >
                        About
                    </JetResponsiveNavLink>
                    <JetResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="px-2 py-2"
                    >
                        Product
                    </JetResponsiveNavLink>
                    <JetResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="px-2 py-2"
                    >
                        Cart
                    </JetResponsiveNavLink>
                </div>
                <!-- End flex div item -->
                <div v-if="$page.props.user">
                    <JetResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Admin
                    </JetResponsiveNavLink>
                </div>
                <template v-else>
                    <div class="flex justify-evenly">
                        <JetResponsiveNavLink
                            :href="route('login')"
                            :active="route().current('login')"
                            class="px-2 py-2"
                        >
                            Sign In
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            :href="route('register')"
                            :active="route().current('register')"
                            class="px-2 py-2"
                        >
                            Sign Up
                        </JetResponsiveNavLink>
                    </div>
                </template>
            </div>
            <!-- End flex div parent item -->
        </div>
        <!-- end flex div nav content -->
    </div>
    <!-- End div navbar -->
</template>
