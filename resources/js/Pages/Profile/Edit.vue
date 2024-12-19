<script setup lang="ts">
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import App from '@/Layouts/App.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <!-- <Head title="Profile" /> -->

    <App>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Profile</h2>
        </template> -->

            <div class="p-4 space-y-6">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
    </App>
</template>
