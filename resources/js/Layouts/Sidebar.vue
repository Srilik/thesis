<script setup lang="ts">
import { useToggleSidebar } from "@/Stores/useToggleSidebar";
import TheSidebarItem from "@/Components/Layout/TheSidebarItem.vue";
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
// import { faMyIcon } from '@awesome.me/kit-KIT_CODE/icons/kit/custom';
// import { NotebookPen } from 'lucide-vue-next';
import "@fortawesome/fontawesome-free/css/all.css";

const sidebar = useToggleSidebar();
</script>
<template>
    <div class="flex text-xl print:hidden">
        <!-- Backdrop -->
        <div
            :class="sidebar.isOpen ? 'block' : 'hidden'"
            @click="sidebar.isOpen = false"
            class="fixed inset-0 z-40 transition-opacity bg-black opacity-50 lg:hidden"
        ></div>
        <!-- End Backdrop -->

        <div
            :class="
                sidebar.isOpen
                    ? 'translate-x-0 ease-out'
                    : '-translate-x-full ease-in'
            "
            class="fixed inset-y-0 left-0 z-50 overflow-y-auto text-white transition transform bg-blue-700 w-70 dark:bg-blue-900 lg:translate-x-0 lg:static lg:inset-0"
        >
            <div class="flex items-center justify-center mt-8 ml-5 mr-5">
                <div class="flex items-center justify-center space-x-4">
                    <img
                        src="/images/norton.png"
                        alt="logo"
                        class="w-20 h-20 rounded-2xl"
                    />
                    <div class="text-xl font-semibold text-center">
                        THESIS MANAGEMENT
                        <br />
                        SYSTEM
                    </div>
                </div>
            </div>

            <nav class="mt-8">
                <TheSidebarItem
                    title="Dashboard"
                    icon="fa-solid fa-house"
                    :link="route('dashboard')"
                    :is-active="$page.component === 'Dashboard'"
                />
                <TheSidebarItem
                    title="Thesis For Vatey"
                    icon="fa-solid fa-book"
                    :link="route('thesises.index')"
                    :is-active="$page.component.startsWith('Thesises/')"
                />

                <TheSidebarItem
                    title="Thesis"
                    icon="fa-solid fa-book"
                    :link="route('thesis.index')"
                    :is-active="$page.component.startsWith('Thesis/')"
                />
                <TheSidebarItem
                    title="ThesisAdvisor"
                    icon="fa-solid fa-user-tie"
                    :link="route('thesisAdvisor.index')"
                    :is-active="$page.component.startsWith('ThesisAdvisor/')"
                />
                <TheSidebarItem
                    title="ThesisCommittee"
                    icon="fa-solid fa-users"
                    :link="route('thesisCommittee.index')"
                    :is-active="$page.component.startsWith('ThesisCommittee/')"
                />
                <TheSidebarItem
                    title="ThesisDetail"
                    icon="fa-solid fa-file-alt"
                    :link="route('thesisDetail.index')"
                    :is-active="$page.component.startsWith('ThesisDetail/')"
                />
                <TheSidebarItem
                    title="Teacher"
                    icon="fa-solid fa-chalkboard-teacher"
                />
                <TheSidebarItem
                    title="Student"
                    icon="fa-solid fa-user-graduate"
                />
                <TheSidebarItem
                    title="All Advisor"
                    icon="fa-solid fa-user-tie"
                />
                <TheSidebarItem
                    title="All Committee"
                    icon="fa-solid fa-users"
                />
                <TheSidebarItem title="Student Score" icon="fa-solid fa-book" />
                <TheSidebarItem
                    title="Add Group Thesis"
                    icon="fa-solid fa-plus-square"
                />
                <TheSidebarItem
                    title="Advisor Score Report"
                    icon="fa-solid fa-chart-bar"
                />
                <TheSidebarItem
                    title="Committee List Report"
                    icon="fa-solid fa-clipboard-list"
                />
                <TheSidebarItem
                    title="Sarana Schedule Report"
                    icon="fa-solid fa-calendar"
                />
            </nav>
        </div>
    </div>
</template>
