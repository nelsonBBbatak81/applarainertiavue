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
    disabled: {
        type: Boolean,
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
        :disabled="disabled ? 'disabled' : ''"
    >
        <slot />
    </button>
</template>
