<script setup lang="ts">
import ModalBreeze from "@/Components/ModalBreeze.vue";
import { Button } from "@/Components/ui/button";
import App from "@/Layouts/App.vue";
import { PencilIcon, TrashIcon, XIcon } from "lucide-vue-next";
import { ref } from "vue";

// import { ExaminationLink, Program, Student } from "@/types/graduateSchool";

const showModal = ref(false);

const onCloseModal = () => {
    showModal.value = false;
};

const onAddStudent = () => {};

const onSave = () => {};
</script>
<template>
    <App>
        <div class="p-2 space-y-2 bg-base-200/15 rounded-xl">
            <div class="p-2 bg-base-100 rounded-xl">
                <button
                    type="button"
                    class="btn btn-success"
                    @click="showModal = true"
                >
                    New
                </button>
            </div>
            <div class="mt-2 overflow-hidden border bg-base-100 rounded-xl">
                <div class="overflow-x-auto whitespace-nowrap">
                    <table class="w-full base-table2">
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
                        <tbody class="text-center">
                            <tr>
                                <td>1</td>
                                <td>Topic</td>
                                <td>Year</td>
                                <td>Major</td>
                                <td>Advisors</td>
                                <td>Students</td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <button
                                            type="button"
                                            class="btn btn-success btn-square btn-sm"
                                        >
                                            <PencilIcon class="w-4 h-4" />
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-error btn-square btn-sm"
                                        >
                                            <TrashIcon class="w-4 h-4" />
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            Detail..
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </App>

    <ModalBreeze
        :show="showModal"
        :is-no-padding="true"
        max-width="7xl"
        @close="onCloseModal"
    >
        <div class="m-4 overflow-hidden shadow-xl bg-base-100 rounded-2xl">
            <div class="flex items-center justify-between gap-2 p-2 border-b">
                <h2 class="text-lg font-bold">New Thesis Link</h2>

                <button
                    class="btn btn-error btn-outline btn-sm btn-square"
                    type="button"
                    @click="onCloseModal"
                >
                    <XIcon class="w-4 h-4" />
                </button>
            </div>

            <div
                class="max-h-[calc(100vh-150px)] overflow-auto bg-base-100 p-2"
            >
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-full">
                            <label class="label">
                                Program <span class="text-error">*</span>
                            </label>
                            <select class="w-full select select-primary">
                                <option value="">Select program</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="label">
                                Subject <span class="text-error">*</span>
                            </label>
                            <input
                                type="text"
                                class="w-full input input-primary"
                                placeholder="Subject"
                            />
                        </div>
                        <div class="w-full">
                            <label class="label">
                                Google Form Link
                                <span class="text-error">*</span>
                            </label>
                            <input
                                type="text"
                                class="w-full input input-primary"
                                placeholder="Google Form Link"
                            />
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-full">
                            <label class="label">
                                Exam Date <span class="text-error">*</span>
                            </label>
                            <input
                                type="date"
                                class="w-full input input-primary"
                            />
                        </div>
                        <div class="w-full">
                            <label class="label">
                                Exam Time <span class="text-error">*</span>
                            </label>
                            <input
                                type="time"
                                class="w-full input input-primary"
                            />
                        </div>
                        <div class="w-full">
                            <label class="label">
                                Shift <span class="text-error">*</span>
                            </label>
                            <select class="select select-primary">
                                <option value="Evening">Evening</option>
                                <option value="Weekend">Weekend</option>
                                <option value="Evening and Weekend">
                                    Evening and Weekend
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-full">
                            <label class="label"> Lecturer </label>
                            <input
                                type="text"
                                class="w-full input input-primary"
                                placeholder="Lecturer"
                            />
                        </div>
                        <div class="w-full">
                            <label class="label"> Exam Type </label>
                            <select class="w-full select select-primary">
                                <option value="">Select exam type</option>
                                <option value="Midterm">Midterm</option>
                                <option value="Final">Final</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="label">
                                Status <span class="text-error"> * </span>
                            </label>
                            <select class="w-full select select-primary">
                                <option :value="1">Active</option>
                                <option :value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-1 bg-base-200 rounded-xl">
                    <h4 class="text-lg text-center">Students</h4>
                    <div
                        class="flex items-center justify-between gap-3 p-2 mt-2 bg-base-100 rounded-xl"
                    >
                        <form @submit.prevent="onAddStudent">
                            <input
                                type="text"
                                class="mr-1 input input-primary"
                                placeholder="Student ID"
                                required
                            />
                            <button class="btn btn-success">Add</button>
                        </form>
                    </div>
                    <div
                        class="max-h-[calc(100vh-550px)] overflow-auto border-base-200 border rounded-xl mt-2 bg-base-100"
                    >
                        <table class="w-full base-table2">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Student ID</th>
                                    <th>Full Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>123456</td>
                                    <td>Student Name</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-error btn-square btn-sm"
                                        >
                                            <TrashIcon class="w-4 h-4" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between gap-2 p-2 border-t">
                <div class="space-x-1"></div>
                <div class="space-x-1">
                    <Button
                        class="bg-warning hover:bg-warning/90"
                        type="button"
                        @click="onCloseModal"
                    >
                        Close
                    </Button>
                    <Button
                        class="text-gray-100 bg-success hover:bg-success/90"
                        type="button"
                        @click.prevent="onSave"
                    >
                        Save
                    </Button>
                </div>
            </div>
        </div>
    </ModalBreeze>
</template>
