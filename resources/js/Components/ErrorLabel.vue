<script setup>
defineProps({
    error: String,
});
</script>

<template>
    <div class="mt-1 text-sm italic text-red-600" v-if="error">
        {{ error }}
    </div>
</template>
