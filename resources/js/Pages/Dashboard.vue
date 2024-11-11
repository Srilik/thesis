<script setup lang="ts">
import App from "@/Layouts/App.vue";
import CamboboxHeadless from "@/Components/CamboboxHeadless.vue";
import ModalBreeze from "@/Components/ModalBreeze.vue";
import { ref } from "vue";
const openModalThesis = ref(false);
const onCloseThesis = () => {
    openModalThesis.value = false;
};
const openModalThesisGroup = ref(false);
const onCloseThesisGroup = () => {
    openModalThesisGroup.value = false;
};
const openModalThesisAdvisor = ref(false);
const onCloseThesisAdvisor = () => {
    openModalThesisAdvisor.value = false;
};
const openModalThesisAdvisorAndCommittee = ref(false);
const onCloseThesisAdvisorAndCommittee = () => {
    openModalThesisAdvisorAndCommittee.value = false;
};
</script>
<template>
    <ModalBreeze
        :show="openModalThesis"
        :closeable="true"
        max-width="6xl"
        z-index="z-[200]"
        @close="onCloseThesis"
    >
        <!-- Form General Thesis Information -->
        <div class="p-4 mt-4 rounded-3xl bg-base-100">
            <!-- Buttons -->
            <button type="button" class="h-10 btn btn-primary btn-sm">
                General Thesis Information
            </button>
            <button type="button" class="h-10 btn btn-success btn-sm">
                Advisors and Committees
            </button>

            <!-- Form Input  -->
            <div class="flex flex-col gap-2 mt-4 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label class="label">Topic English</label>
                    <textarea class="w-full h-full input input-info">
                    </textarea>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Topic Khmer</label>
                    <textarea class="w-full h-full input input-info">
                    </textarea>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Objective English</label>
                    <textarea class="w-full h-full input input-info">
                    </textarea>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Objective Khmer</label>
                    <textarea class="w-full h-full input input-info">
                    </textarea>
                </div>
            </div>

            <!-- Headers -->
            <h2 class="mt-8 text-xl font-bold">Organizaition</h2>
            <div class="flex flex-col gap-2 mt-4 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label class="label">Name</label>
                    <input type="text" class="w-full input input-info" />
                    <div class="text-sm text-red-500">{{}}</div>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Email</label>
                    <input type="text" class="w-full input input-info" />
                    <div class="text-sm text-red-500">{{}}</div>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Phone Number</label>
                    <input type="text" class="w-full input input-info" />
                    <div class="text-sm text-red-500">{{}}</div>
                </div>
                <div class="flex flex-col w-full">
                    <label class="label">Address</label>
                    <textarea class="w-full h-full input input-info">
                    </textarea>
                </div>
            </div>

            <!-- Headers -->
            <h2 class="mt-8 text-xl font-bold">Student</h2>
            <!-- Filter Button and Input -->
            <div
                class="flex flex-col gap-2 mt-4 overflow-x-auto lg:flex-row md:w-1/3"
            >
                <!-- Input Student ID -->
                <input
                    type="text"
                    class="w-full h-10 input input-primary input-sm"
                    placeholder="Student ID"
                />
                <!-- Add button -->
                <button
                    class="w-full h-10 btn btn-primary btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-solid fa-add"></i>Add
                </button>
            </div>
            <!-- Table -->
            <div class="mt-8 overflow-x-auto border rounded-2xl">
                <table class="w-full base-table2 whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Student Name</th>
                            <th>Sex</th>
                            <th>Student ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-success btn-sm"
                                >
                                    <i class="fa-solid fa-eye"></i> View
                                </button>
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i
                                    >Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="flex flex-col justify-end gap-2 mt-4 overflow-x-auto lg:flex-row"
            >
                <!-- Save button -->
                <button
                    class="w-full h-10 btn btn-success btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-regular fa-floppy-disk"></i>Save
                </button>
                <!-- Cancel button -->
                <button
                    class="w-full h-10 btn btn-error btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-solid fa-xmark"></i>Cancel
                </button>
            </div>
        </div>
    </ModalBreeze>

    <ModalBreeze
        :show="openModalThesisGroup"
        :closeable="true"
        max-width="6xl"
        z-index="z-[200]"
        @close="onCloseThesisGroup"
    >
        <!-- Group Detail -->
        <div class="p-4 mt-4 rounded-3xl bg-base-100">
            <!-- Headers -->
            <h2 class="text-xl font-bold">Group Details</h2>

            <!-- Search and Filters -->
            <div class="w-full mt-6 mb-2 overflow-x-auto">
                <div
                    class="flex flex-col gap-2 m-1 mb-6 md:flex-row md:items-center md:justify-between"
                >
                    <!-- Start Section: Input and Dropdowns -->
                    <div class="flex gap-3 overflow-x-auto">
                        <!-- Input field -->
                        <input
                            type="text"
                            class="w-full h-10 input input-primary input-sm"
                            placeholder="Quick Search"
                        />

                        <!-- Brand dropdown -->
                        <CamboboxHeadless
                            placeholder="Group ID"
                            class="w-full h-10 border bg-base-100 border-primary"
                        />

                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Topic"
                            class="w-full h-10 border bg-base-100 border-primary"
                        />
                    </div>

                    <!-- End Section: Buttons -->
                    <div class="flex gap-3 mt-3 overflow-x-auto md:mt-0">
                        <!-- Reset button -->
                        <button
                            type="button"
                            class="h-10 btn btn-warning btn-sm md:w-auto"
                        >
                            <i class="fa-solid fa-eraser"></i>Reset
                        </button>
                        <!-- Export button -->
                        <button
                            type="button"
                            class="h-10 btn btn-success btn-sm"
                        >
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            Export
                        </button>
                        <!-- Print button -->
                        <button type="button" class="h-10 btn btn-error btn-sm">
                            <i class="fa-solid fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border rounded-2xl">
                <table class="w-full base-table2 whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Group ID</th>
                            <th>Student Name</th>
                            <th>Topic</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-success btn-sm"
                                >
                                    <i class="fa-solid fa-eye"></i> View
                                </button>
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i
                                    >Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </ModalBreeze>

    <ModalBreeze
        :show="openModalThesisAdvisor"
        :closeable="true"
        max-width="6xl"
        z-index="z-[200]"
        @close="onCloseThesisAdvisor"
    >
        <!-- Advisor Details -->
        <div class="p-4 mt-4 rounded-3xl bg-base-100">
            <!-- Headers -->
            <h2 class="text-xl font-bold">Advisor Details</h2>

            <!-- Search and Filters -->
            <div class="w-full mt-6 mb-2 overflow-x-auto">
                <div
                    class="flex flex-col gap-2 m-1 mb-6 md:flex-row md:items-center md:justify-between"
                >
                    <!-- Start Section: Input and Dropdowns -->
                    <div class="flex gap-3 overflow-x-auto">
                        <!-- Input field -->
                        <input
                            type="text"
                            class="w-full h-10 input input-primary input-sm"
                            placeholder="Quick Search"
                        />

                        <!-- Brand dropdown -->
                        <CamboboxHeadless
                            placeholder="Group ID"
                            class="w-full h-10 border bg-base-100 border-primary"
                        />

                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Advisor Name"
                            class="w-full h-10 border bg-base-100 border-primary"
                        />
                    </div>

                    <!-- End Section: Buttons -->
                    <div class="flex gap-3 mt-3 overflow-x-auto md:mt-0">
                        <!-- Reset button -->
                        <button
                            type="button"
                            class="h-10 btn btn-warning btn-sm md:w-auto"
                        >
                            <i class="fa-solid fa-eraser"></i>Reset
                        </button>
                        <!-- Export button -->
                        <button
                            type="button"
                            class="h-10 btn btn-success btn-sm"
                        >
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            Export
                        </button>
                        <!-- Print button -->
                        <button type="button" class="h-10 btn btn-error btn-sm">
                            <i class="fa-solid fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border rounded-2xl">
                <table class="w-full base-table2 whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Group ID</th>
                            <th>Advisor Name</th>
                            <th>Topic</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-success btn-sm"
                                >
                                    <i class="fa-solid fa-eye"></i> View
                                </button>
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i
                                    >Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </ModalBreeze>

    <ModalBreeze
        :show="openModalThesisAdvisorAndCommittee"
        :closeable="true"
        max-width="6xl"
        z-index="z-[200]"
        @close="onCloseThesisAdvisorAndCommittee"
    >
        <!-- Form Advisors and Committees -->
        <div class="p-4 mt-4 rounded-3xl bg-base-100">
            <!-- Headers -->
            <h2 class="mt-8 text-xl font-bold">Advisors</h2>
            <!-- Filter Button and Input -->
            <div
                class="flex flex-col gap-2 mt-4 overflow-x-auto lg:flex-row md:w-1/3"
            >
                <!-- Input Student ID -->
                <input
                    type="text"
                    class="w-full h-10 input input-primary input-sm"
                    placeholder="Advisor Name"
                />
                <!-- Add button -->
                <button
                    class="w-full h-10 btn btn-primary btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-solid fa-add"></i>Add
                </button>
            </div>
            <!-- Table -->
            <div class="mt-8 overflow-x-auto border rounded-2xl">
                <table class="w-full base-table2 whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Advisor Name</th>
                            <th>Sex</th>
                            <th>Advisor ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i
                                    >Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Headers -->
            <h2 class="mt-8 text-xl font-bold">Committees</h2>
            <!-- Filter Button and Input -->
            <div
                class="flex flex-col gap-2 mt-4 overflow-x-auto lg:flex-row md:w-1/3"
            >
                <!-- Input Student ID -->
                <input
                    type="text"
                    class="w-full h-10 input input-primary input-sm"
                    placeholder="Committee Name"
                />
                <!-- Add button -->
                <button
                    class="w-full h-10 btn btn-primary btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-solid fa-add"></i>Add
                </button>
            </div>
            <!-- Table -->
            <div class="mt-8 overflow-x-auto border rounded-2xl">
                <table class="w-full base-table2 whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Committee Name</th>
                            <th>Sex</th>
                            <th>Committee ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i
                                    >Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                class="flex flex-col justify-end gap-2 mt-4 overflow-x-auto lg:flex-row"
            >
                <!-- Save button -->
                <button
                    class="w-full h-10 btn btn-success btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-regular fa-floppy-disk"></i>Save
                </button>
                <!-- Cancel button -->
                <button
                    class="w-full h-10 btn btn-error btn-sm md:w-auto"
                    type="button"
                >
                    <i class="fa-solid fa-xmark"></i>Cancel
                </button>
            </div>
        </div>
    </ModalBreeze>
    <App>
        <!-- Dashboard -->
        <div class="p-4">
            <!-- Thesis -->
            <div class="p-4 rounded-3xl bg-base-100">
                <!-- Headers -->
                <h2 class="text-xl font-bold">
                    Thesis Management System For Health Sciences
                </h2>

                <!-- Buttons -->
                <div class="flex gap-3 mt-6 mb-6 overflow-x-auto">
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="openModalThesis = true"
                    >
                        <i class="fa-solid fa-book"></i>Thesis
                    </button>
                    <button
                        type="button"
                        class="btn btn-success"
                        @click="openModalThesisGroup = true"
                    >
                        <i class="fa-solid fa-user-group"></i>Groups
                    </button>
                    <button
                        type="button"
                        class="btn btn-error"
                        @click="openModalThesisAdvisor = true"
                    >
                        <i class="fa-solid fa-user-tie"></i>Advisors
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="openModalThesisAdvisorAndCommittee = true"
                    >
                        <i class="fa-solid fa-clipboard-list"></i>Thesis Report
                    </button>
                </div>

                <!-- Search and Filters -->
                <div class="w-full overflow-x-auto md">
                    <div
                        class="flex flex-col items-center gap-2 m-1 mb-6 md:flex-row"
                    >
                        <!-- Input field -->
                        <input
                            type="text"
                            class="w-full h-10 input input-primary input-sm"
                            placeholder="Quick Search"
                        />

                        <!-- Brand dropdown -->
                        <CamboboxHeadless
                            placeholder="Student ID"
                            class="w-full h-10 bg-base-100 border-primary"
                        />

                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Advisors"
                            class="w-full h-10 bg-base-100 border-primary"
                        />
                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Groups"
                            class="w-full h-10 bg-base-100 border-primary"
                        />
                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Years"
                            class="w-full h-10 bg-base-100 border-primary"
                        />
                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Majors"
                            class="w-full h-10 bg-base-100 border-primary"
                        />
                        <!-- Category dropdown -->
                        <CamboboxHeadless
                            placeholder="Academics"
                            class="w-full h-10 bg-base-100 border-primary"
                        />
                        <input
                            type="text"
                            class="w-full h-10 input input-primary input-sm"
                            placeholder="Batch"
                        />

                        <!-- Reset button -->
                        <button
                            class="w-full h-10 btn btn-warning btn-sm md:w-auto"
                            type="button"
                        >
                            <i class="fa-solid fa-eraser"></i>Reset
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto border rounded-2xl">
                    <table class="w-full base-table2 whitespace-nowrap">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Topic</th>
                                <th>Year</th>
                                <th>Major</th>
                                <th>Advisors</th>
                                <th>Students</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-center">{{}}</td>
                                <td class="text-center">{{}}</td>
                                <td class="text-center">{{}}</td>
                                <td class="text-center">{{}}</td>
                                <td class="text-center">{{}}</td>
                                <td class="text-center">{{}}</td>
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="mr-2 btn btn-warning btn-sm"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i
                                        >Edit
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-error btn-sm"
                                    >
                                        <i class="fa-solid fa-trash-can"></i
                                        >Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </App>
</template>

<!-- <template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template> -->
