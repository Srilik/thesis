<script setup lang="ts">
import Header from "@/Layouts/Header.vue";
import Sidebar from "@/Layouts/Sidebar.vue";
import { ref, watch, type PropType } from "vue";
// import TheFirstLogin from "@pages/Staff/Partials/TheFirstLogin.vue";
import { useOnline } from "@vueuse/core";
import { WifiIcon } from "@heroicons/vue/24/solid";

import Toast from "@/Components/Toast.vue";
import { debounce } from "lodash";
import { router, usePage } from "@inertiajs/vue3";
import ErrorBoundary from "@/Components/ErrorBoundary.vue";
import { computed } from "vue";
import Animate from "@/Components/Animate.vue";

const props = defineProps({
    breadcrumbs: {
        type: Array as PropType<
            {
                name: string;
                url: string;
            }[]
        >,
        required: false,
        default: () => [],
    },
});

const online = useOnline();
const showToaster = ref(false);
// check if online
watch(
    online,
    debounce(() => {
        showToaster.value = true;
        if (online.value) {
            setTimeout(() => {
                showToaster.value = false;
            }, 3000);
        }
    }, 150),
);
const refresh = () => {
    router.reload();
};

const breadcrumbsComputed = computed<
    {
        name: string;
        url: string;
    }[]
>(() => {
    return props.breadcrumbs?.length === 3
        ? usePage().props.breadcrumbs
        : props.breadcrumbs;
});
</script>

<template>
    <div>
        <!--  <div class="flex h-screen p-1 bg-primary dark:bg-darkPrimary">-->
        <div class="flex h-svh bg-base-200">
            <ErrorBoundary>
                <Sidebar />
            </ErrorBoundary>
            <div class="flex flex-col justify-start flex-1 overflow-hidden">
                <ErrorBoundary>
                    <Header :breadcrumbs="breadcrumbsComputed">
                        <slot name="header" />
                    </Header>
                </ErrorBoundary>
                <main
                    id="full-screen-main"
                    class="relative flex-1 px-2 pb-2 overflow-x-hidden overflow-y-auto scroll-smooth bg-base-200"
                    scroll-region
                >
                    <div
                        class="mb-10 bg-gray-100 rounded-3xl dark:bg-gray-950 lg:mb-0 rounded-b-2xl"
                    >
                        <Animate><slot /></Animate>
                    </div>
                    <svg
                        class="fixed right-0 z-10 w-5 h-5 rotate-90 text-base-200 bottom-2"
                        xmlns="http://www.w3.org/2000/svg"
                        width="259.51"
                        height="259.52"
                        viewBox="0 0 259.51 259.52"
                    >
                        <path
                            id="Path_143"
                            data-name="Path 143"
                            d="M8659.507,423.965c-.167-2.608.05-5.319-.19-8.211-.084-1.012-.031-2.15-.118-3.12-.113-1.25-.1-2.682-.236-4.061-.172-1.722-.179-3.757-.365-5.394-.328-2.889-.478-5.857-.854-8.61-.509-3.714-.825-7.252-1.38-10.543-.934-5.535-2.009-11.312-3.189-16.692-.855-3.9-1.772-7.416-2.752-11.2-1.1-4.256-2.394-8.149-3.687-12.381-1.1-3.615-2.366-6.893-3.623-10.493-1.3-3.739-2.917-7.26-4.284-10.7-1.708-4.295-3.674-8.078-5.485-12.023-1.145-2.493-2.5-4.932-3.727-7.387-1.318-2.646-2.9-5.214-4.152-7.518-1.716-3.16-3.517-5.946-5.274-8.873-1.692-2.818-3.589-5.645-5.355-8.334-2.326-3.542-4.637-6.581-7.039-9.848-2.064-2.809-4.017-5.255-6.088-7.828-2.394-2.974-4.937-5.936-7.292-8.589-3.027-3.411-6.049-6.744-9.055-9.763-2.4-2.412-4.776-4.822-7.108-6.975-3-2.767-5.836-5.471-8.692-7.854-3.332-2.779-6.657-5.663-9.815-8.028-2.958-2.216-5.784-4.613-8.7-6.6-3.161-2.159-6.251-4.414-9.219-6.254-3.814-2.365-7.533-4.882-11.168-6.89-4.213-2.327-8.513-4.909-12.478-6.834-4.61-2.239-9.234-4.619-13.51-6.416-4.1-1.725-8.11-3.505-11.874-4.888-4.5-1.652-8.506-3.191-12.584-4.47-6.045-1.9-12.071-3.678-17.431-5-9.228-2.284-17.608-3.757-24.951-4.9-7.123-1.112-13.437-1.64-18.271-2.035l-2.405-.2c-1.638-.136-3.508-.237-4.633-.3a115.051,115.051,0,0,0-12.526-.227h259.51Z"
                            transform="translate(-8399.997 -164.445)"
                            fill="currentColor"
                        />
                    </svg>
                    <svg
                        class="fixed z-10 w-5 h-5 rotate-180 bottom-2 text-base-200"
                        xmlns="http://www.w3.org/2000/svg"
                        width="259.51"
                        height="259.52"
                        viewBox="0 0 259.51 259.52"
                    >
                        <path
                            id="Path_143"
                            data-name="Path 143"
                            d="M8659.507,423.965c-.167-2.608.05-5.319-.19-8.211-.084-1.012-.031-2.15-.118-3.12-.113-1.25-.1-2.682-.236-4.061-.172-1.722-.179-3.757-.365-5.394-.328-2.889-.478-5.857-.854-8.61-.509-3.714-.825-7.252-1.38-10.543-.934-5.535-2.009-11.312-3.189-16.692-.855-3.9-1.772-7.416-2.752-11.2-1.1-4.256-2.394-8.149-3.687-12.381-1.1-3.615-2.366-6.893-3.623-10.493-1.3-3.739-2.917-7.26-4.284-10.7-1.708-4.295-3.674-8.078-5.485-12.023-1.145-2.493-2.5-4.932-3.727-7.387-1.318-2.646-2.9-5.214-4.152-7.518-1.716-3.16-3.517-5.946-5.274-8.873-1.692-2.818-3.589-5.645-5.355-8.334-2.326-3.542-4.637-6.581-7.039-9.848-2.064-2.809-4.017-5.255-6.088-7.828-2.394-2.974-4.937-5.936-7.292-8.589-3.027-3.411-6.049-6.744-9.055-9.763-2.4-2.412-4.776-4.822-7.108-6.975-3-2.767-5.836-5.471-8.692-7.854-3.332-2.779-6.657-5.663-9.815-8.028-2.958-2.216-5.784-4.613-8.7-6.6-3.161-2.159-6.251-4.414-9.219-6.254-3.814-2.365-7.533-4.882-11.168-6.89-4.213-2.327-8.513-4.909-12.478-6.834-4.61-2.239-9.234-4.619-13.51-6.416-4.1-1.725-8.11-3.505-11.874-4.888-4.5-1.652-8.506-3.191-12.584-4.47-6.045-1.9-12.071-3.678-17.431-5-9.228-2.284-17.608-3.757-24.951-4.9-7.123-1.112-13.437-1.64-18.271-2.035l-2.405-.2c-1.638-.136-3.508-.237-4.633-.3a115.051,115.051,0,0,0-12.526-.227h259.51Z"
                            transform="translate(-8399.997 -164.445)"
                            fill="currentColor"
                        />
                    </svg>
                    <div class="fixed bottom-0 w-full p-1 bg-base-200"></div>
                </main>
            </div>
        </div>
        <ErrorBoundary>
            <TheFirstLogin />
        </ErrorBoundary>
        <template v-if="showToaster">
            <Toast @close="showToaster = false">
                <template #icon>
                    <WifiIcon
                        class="w-6"
                        :class="online ? 'text-green-500' : 'text-gray-500'"
                    />
                </template>
                <template v-if="!online">
                    <div class="flex items-center gap-2">
                        <p class="text-gray-500">You are currently offline.</p>
                        <button
                            type="button"
                            class="text-blue-600 btn btn-ghost btn-secondary btn-sm"
                            @click.prevent="refresh"
                        >
                            Refresh...
                        </button>
                    </div>
                </template>
                <template v-else>
                    <div>Your internet connection was restored.</div>
                </template>
            </Toast>
        </template>
    </div>
</template>

<!-- <script setup lang="ts">
import Header from "@/Layouts/Header.vue";
import Sidebar from "@/Layouts/Sidebar.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed, PropType } from "vue";
const props = defineProps({
    breadcrumbs: {
        type: Array as PropType<
            {
                name: string;
                url: string;
            }[]
        >,
        required: false,
        default: () => [],
    },
});

const breadcrumbsComputed = computed<
    {
        name: string;
        url: string;
    }[]
>(() => {
    return props.breadcrumbs?.length === 0
        ? usePage().props.breadcrumbs
        : props.breadcrumbs;
});
</script>
<template>
    <Head>
        <title>Dasboard</title>
    </Head>

    <div class="flex h-screen p-3 bg-blue-700 dark:bg-blue-900">
        <Sidebar />
        <div class="flex flex-col flex-1 overflow-hidden">
            <Header :breadcrumbs="breadcrumbsComputed">
                <slot name="header" />
            </Header>
            <main
                id="full-screen-main"
                class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-slate-800 scroll-smooth rounded-b-2xl dark:text-white"
                scroll-region
            >
                <div>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template> -->
