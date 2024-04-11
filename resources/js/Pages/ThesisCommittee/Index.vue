<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteeType } from "@/types/thesisCommittee";
import { router, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";

// defineProps<{
//     thesisCommittees: {
//         id: number;
//         Academic_Year: string;
//         Major: string;      
//         Committee: string;
//         Department: string;
//         Subject: string;
//     }[];
// }>();
const props = defineProps<{
    thesisCommittee?: ThesisCommitteeType
    thesisCommittees: PaginateType<ThesisCommitteeType>
    filters?: {
        keyword: string;

        id: number;
        Academic_Year: string;
        Major: string;      
        Committee: string;
        Department: string;
        Subject: string;
    }
}>(); 
const form = useForm({
    id: null,
    Academic_Year: "",
    Major: "",      
    Committee: "",
    Department: "",
    Subject: "",
});

const onSubmit = () => {
    form.post(route("thesisCommittee.store", form.id), {
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
const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
});
watch(
    () => filterForm.data(),
    throttle(() => {
        console.log("log data");
        router.get(route("thesisCommittee.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesisCommittees"],
            replace: true,
        });
    }, 500),
);
const onClearFilter = () => {
    filterForm.keyword = "";
};

const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesisCommittee.edit", id));
    form.id = data.id;
    form.Academic_Year = data.Academic_Year;
    form.Major = data.Major;
    form.Committee = data.Committee;
    form.Department = data.Department;
    form.Subject = data.Subject;
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
            router.delete(route("thesisCommittee.destroy", id), {
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
            <h2 class="text-2xl font-bold">Create a ThesisCommittee</h2>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>

            <form 
                @submit.prevent="onSubmit" 
                class="p-2 bg-white dark:bg-gray-900 rounded-lg">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <label class="label">Academic Year</label>
                        <input v-model="form.Academic_Year" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Academic_Year">
                            {{ form.errors.Academic_Year }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Major</label>
                        <input v-model="form.Major" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Major">
                            {{ form.errors.Major }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Committee</label>
                        <input v-model="form.Committee" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Committee">
                            {{ form.errors.Committee }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Department</label>
                        <input v-model="form.Department" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Department">
                            {{ form.errors.Department }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Subject</label>
                        <input v-model="form.Subject" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Subject">
                            {{ form.errors.Subject }}
                        </label>
                    </div> 
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary mt-5">Save</button>
                </div>
            </form>
            </div>
        </div>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisCommittee Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <input 
                            v-model="filterForm.keyword"
                            type="text" 
                            placeholder="Search..." 
                            class="input input-info w-full"/>

                        <button class="btn btn-warning" type="button" @click="onClearFilter">Clear</button>
                    </div>
                </div>
            </div>

            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table table-lg">
                    <thead>
                        <tr class="text uppercase text-sm">
                            <th>ID</th>
                            <th>Academic Year</th>
                            <th>Major</th>
                            <th>Committee</th>
                            <th>Department</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in thesisCommittees" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Major }}</td>
                            <td>{{ item.Committee }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Subject }}</td>
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
                        v-for="link in thesisCommittees.links" 
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