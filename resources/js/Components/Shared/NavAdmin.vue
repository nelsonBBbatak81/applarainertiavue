<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import JetResponsiveNavLink from "../ResponsiveNavLink.vue";

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <div class="flex flex-col justify-center items-center">
        <img
            :src="$page.props.images.logo"
            alt="Image Logo"
            class="w-20 h-16 mb-5"
        />
        <p>media-fashion.com</p>
        <h3 class="text-md font-bold mb-5">CV. Bintang Nusantara</h3>
        <p class="text-justify text-md font-normal mb-10">
            Jl. Medan no. 34, Kel. Sigulangulang - Kec. Siantar Utara -
            Kotamadya Pematangsiantar - Sumatra Utara - Indonesia
        </p>

        <div class="w-full flex flex-col justify-start">
            <Link
                :href="route('dashboard')"
                :class="
                    route().current('dashboard')
                        ? 'bg-gray-500 text-white font-bold py-2 px-2'
                        : 'text-black font-bold py-2 px-2 hover:bg-gray-500 hover:text-white'
                "
            >
                Home
            </Link>
            <Link
                :href="route('categories')"
                :class="
                    route().current('categories')
                        ? 'bg-gray-500 text-white font-bold py-2 px-2'
                        : 'text-black font-bold py-2 px-2 hover:bg-gray-500 hover:text-white'
                "
            >
                Category
            </Link>
            <Link
                :href="route('products')"
                :class="
                    route().current('products')
                        ? 'bg-gray-500 text-white font-bold py-2 px-2'
                        : 'text-black font-bold py-2 px-2 hover:bg-gray-500 hover:text-white'
                "
            >
                Product
            </Link>
            <form @submit.prevent="logout">
                <button
                    type="submit"
                    class="w-full text-black font-bold text-left py-2 px-2 hover:bg-gray-500 hover:text-white"
                >
                    Log Out
                </button>
            </form>
        </div>
    </div>
</template>
