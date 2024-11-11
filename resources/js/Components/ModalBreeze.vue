<script setup lang="ts">
import { computed, onMounted, onUnmounted, watch } from "vue";

const props = withDefaults(
  defineProps<{
    show?: boolean;
    maxWidth?:
      | "sm"
      | "md"
      | "lg"
      | "xl"
      | "2xl"
      | "3xl"
      | "4xl"
      | "5xl"
      | "6xl"
      | "7xl"
      | "full"
      | string;
    closeable?: boolean;
    zIndex?: string;
    isNoPadding?: boolean;
  }>(),
  {
    show: false,
    maxWidth: "2xl",
    closeable: true,
    zIndex: "z-50",
    isNoPadding: false,
  },
);

const emit = defineEmits(["close"]);

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "visible";
    }
  },
);

const close = () => {
  if (props.closeable) {
    emit("close");
  }
};

const closeOnEscape = (e: KeyboardEvent) => {
  if (e.key === "Escape" && props.show) {
    close();
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
  document.removeEventListener("keydown", closeOnEscape);
  document.body.style.overflow = "visible";
});

const maxWidthClass = computed(() => {
  return {
    sm: "sm:max-w-sm",
    md: "sm:max-w-md",
    lg: "sm:max-w-lg",
    xl: "sm:max-w-xl",
    "2xl": "sm:max-w-2xl",
    "3xl": "sm:max-w-3xl",
    "4xl": "sm:max-w-4xl",
    "5xl": "sm:max-w-5xl",
    "6xl": "sm:max-w-6xl",
    "7xl": "sm:max-w-7xl",
    full: "sm:max-w-full",
  }[props.maxWidth];
});
</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-100">
      <div
        v-show="show"
        :class="[
          'fixed inset-0 px-4  sm:px-0  overflow-y-auto snap-both',
          zIndex,
        ]"
        scroll-region
      >
        <Transition
          enter-active-class="ease-out duration-100"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-100"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div
            v-if="show"
            class="fixed inset-0 transform transition-all"
            @click="close"
          >
            <div
              class="absolute inset-0 bg-gray-900 dark:bg-black opacity-75"
            />
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-100"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-100"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-if="show"
            class="mb-6 rounded-lg shadow-xl transform transition-all sm:w-full sm:mx-auto"
            :class="[
              maxWidthClass ? maxWidthClass : maxWidth,
              { 'p-2 bg-base-100': !isNoPadding },
            ]"
          >
            <slot v-if="show" />
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
