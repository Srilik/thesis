<script setup lang="ts">
import { defineAsyncComponent } from "vue";

const props = defineProps<{ name: string }>();

const icon = defineAsyncComponent({
    loader: () => import(`../assets/svg/${props.name}.svg`),
});
</script>
<template>
    <component :is="icon" />
</template>
