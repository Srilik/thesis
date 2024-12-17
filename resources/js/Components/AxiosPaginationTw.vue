<script setup lang="ts">
import useAxios from "@/Composables/useAxios";
import { PaginateType, ResourcePaginateType } from "@/types/paginateType";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";

const props = defineProps<{
  links: {
    url: string | null;
    label: string;
    active: boolean;
  }[];
  currentPage?: number;
  lastPage?: number;
  nextPageUrl?: string | null;
  prevPageUrl?: string | null;
  perPage?: number;
  total?: number;
  from?: number;
  to?: number;
  method?: "get" | "post" | string;
}>();

// const props = defineProps({
//   links: {
//     type: Array as PropType<any[]>,
//     required: false,
//   },
//   currentPage: {
//     type: Number as PropType<number>,
//     required: false,
//   },
//   lastPage: {
//     type: Number as PropType<number>,
//     required: false,
//   },
//   nextPageUrl: {
//     type: String as PropType<string | null>,
//     required: false,
//   },
//   prevPageUrl: {
//     type: String as PropType<string | null>,
//     required: false,
//   },
//   perPage: {
//     type: Number as PropType<number>,
//     required: false,
//   },
//   total: {
//     type: Number as PropType<number>,
//     required: false,
//   },
//   from: {
//     type: Number as PropType<number>,
//     required: false,
//   },
//   to: {
//     type: Number as PropType<number>,
//     required: false,
//   },

//   method: {
//     type: String as PropType<"get" | "post" | string>,
//     required: false,
//     default: "get",
//   },
// });

const emit = defineEmits(["update:data"]);

const { fetch } = useAxios();

const getDataFromUrl = async (url: string) => {
  const { data } = await fetch<
    PaginateType<Object> | ResourcePaginateType<Object>
  >(url, {
    method: props.method,
  });

  emit("update:data", data);
};
</script>

<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div
    class="flex items-center justify-between px-4 py-3 rounded-xl bg-base-100 sm:px-6"
  >
    <div class="flex justify-between flex-1 sm:hidden">
      <button
        v-if="!!prevPageUrl"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md bg-base-100 dark:text-gray-200 hover:bg-gray-50"
        @click.prevent="getDataFromUrl(prevPageUrl)"
      >
        Previous
      </button>
      <button
        v-else
        type="button"
        :disabled="true"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md bg-base-100 dark:text-gray-200 hover:bg-gray-50 disabled:opacity-50"
      >
        Previous
      </button>
      <button
        v-if="!!nextPageUrl"
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 border border-gray-300 rounded-md bg-base-100 dark:text-gray-200 hover:bg-gray-50"
        @click.prevent="getDataFromUrl(nextPageUrl)"
      >
        Next
      </button>
      <button
        v-else
        type="button"
        :disabled="true"
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 border border-gray-300 rounded-md bg-base-100 dark:text-gray-200 hover:bg-gray-50 disabled:opacity-50"
      >
        Next
      </button>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700 dark:text-gray-200">
          Showing
          {{ " " }}
          <span class="font-medium">{{ from }}</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium">{{ to }}</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium">{{ total }}</span>
          {{ " " }}
          results
        </p>
      </div>
      <div>
        <nav
          class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
          aria-label="Pagination"
        >
          <template v-for="(link, index) in links" :key="index">
            <button
              v-if="link.label.endsWith('Previous') && link.url"
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border border-gray-300 rounded-l-md dark:border-gray-700 bg-base-100 hover:bg-gray-50"
              @click.prevent="getDataFromUrl(link.url)"
            >
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="w-5 h-5" aria-hidden="true" />
            </button>
            <button
              v-else-if="link.label.endsWith('Previous') && !link.url"
              type="button"
              disabled
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border border-gray-300 rounded-l-md dark:border-gray-700 bg-base-100 hover:bg-gray-50 disabled:opacity-50"
            >
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="w-5 h-5" aria-hidden="true" />
            </button>
            <template
              v-if="
                !link.label.endsWith('Previous') &&
                !link.label.startsWith('Next')
              "
            >
              <!-- Current: "z-10 bg-brand-50 border-brand-500 text-primary", Default: "bg-base-100 border-gray-300 text-gray-500 hover:bg-gray-50" -->
              <button
                v-if="link.active === false"
                :class="[
                  'relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium border-gray-300 dark:border-gray-700',
                  'bg-base-100 text-gray-500',
                ]"
                @click.prevent="getDataFromUrl(link.url)"
              >
                {{ link.label }}
              </button>
              <span
                v-if="link.active"
                :class="[
                  'cursor-not-allowed',
                  'relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium border-gray-300 dark:border-gray-700',
                  'bg-primary text-white',
                ]"
              >
                {{ link.label }}
              </span>
            </template>
            <button
              v-else-if="link.label.startsWith('Next') && link.url"
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium border border-gray-300 rounded-r-md dark:border-gray-700 hover:bg-gray-50"
              @click.prevent="getDataFromUrl(link.url)"
            >
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="w-5 h-5" aria-hidden="true" />
            </button>
            <button
              v-else-if="link.label.startsWith('Next') && !link.url"
              type="button"
              disabled
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium border border-gray-300 rounded-r-md dark:border-gray-700 hover:bg-gray-50 disabled:opacity-50"
            >
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="w-5 h-5" aria-hidden="true" />
            </button>
          </template>
        </nav>
      </div>
    </div>
  </div>
</template>
