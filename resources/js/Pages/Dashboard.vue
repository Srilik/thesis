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
            <!-- Headers -->
            <h2 class="text-xl font-bold">Thesis Management System For</h2>

            <!-- Buttons -->
            <div class="flex gap-3 mt-6 mb-6 overflow-x-auto">
                <button type="button" class="btn btn-primary">
                    <Plus class="w-5 h-5" />Thesis
                </button>
                <button type="button" class="btn btn-success">Groups</button>
                <button type="button" class="btn btn-error">Advisors</button>
                <button type="button" class="btn btn-primary">
                    Thesis Report
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="w-full overflow-x-auto md:w-1/2">
                <div
                    class="flex flex-col items-center gap-2 m-1 mb-6 md:flex-row"
                >
                    <!-- Input field -->
                    <!-- <input
                        type="text"
                        class="w-full h-10 input input-primary input-sm"
                        placeholder="Quick Search"
                    /> -->

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

                    <!-- Reset button -->
                    <button
                        class="w-full h-10 btn btn-warning btn-sm md:w-auto"
                        type="button"
                    >
                        Reset
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
                        <tr class="text-center border border-blue-500">
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                {{}}
                            </td>
                            <td class="text-center border border-blue-500">
                                <button
                                    type="button"
                                    class="mr-2 btn btn-warning btn-sm"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    class="mr-2 btn btn-success btn-sm"
                                >
                                    Stock In
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-error btn-sm"
                                >
                                    Stock Out
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <!-- <PaginationTw2 :only="['products']" :paginate-data="products" /> -->
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
