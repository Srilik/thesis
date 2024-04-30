<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisType } from "@/types/thesisType";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
<<<<<<< HEAD
import { router, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { filter, pickBy, throttle } from "lodash";
=======
import { useForm, router } from "@inertiajs/vue3";
>>>>>>> a7a5a31 (edit)
import { watch } from "vue";
import { throttle, pickBy } from "lodash";
import Swal from "sweetalert2";

import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-blue/theme.css';


const props = defineProps<{
    thesises: PaginateType<ThesisType>;
    thesisAdvisors: ThesisAdvisorType[];
    filters?: {
        keyword: string;
        // Advisor: string | null;
    };
}>();

const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
    // Advisor: props.filters?.Advisor ?? null,
});

watch(
    () => filterForm.data(),
    throttle(() => {
        // console.log("log data");
        router.get(route("thesis.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only: ["thesises"],
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.keyword = "";
    // filterForm.Advisor = "";
};

const onDelete = async (id: number) => {
    await Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Delete",
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("thesis.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Success",
                        text: "thesis has been deleted",
                        icon: "success",
                        toast: true,
                        timer: 3000,
                    });
                },
            });
        }
    });
};
</script>
<template>
    <App>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">Thesis Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <Link :href="route('thesis.create')" class="btn btn-primary">
                            <i class="pi pi-file-plus"></i>
                            New
                        </Link>
                        <input v-model="filterForm.keyword" type="text" class="input input-primary w-full"
                        placeholder="&#128269; Search...">
                        <i class="pi pi-search search-icon"></i>

                        <!-- <select v-model="filterForm.Advisor" class="select select-primary w-full">
                            <option :value="null">Select a Advisor</option>
                            <option v-for="(thesisAdvisor, index) in thesisAdvisors" :key="index" :value="thesisAdvisor.id">
                                {{ thesisAdvisor.Advisor }}
                            </option>
                        </select> -->
                        <button class="btn btn-warning" type="button" @click="onClearFilter">
                            <i class="pi pi-eraser"></i>
                            Clear
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table table-lg w-full h-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thesis_No</th>
                            <th>Thesis_Group</th>
                            <th>Academic_Year</th>
                            <th>Department</th>
                            <th>Major</th>
                            <!-- <th>Year</th>
                            <th>Batch</th>
                            <th>Session</th>
                            <th>Organizaition</th>
                            <th>Organization_Type</th>
                            <th>Location</th>
                            <th>Organization_Phone</th>
                            <th>Title</th>
                            <th>Title_Khmer</th>
                            <th>Objective</th>
                            <th>Objective_Khmer</th>
                            <th>Summary</th>
                            <th>Submit_Date</th> -->
                            <!-- <th>Teacher_id</th> -->
                            <!-- <th>Defend_Date</th>
                            <th>Book_Score</th>
                            <th>Defend_time</th>
                            <th>Submit_book</th> -->
                            <th>Building</th>
                            <th>Room</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in thesises.data" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Thesis_No }}</td>
                            <td>{{ item.Thesis_Group }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Major }}</td>
                            <!-- <td>{{ item.Year }}</td>
                            <td>{{ item.Batch }}</td>
                            <td>{{ item.Session }}</td>
                            <td>{{ item.Organizaition }}</td>
                            <td>{{ item.Organization_Type }}</td>
                            <td>{{ item.Location }}</td>
                            <td>{{ item.Organization_Phone }}</td>
                            <td>{{ item.Title }}</td>
                            <td>{{ item.Title_Khmer }}</td>
                            <td>{{ item.Objective }}</td>
                            <td>{{ item.Objective_Khmer }}</td>
                            <td>{{ item.Summary }}</td>
                            <td>{{ item.Submit_Date }}</td> -->
                            <!-- <td>{{ item.Teacher_id }}</td> -->
                            <!-- <td>{{ item.Defend_Date }}</td>
                            <td>{{ item.Book_Score }}</td>
                            <td>{{ item.Defend_time }}</td>
                            <td>{{ item.Submit_book }}</td> -->
                            <td>{{ item.Building }}</td>
                            <td>{{ item.Room }}</td>
                            <td>
                                <Link :href="route('thesis.edit', item.id)" class="btn btn-warning mr-2">
                                    <i class="pi pi-file-edit"></i>
                                    Edit
                                </Link>
                                <button type="button" @click="onDelete(item.id)" class="btn btn-error">
                                    <i class="pi pi-trash"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-base-100 rounded-xl mt-2 flex justify-center p-2">
                <div class="join">
                    <Link v-for="link in thesises.links" :href="link.url ?? '#'" class="join-item btn"
                        :class="{ 'btn-primary': link.active }">
                    <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
<style scoped>
    .search-container {
        position: relative;
    }

    .search-container input {
        padding-left: 2rem; /* Adjust as needed */
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 0.75rem; /* Adjust as needed */
        transform: translateY(-50%);
        font-size: 1.25rem; /* Adjust as needed */
        color: #6b7280;
    }
</style>