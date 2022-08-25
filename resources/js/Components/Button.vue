<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
    classes: {
        type: String,
    },
    method: {
        type: Function,
    },
});

// const emit = defineEmits(["method"]);

const data = () => {
    // $emit("method");
    console.log("data");
};
</script>

<template>
    <button
        v-show="type === 'button'"
        :type="type"
        @click="$emit('method')"
        :class="classes"
        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition"
    >
        <slot />
    </button>
    <button
        v-show="type === 'submit'"
        :type="type"
        :class="classes"
        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition"
    >
        <slot />
    </button>
    <!-- <button
        :type="type"
        @click="$emit('method')"
        :class="classes"
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
    >
        <slot />
    </button> -->
    <!-- <button
        v-show="colorbtn === 'bg-stone'"
        :type="type"
        @click="$emit('method')"
        class="inline-flex items-center px-4 py-2 bg-stone-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-stone-900 focus:ring focus:ring-stone-300 disabled:opacity-25 transition"
    >
        <slot />
    </button>
    <button
        v-show="colorbtn === 'bg-red'"
        :type="type"
        @click="$emit('method')"
        class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
    >
        <slot />
    </button>
    <button
        v-show="colorbtn === 'bg-teal'"
        :type="type"
        @click="$emit('method')"
        class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition"
    >
        <slot />
    </button> -->
</template>
