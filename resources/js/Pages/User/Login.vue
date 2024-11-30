<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
</script>

<template>
    <div
        class="flex items-center justify-center h-screen bg-gray-300 dark:bg-gray-800"
    >
        <form
            @submit.prevent="form.post(route('login'))"
            class="p-4 space-y-3 bg-base-100 shadow-md rounded-xl w-96"
        >
            <div>
                <label class="text-black dark:text-white label">Email</label>
                <input
                    v-model="form.email"
                    class="bg-base-100 w-full input input-primary"
                    type="email"
                />
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div>
                <label class="label text-black dark:text-white">Password</label>
                <input
                    v-model="form.password"
                    class="bg-base-100 w-full input input-primary"
                    type="password"
                />
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.password }}
                </div>
            </div>
            <div>
                <label
                    class="text-black dark:text-white flex justify-start gap-2 label"
                >
                    <input
                        v-model="form.remember"
                        class="bg-base-100 checkbox checkbox-primary"
                        type="checkbox"
                    />
                    Remeber me
                </label>
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.remember }}
                </div>
            </div>
            <div class="flex items-center justify-end gap-3">
                <a class="link link-primary" href="#">Forgot password?</a>
                <button class="btn btn-primary" type="submit">Log in</button>
            </div>
        </form>
    </div>
</template>
