<script setup lang="ts">
import { type PropType } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { watch } from "vue";
import { computed } from "vue";
import { PaginateType } from "@/types/paginateType";
import { ResourcePaginateType } from "@/types/ResourcePaginateType";

interface Props {
  paginateData: PaginateType<any> | ResourcePaginateType<any>;
  isResource?: boolean;
  only?: string[];
}

const props = defineProps<Props>();

const data = computed<{
  links: {
    url: string | null;
    label: string;
    active: boolean;
  }[];
  currentPage: number;
  lastPage: number;
  nextPageUrl: string | null;
  prevPageUrl: string | null;
  perPage: number;
  total: number;
  from: number;
  to: number;
}>(() => {
  if (props.isResource) {
    const resourcePaginateData =
      props.paginateData as ResourcePaginateType<any>;
    return {
      links: resourcePaginateData.meta.links,
      currentPage: resourcePaginateData.meta.current_page,
      lastPage: resourcePaginateData.meta.last_page,
      nextPageUrl: resourcePaginateData.links.next,
      prevPageUrl: resourcePaginateData.links.prev,
      perPage: resourcePaginateData.meta.per_page,
      total: resourcePaginateData.meta.total,
      from: resourcePaginateData.meta.from,
      to: resourcePaginateData.meta.to,
    };
  }
  const paginateData = props.paginateData as PaginateType<any>;
  return {
    links: paginateData.links,
    currentPage: paginateData.current_page,
    lastPage: paginateData.last_page,
    nextPageUrl: paginateData.next_page_url,
    prevPageUrl: paginateData.prev_page_url,
    perPage: paginateData.per_page,
    total: paginateData.total,
    from: paginateData.from,
    to: paginateData.to,
  };
});
</script>

<template>
  <div
    class="flex items-center justify-between rounded-xl bg-base-100 px-4 py-3 print:hidden sm:px-6"
  >
    <div class="flex flex-1 justify-between sm:hidden">
      <Link
        v-if="!!data.prevPageUrl"
        preserve-state
        :only="only"
        :preserve-scroll="false"
        :href="data.prevPageUrl"
        class="relative inline-flex items-center rounded-md border border-gray-300 bg-base-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200"
      >
        Previous
      </Link>
      <button
        v-else
        type="button"
        :disabled="true"
        class="relative inline-flex items-center rounded-md border border-gray-300 bg-base-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 dark:text-gray-200"
      >
        Previous
      </button>
      <Link
        v-if="!!data.nextPageUrl"
        preserve-state
        :only="only"
        :preserve-scroll="false"
        :href="data.nextPageUrl"
        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-base-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200"
      >
        Next
      </Link>
      <button
        v-else
        type="button"
        :disabled="true"
        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-base-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 dark:text-gray-200"
      >
        Next
      </button>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700 dark:text-gray-200">
          Showing
          {{ " " }}
          <span class="font-medium">{{ data.from }}</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium">{{ data.to }}</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium">{{ data.total }}</span>
          {{ " " }}
          results
        </p>
      </div>
      <div>
        <nav
          class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
          aria-label="Pagination"
        >
          <template v-for="(link, index) in data.links" :key="index">
            <Link
              v-if="link.label.endsWith('Previous') && link.url"
              preserve-state
              :only="only"
              :preserve-scroll="false"
              :href="link.url"
              class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-base-100 px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:border-gray-700"
            >
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </Link>
            <button
              v-else-if="link.label.endsWith('Previous') && !link.url"
              type="button"
              disabled
              class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-base-100 px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700"
            >
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </button>
            <!-- Current: "z-10 bg-brand-50 border-brand-500 text-primary", Default: "bg-base-100 border-gray-300 text-gray-500 hover:bg-gray-50" -->
            <Link
              v-if="
                !link.label.endsWith('Previous') &&
                !link.label.startsWith('Next') &&
                link.url
              "
              preserve-state
              :only="only"
              :href="link.url"
              :preserve-scroll="false"
              :class="[
                'relative z-10 inline-flex items-center border border-gray-300 px-4 py-2 text-sm font-medium dark:border-gray-700',
                link.active
                  ? 'bg-brand-200 text-primary dark:bg-brand-900 dark:text-brand-100'
                  : 'bg-base-100 text-gray-500',
              ]"
            >
              {{ link.label }}
            </Link>
            <span
              v-if="
                !link.label.endsWith('Previous') &&
                !link.label.startsWith('Next') &&
                !link.url
              "
              :class="[
                'relative z-10 inline-flex items-center border border-gray-300 px-4 py-2 text-sm font-medium dark:border-gray-700',
                link.active
                  ? 'bg-brand-200 text-primary dark:bg-brand-900 dark:text-brand-100'
                  : 'bg-base-100 text-gray-500',
              ]"
            >
              {{ link.label }}
            </span>
            <Link
              v-if="link.label.startsWith('Next') && link.url"
              preserve-state
              :only="only"
              :preserve-scroll="false"
              :href="link.url"
              class="relative inline-flex items-center rounded-r-md border border-gray-300 px-2 py-2 text-sm font-medium hover:bg-gray-50 dark:border-gray-700"
            >
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </Link>
            <button
              v-else-if="link.label.startsWith('Next') && !link.url"
              type="button"
              disabled
              class="relative inline-flex items-center rounded-r-md border border-gray-300 px-2 py-2 text-sm font-medium hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700"
            >
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </button>
          </template>
        </nav>
      </div>
    </div>
  </div>
</template>
