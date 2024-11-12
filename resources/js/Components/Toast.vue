<script setup lang="ts">
import { XCircleIcon } from "@heroicons/vue/20/solid";
import { computed, ref } from "vue";
import { watch } from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        required: false,
        default: true,
    },
    isAutoClose: {
        type: Boolean,
        required: false,
        default: true,
    },
});

const show = ref(props.show);

const emit = defineEmits(["close"]);
const close = () => {
    emit("close");
    show.value = false;
};

watch(
    () => props.show,
    (value) => {
        show.value = value;
        if (value && props.isAutoClose) {
            setTimeout(() => {
                close();
            }, 5000);
        }
    },
);

const showComputed = computed(() => show.value);
</script>
<template>
    <!--Create left bottom toast with tailwindCss-->
    <template v-if="showComputed">
        <div
            class="fixed left-5 bottom-5 bg-white max-w-md rounded-xl p-4 z-[10000] shadow-md border"
        >
            <div class="flex items-center justify-between gap-4">
                <div class="shrink-0">
                    <slot name="icon"></slot>
                </div>
                <div class="w-full">
                    <slot />
                </div>
                <button class="shrink-0" @click.prevent="close">
                    <XCircleIcon class="w-6 text-gray-500" />
                </button>
            </div>
        </div>
    </template>
</template>
