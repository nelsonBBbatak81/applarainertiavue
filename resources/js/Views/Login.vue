<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "../appdua/components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "../appdua/components/AuthenticationCardLogo.vue";
import JetButton from "../appdua/components/Button.vue";
import JetInput from "../appdua/components/Input.vue";
import JetCheckbox from "../appdua/components/Checkbox.vue";
import JetLabel from "../appdua/components/Label.vue";
import JetValidationErrors from "../appdua/components/ValidationErrors.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <JetCheckbox
                        v-model:checked="form.remember"
                        name="remember"
                    />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Forgot your password?
                </Link>

                <JetButton
                    class="ml-4"
                    classes="text-black border border-solid border-slate-300"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </JetButton>
            </div>
            <div class="flex flex-row mt-4 justify-center items-center">
                <p>If you do not have any account please</p>
                <Link
                    class="underline text-sm text-blue-400 ml-2 hover:text-blue-500"
                    :href="route('register')"
                    >Sign Up</Link
                >
            </div>
        </form>
    </JetAuthenticationCard>
</template>
