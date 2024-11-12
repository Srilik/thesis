<script setup lang="ts">
import { TransitionRoot } from "@headlessui/vue";
import { onMounted } from "vue";
import { ref } from "vue";

interface Props {
    delay?: number;
}

const props = withDefaults(defineProps<Props>(), {
    delay: 0,
});

const isAnimated = ref(false);
onMounted(() => {
    if (props.delay > 0) {
        setTimeout(() => {
            isAnimated.value = true;
        }, props.delay);
    }

    isAnimated.value = true;
});
</script>
<template>
    <TransitionRoot
        :show="isAnimated"
        enter="transition ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition ease-in duration-300"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <slot />
    </TransitionRoot>
</template>
