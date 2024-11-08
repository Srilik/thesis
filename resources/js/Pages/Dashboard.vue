<script setup lang="ts">
import App from "@/Layouts/App.vue";
import CamboboxHeadless from "@/Components/CamboboxHeadless.vue";
</script>
<template>
    <App>
        <!-- <div class="mt-20 text-3xl text-center">
            <h1>WELCOME TO DASHBOARD THESIS MANAGEMENT SYSTEM</h1>
        </div> -->

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
                    <button type="button" class="btn btn-primary">
                        <i class="fa-solid fa-book"></i>Thesis
                    </button>
                    <button type="button" class="btn btn-success">
                        <i class="fa-solid fa-user-group"></i>Groups
                    </button>
                    <button type="button" class="btn btn-error">
                        <i class="fa-solid fa-user-tie"></i>Advisors
                    </button>
                    <button type="button" class="btn btn-primary">
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
                            <button
                                type="button"
                                class="h-10 btn btn-error btn-sm"
                            >
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
                                        <i class="fa-solid fa-trash-can"></i
                                        >Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

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
                            <button
                                type="button"
                                class="h-10 btn btn-error btn-sm"
                            >
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
                                        <i class="fa-solid fa-trash-can"></i
                                        >Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form General Thesis Information -->
            <div class="p-4 mt-4 rounded-3xl bg-base-100">
                <!-- Headers -->
                <button type="button" class="h-10 btn btn-primary btn-sm">
                    General Thesis Information
                </button>
                <button type="button" class="h-10 btn btn-primary btn-sm">
                    Advisors and Committees
                </button>
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
                            <button
                                type="button"
                                class="h-10 btn btn-error btn-sm"
                            >
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
                                        <i class="fa-solid fa-trash-can"></i
                                        >Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Advisors and Committees -->
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
                            <button
                                type="button"
                                class="h-10 btn btn-error btn-sm"
                            >
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
