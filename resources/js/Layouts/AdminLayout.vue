<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import JetBanner from "@/Components/Banner.vue";
import JetDropdown from "@/Components/Dropdown.vue";
import JetDropdownLink from "@/Components/DropdownLink.vue";
import NavAdmin from "@/Components/Shared/NavAdmin.vue";
import Footer from "@/Components/Shared/Footer.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />
    <div>
        <div class="flex w-full h-full">
            <div class="bg-slate-600 w-2/5 px-10 py-5">
                <NavAdmin />
            </div>
            <div class="w-full bg-slate-100 px-5 py-5 content">
                <div
                    class="flex flex-row justify-end items-end py-3 hidden sm:flex sm:items-center sm:ml-6"
                >
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <JetDropdown align="left" width="48">
                            <template #trigger>
                                <button
                                    v-if="
                                        $page.props.jetstream
                                            .managesProfilePhotos
                                    "
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                >
                                    <img
                                        class="h-8 w-8 rounded-full object-cover"
                                        :src="
                                            $page.props.user.profile_photo_url
                                        "
                                        :alt="$page.props.user.name"
                                    />
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                    >
                                        {{ $page.props.user.name }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Account
                                </div>

                                <JetDropdownLink :href="route('profile.show')">
                                    Profile
                                </JetDropdownLink>

                                <JetDropdownLink
                                    v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')"
                                >
                                    API Tokens
                                </JetDropdownLink>

                                <div class="border-t border-gray-100" />

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <JetDropdownLink as="button">
                                        Log Out
                                    </JetDropdownLink>
                                </form>
                            </template>
                        </JetDropdown>
                    </div>
                </div>

                <Transition name="page" made="out-in" appear>
                    <div :key="$page.url">
                        <JetBanner />
                        <slot />
                    </div>
                </Transition>
            </div>
        </div>

        <Footer />
    </div>
</template>
<style scoped>
.content {
    overflow-x: hidden;
}
.page-enter-active {
    animation: slideInLeft 1s;
}
.page-leave-active {
    animation: slideOutRight 1s;
}
</style>
