<script setup lang="ts">
import { type PropType, ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {
    Moon,
    Sun,
    Bell,
    ChevronRightSquare,
    ChevronLeftSquare,
} from "lucide-vue-next";

import { onMounted, onUnmounted, computed } from "vue";
import { useToggleSidebar } from "@/Stores/useToggleSidebar";

const sidebar = useToggleSidebar();

const page = usePage();

const user = computed(() => page.props.auth.user);

defineProps({
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

const dropdownOpen = ref(false);

const appTheme = ref("light");

const toggleTheme = () => {
    if (appTheme.value === "light") {
        appTheme.value = "dark";
        document.documentElement.classList.add("dark");
        document.documentElement.setAttribute("data-theme", "sunset");
        // set localStorage

        localStorage.setItem("theme", "dark");
    } else {
        appTheme.value = "light";
        document.documentElement.classList.remove("dark");
        document.documentElement.setAttribute("data-theme", "light");
        // set localStorage
        localStorage.setItem("theme", "light");
    }
};

onMounted(() => {
    const theme = localStorage.getItem("theme");
    if (theme) {
        appTheme.value = theme;
        if (theme === "dark") {
            document.documentElement.classList.add("dark");
            document.documentElement.setAttribute("data-theme", "sunset");
        }
    }
});

const logout = () => {
    router.post(route("logout"));
};

let input = ref<string>("");
const fruits: string[] = ["apple", "banana", "orange", "grape", "mango"];
let selectedIndex = ref<number>(-1);
// Function to filter the fruits based on the search input
function filteredList() {
    return fruits.filter((fruit) =>
        fruit.toLowerCase().includes(input.value.toLowerCase()),
    );
}
// Handling up and down arrow key navigation
function handleKeydown(event: KeyboardEvent) {
    const filteredFruits = filteredList();

    if (event.key === "ArrowDown") {
        if (selectedIndex.value < filteredFruits.length - 1) {
            selectedIndex.value++;
        }
    } else if (event.key === "ArrowUp") {
        if (selectedIndex.value > 0) {
            selectedIndex.value--;
        }
    } else if (event.key === "Enter" && selectedIndex.value >= 0) {
        // Set the input to the selected fruit
        input.value = filteredFruits[selectedIndex.value];
        selectedIndex.value = -1; // Reset index after selection
    }
}
onMounted(() => {
    window.addEventListener("keydown", handleKeydown);
});
onUnmounted(() => {
    window.removeEventListener("keydown", handleKeydown);
});
</script>

<template>
    <!-- {{ user }} -->
    <!-- {{ page }} -->
    <header
        class="flex items-center justify-between px-6 py-2 bg-white border-b-4 rounded-t-2xl border-primary dark:border-darkPrimary dark:bg-slate-900/75 dark:text-gray-100"
    >
        <div class="flex items-center">
            <button
                class="mr-2 text-gray-500 focus:outline-none lg:hidden"
                @click="sidebar.toggle"
            >
                <ChevronLeftSquare
                    v-if="sidebar.isOpen"
                    class="w-6 h-6 dark:text-gray-100"
                />
                <ChevronRightSquare v-else class="w-6 h-6 dark:text-gray-100" />
            </button>

            <div class="relative mx-4 lg:mx-0">
                <div class="max-w-3xl text-sm breadcrumbs">
                    <ul>
                        <li>
                            <Link href="#">Home</Link>
                        </li>
                        <li
                            v-for="(breadcrumb, index) in breadcrumbs"
                            :key="index"
                        >
                            <Link href="#">{{ breadcrumb.name }}</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="center-header"></div>
        <div class="flex items-center">
            <!-- Search input and dropdown container -->
            <div class="relative w-full max-w-xs mr-5">
                <!-- Search input -->
                <input
                    v-model="input"
                    type="text"
                    class="w-auto rounded-md text-md bg-base-100 input-sm input input-primary"
                    placeholder="Search Thesis Topic..."
                />
                <!-- Results dropdown -->
                <div
                    v-if="input && filteredList().length"
                    class="absolute z-50 w-full p-2 rounded-md shadow-lg bg-base-100"
                >
                    <div
                        v-for="(fruit, index) in filteredList()"
                        :key="fruit"
                        class="p-2 mb-2 rounded-md cursor-pointer bg-base-100"
                        :class="[
                            index === selectedIndex
                                ? 'bg-blue-500'
                                : 'bg-blue-400',
                            'hover:bg-blue-400',
                        ]"
                    >
                        <p>{{ fruit }}</p>
                    </div>
                </div>
                <!-- No results found -->
                <div
                    class="absolute z-50 w-full p-2 bg-red-500 rounded-md bg-base-100"
                    v-if="input && !filteredList().length"
                >
                    <p>No results found!</p>
                </div>
            </div>
            <div class="mr-2 uppercase">
                {{ user.name }}
            </div>
            <button
                class="flex mr-3 text-gray-600 transition-all duration-500 ease-in transform dark:text-gray-400"
                :class="appTheme === 'dark' ? 'rotate-[360deg]' : 'rotate-0'"
                @click="toggleTheme"
            >
                <Moon
                    v-if="appTheme === 'dark'"
                    class="w-6 dark:text-gray-100"
                />
                <Sun v-else class="w-6 h-6 dark:text-gray-100" />
            </button>
            <button
                class="flex mr-3 text-gray-600 focus:outline-none dark:text-gray-400"
            >
                <Bell class="w-6 h-6 dark:text-gray-100" />
            </button>
            <div class="relative">
                <button
                    class="relative z-10 block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                    @click="dropdownOpen = !dropdownOpen"
                >
                    <!-- <img
                        :src="userAuth.profile_image"
                        class="object-cover w-full h-full"
                        alt="Your avatar"
                    /> -->
                    <ApplicationLogo class="object-cover w-full h-full" />
                </button>

                <div
                    v-show="dropdownOpen"
                    class="fixed inset-0 z-10 w-full h-full"
                    @click="dropdownOpen = false"
                ></div>

                <transition
                    enter-active-class="transition duration-150 ease-out transform"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-in transform"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div
                        v-show="dropdownOpen"
                        class="absolute right-0 z-30 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-slate-900/75"
                    >
                        <Link
                            href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white dark:text-gray-300"
                        >
                            Profile
                        </Link>
                        <!-- <Link
                            href="#"
                            method="post"
                            as="button"
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-primary hover:text-white dark:text-gray-100"
                        >
                            Log out
                        </Link> -->
                        <button
                            @click.prevent="logout"
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-primary hover:text-white dark:text-gray-100"
                        >
                            Log out
                        </button>
                    </div>
                </transition>
            </div>
        </div>
    </header>
</template>

<!-- <script setup>
const props = defineProps({
    headerText: {
        type: String,
        default: "Header"
    }
})
const emit = defineEmits(["clickFromHeaderButn"]);

</script>
<template>
    <header>
        <h1>{{ headerText }}</h1>
        <button @click="emit('clickFromHeaderButn')">Click me</button>
    </header>
</template> -->
