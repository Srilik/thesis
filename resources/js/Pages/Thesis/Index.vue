<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisType } from "@/types/thesisType";
import { PaginateType } from "@/types/paginateType";
import { router, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { filter, pickBy, throttle } from "lodash";
import { watch } from "vue";
import Swal from "sweetalert2";

// defineProps<{
//     thesis: {
//         id: number;
//         Thesis_No: number;
//         Thesis_Group: number;
//         Academic_Year: string;
//         Department: string;
//         Major: string;
//         Year: string;
//         Batch: string;
//         Session: string;
//         Organizaition: string;
//         Organization_Type: string;
//         Location: string;
//         Organization_Phone: string;
//         Title: string;
//         Title_Khmer: string;
//         Objective: string;
//         Objective_Khmer: string;
//         Summary: string;
//         Submit_Date: string;
//         Teacher_id: string;
//         Defend_Date: string;
//         Book_Score: number;
//         Defend_time: string;
//         Submit_book: string;
//         Building: string;
//         Room: string;
//     }[];
// }>();

const props = defineProps<{
    thesis?: ThesisType
    thesis: PaginateType<ThesisType>
    filters?: {
        keyword: string;
        id: number;
        Thesis_No: number;
        Thesis_Group: number;
        Academic_Year: string;
        Department: string;
        Major: string;
        Year: string;
        Batch: string;
        Session: string;
        Organizaition: string;
        Organization_Type: string;
        Location: string;
        Organization_Phone: string;
        Title: string;
        Title_Khmer: string;
        Objective: string;
        Objective_Khmer: string;
        Summary: string;
        Submit_Date: string;
        Teacher_id: string;
        Defend_Date: string;
        Book_Score: number;
        Defend_time: string;
        Submit_book: string;
        Building: string;
        Room: string;
    };
}>();


const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
});
watch(
    () => filterForm.data(),
    throttle(() => {
        console.log("log data");
        router.get(route("thesis.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesis"],
            replace: true,
        });
    }, 500),
);
const onClearFilter = () => {
    filterForm.keyword = "";
};

const form = useForm({
    id: null,
    Thesis_No: "",
    Thesis_Group: "",
    Academic_Year: "",
    Department: "",
    Major: "",
    Year: "",
    Batch: "",
    Session: "",
    Organizaition: "",
    Organization_Type: "",
    Location: "",
    Organization_Phone: "",
    Title: "",
    Title_Khmer: "",
    Objective: "",
    Objective_Khmer: "",
    Summary: "",
    Submit_Date: "",
    Teacher_id: "",
    Defend_Date: "",
    Book_Score: "",
    Defend_time: "",
    Submit_book: "",
    Building: "",
    Room: "",
});

const onSubmit = () => {
    form.post(route("thesis.store", form.id), {
        onSuccess: () => {
            form.reset();
            Swal.fire({
                icon: "success",
                title: "SUCCESS",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
        },
    });
};


const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesis.edit", id));

    form.id = data.id;

    form.Thesis_No = data.Thesis_No;
    form.Thesis_Group = data.Thesis_Group;
    form.Academic_Year = data.Academic_Year;
    form.Department = data.Department;
    form.Major = data.Major;
    form.Year = data.Year;
    form.Batch = data.Batch;
    form.Session = data.Session;
    form.Organizaition = data.Organizaition;
    form.Organization_Type = data.Organization_Type;
    form.Location = data.Location;
    form.Organization_Phone = data.Organization_Phone;
    form.Title = data.Title;
    form.Title_Khmer = data.Title_Khmer;
    form.Objective = data.Objective;
    form.Objective_Khmer = data.Objective_Khmer;
    form.Summary = data.Summary;
    form.Submit_Date = data.Submit_Date;
    form.Teacher_id = data.Teacher_id;
    form.Defend_Date = data.Defend_Date;
    form.Book_Score = data.Book_Score;
    form.Defend_time = data.Defend_time;
    form.Submit_book = data.Submit_book;
    form.Building = data.Building;
    form.Room = data.Room;
};

const onDelete = (id: number) => {
    // console.log(id);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("thesis.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        toast: true,
                        position: "top-end",
                        timer: 3000,
                        showConfirmButton: false,
                    });
                },
            });
        }
    });
};
</script>
<template>
    <App>
        <div class="p-4">
            <h2 class="text-2xl font-bold">Create a Thesis</h2>
            <div class="mt-4 p-3 bg-base-100 rounded-xl">
            <form @submit.prevent="onSubmit" class="p-2 bg-white dark:bg-gray-900 rounded-lg">
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Thesis_No</label>
                        <input v-model.number="form.Thesis_No" type="number" class="input input-primary w-full" />
                        <label class=" text-red-500 text-sm" v-if="form.errors.Thesis_No">
                            {{ form.errors.Thesis_No }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Thesis_Group</label>
                        <input v-model.number="form.Thesis_Group" type="number" class="input input-primary w-full" />
                        <label class=" text-red-500 text-sm" v-if="form.errors.Thesis_Group">
                            {{ form.errors.Thesis_Group }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Academic_Year</label>
                        <input v-model="form.Academic_Year" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Academic_Year">
                            {{ form.errors.Academic_Year }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Department</label>
                        <input v-model="form.Department" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Department">
                            {{ form.errors.Department }}
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Major</label>
                        <input v-model="form.Major" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Major">
                            {{ form.errors.Major }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Year</label>
                        <select v-model="form.Year" class="input input-primary w-full">
                            <option value="">Select a Year</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <!-- <input v-model="form.Year" type="text" class="input input-primary w-full" /> -->
                        <label class="label text-red-500 text-sm" v-if="form.errors.Year">
                            {{ form.errors.Year }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Batch</label>
                        <input v-model.number="form.Batch" type="number" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Batch">
                            {{ form.errors.Batch }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Session</label>
                        <select v-model="form.Session" class="input input-primary w-full">
                            <option value="">Select a Session</option>
                            <option value="morning">Morning</option>
                            <option value="afternoon">Afternoon</option>
                            <option value="evening">Evening</option>
                        </select>
                        <!-- <input v-model="form.Session" type="text" class="input input-primary w-full" /> -->
                        <label class="label text-red-500 text-sm" v-if="form.errors.Session">
                            {{ form.errors.Session }}
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Organizaition</label>
                        <input v-model="form.Organizaition" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Organizaition">
                            {{ form.errors.Organizaition }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Organization_Type</label>
                        <input v-model="form.Organization_Type" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Organization_Type">
                            {{ form.errors.Organization_Type }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Location</label>
                        <input v-model="form.Location" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Location">
                            {{ form.errors.Location }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Organization_Phone</label>
                        <input v-model="form.Organization_Phone" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Organization_Phone">
                            {{ form.errors.Organization_Phone }}
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Title</label>
                        <textarea v-model="form.Title" class="textarea textarea-primary w-full"></textarea>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Title_Khmer</label>
                        <textarea v-model="form.Title_Khmer" class="textarea textarea-primary w-full"></textarea>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Objective</label>
                        <textarea v-model="form.Objective" class="textarea textarea-primary w-full"></textarea>
                    </div>
                    <div class="flex flex-col w-full">

                        <label class="label">Objective_Khmer</label>
                        <textarea v-model="form.Objective_Khmer" class="textarea textarea-primary w-full"></textarea>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Summary</label>
                        <textarea v-model="form.Summary" class="textarea textarea-primary w-full"></textarea>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Submit_Date</label>
                        <input v-model="form.Submit_Date" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Submit_Date">
                            {{ form.errors.Submit_Date }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Teacher_id</label>
                        <input v-model="form.Teacher_id" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Teacher_id">
                            {{ form.errors.Teacher_id }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Defend_Date</label>
                        <input v-model="form.Defend_Date" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Defend_Date">
                            {{ form.errors.Defend_Date }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Book_Score</label>
                        <input v-model="form.Book_Score" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Book_Score">
                            {{ form.errors.Book_Score }}
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label class="label">Defend_time</label>
                        <input v-model="form.Defend_time" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Defend_time">
                            {{ form.errors.Defend_time }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">

                        <label class="label">Submit_book</label>
                        <input v-model="form.Submit_book" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Submit_book">
                            {{ form.errors.Submit_book }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Building</label>
                        <input v-model="form.Building" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Building">
                            {{ form.errors.Building }}
                        </label>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="label">Room</label>
                        <input v-model="form.Room" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Room">
                            {{ form.errors.Room }}
                        </label>
                    </div>
                </div>

                <div class="flex justify-end mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
            </div>
            <div class="p-3">
                <div class="mb-2">
                    <h2 class="text-2xl font-bold">ThesisDetail Management</h2>
                    <div class="mt-4">
                        <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                            <input v-model="filterForm.keyword" type="text" placeholder="Search..."
                                class="input input-info w-full" />

                            <button class="btn btn-warning" type="button" @click="onClearFilter">Clear</button>
                        </div>
                    </div>
                </div>
                <!-- <div class="mt-4 bg-base-100 p-2 rounded-xl">
                <table class="table-base table-zebra"> -->
                <div class="bg-base-100 rounded-xl overflow-x-auto">
                    <table class="table-base table-lg">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thesis_No</th>
                                <th>Thesis_Group</th>
                                <th>Academic_Year</th>
                                <th>Department</th>
                                <th>Major</th>
                                <th>Year</th>
                                <th>Batch</th>
                                <th>Session</th>
                                <!-- <th>Organizaition</th>
                            <th>Organization_Type</th>
                            <th>Location</th>
                            <th>Organization_Phone</th>
                            <th>Title</th>
                            <th>Title_Khmer</th>
                            <th>Objective</th>
                            <th>Objective_Khmer</th>
                            <th>Summary</th>
                            <th>Submit_Date</th> -->
                                <th>Teacher_id</th>
                                <!-- <th>Defend_Date</th> -->
                                <th>Book_Score</th>
                                <!-- <th>Defend_time</th>
                            <th>Submit_book</th>
                            <th>Building</th>
                            <th>Room</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in thesis" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.Thesis_No }}</td>
                                <td>{{ item.Thesis_Group }}</td>
                                <td>{{ item.Academic_Year }}</td>
                                <td>{{ item.Department }}</td>
                                <td>{{ item.Major }}</td>
                                <td>{{ item.Year }}</td>
                                <td>{{ item.Batch }}</td>
                                <td>{{ item.Session }}</td>
                                <!-- <td>{{ item.Organizaition }}</td>
                            <td>{{ item.Organization_Type }}</td>
                            <td>{{ item.Location }}</td>
                            <td>{{ item.Organization_Phone }}</td>
                            <td>{{ item.Title }}</td>
                            <td>{{ item.Title_Khmer }}</td>
                            <td>{{ item.Objective }}</td>
                            <td>{{ item.Objective_Khmer }}</td>
                            <td>{{ item.Summary }}</td>
                            <td>{{ item.Submit_Date }}</td> -->
                                <td>{{ item.Teacher_id }}</td>
                                <!-- <td>{{ item.Defend_Date }}</td> -->
                                <td>{{ item.Book_Score }}</td>
                                <!-- <td>{{ item.Defend_time }}</td>
                            <td>{{ item.Submit_book }}</td>
                            <td>{{ item.Building }}</td>
                            <td>{{ item.Room }}</td>  -->
                                <td>
                                    <button @click="onEdit(item.id)" class="btn btn-success btn-sm mr-2">Edit</button>
                                    <button @click="onDelete(item.id)" class="btn btn-error btn-sm">Delete</button>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="bg-base-100 rounded-xl mt-2 flex justify-center p-2">
                    <div class="join">
                        <Link 
                            v-for="link in thesis.links" 
                            :href="link.url ?? '#'"
                            class="join-item btn"
                            :class="{ 'btn-info': link.active }">
                            <span v-html="link.label"></span>
                        </Link>
                    </div>  
                </div>
            </div>
    </App>
</template>
