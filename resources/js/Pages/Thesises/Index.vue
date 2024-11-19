<script setup lang="ts">
import App from "@/Layouts/App.vue";

import { Link } from "@inertiajs/vue3";
import SvgIcon from "@/Components/SvgIcon.vue";
</script>
<template>
    <App>
        <div class="flex flex-wrap">
            <Link
                :href="route('thesises.management.index')"
                class="w-full p-2 duration-300 ease-in transform md:w-1/3 lg:w-1/5 hover:scale-105"
            >
                <div
                    class="w-full h-full overflow-hidden bg-green-200 shadow-xl dark:bg-green-700 rounded-xl"
                >
                    <div class="p-2">
                        <!--Icon-->
                        <div
                            class="grid p-3 bg-green-100 dark:bg-green-500 rounded-xl place-content-center"
                        >
                            <!-- <SvgIcon class="w-24" name="arrow-square-in" /> -->
                            <i class="text-6xl fa-solid fa-book"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-2">
                        <!--Text-->
                        <h2 class="text-lg font-bold text-center">
                            Thesis Management System
                        </h2>
                    </div>
                </div>
            </Link>
        </div>
    </App>
</template>
