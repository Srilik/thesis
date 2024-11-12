<script setup lang="ts">
import { onErrorCaptured, ref } from "vue";
import { ArrowPathIcon } from "@heroicons/vue/20/solid";

const hasError = ref(false);
const errorMessage = ref("");

onErrorCaptured((error) => {
    hasError.value = true;
    errorMessage.value = error.message;
    // console.error(error);
    return false;
});

const resetError = () => {
    hasError.value = false;
    errorMessage.value = "";
};
</script>
<template>
    <div
        v-if="hasError"
        class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg"
        role="alert"
    >
        <h1 class="font-bold">Oops! Something went wrong.</h1>
        <p>{{ errorMessage }}</p>
        <button
            class="absolute inset-y-0 right-0 flex items-center btn btn-sm"
            @click.prevent="resetError"
        >
            Try again <ArrowPathIcon class="w-5 h-5 ml-1" />
        </button>
    </div>
    <slot v-else />
</template>
