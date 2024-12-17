<script setup lang="ts">
import App from "@/Layouts/App.vue";

import { Link } from "@inertiajs/vue3";
// import useAuth from '@/Composables/useAuth';
import SvgIcon from "@/Components/SvgIcon.vue";

// const { hasAnyPermission } = useAuth();
</script>
<template>
    <App>
        <div class="flex flex-wrap">
            <Link
                :href="route('thesises.management.index')"
                class="w-full transform p-2 duration-300 ease-in hover:scale-105 md:w-1/3 lg:w-1/5"
            >
                <div
                    class="h-full w-full overflow-hidden rounded-xl bg-green-200 shadow-xl dark:bg-green-700"
                >
                    <div class="p-2">
                        <!--Icon-->
                        <div
                            class="grid place-content-center rounded-xl bg-green-100 p-3 dark:bg-green-500"
                        >
                            <SvgIcon class="w-24" name="book-shelf" />
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-2">
                        <!--Text-->
                        <h2 class="text-center text-lg font-bold">
                            Thesis Management System
                        </h2>
                    </div>
                </div>
            </Link>
        </div>
    </App>
</template>
