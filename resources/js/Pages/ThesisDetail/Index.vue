<script setup lang="ts">
import App from "@/Layouts/App.vue";
import axios from "axios";
import Swal from "sweetalert2";
import { PaginateType } from "@/types/paginateType";
import { ThesisDetailType } from "@/types/thesisDetail";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle } from "lodash";
import { watch } from "vue";

// defineProps<{
//     thesisDetails: {
//         id: number;
//         Thesis_No: number;
//         Student_ID: string;
//         Phone: string;
//         Defend: string;
//         Pass_State: string;
//         Issue_Tem_Certificate: string;
//         Other: string;
//         Hardwork: string;
//         Charateristic: string;
//         Remark: string;
//         Result: string;
//     }[];
// }>();
const props = defineProps<{
    thesisDetail?: ThesisDetailType
    thesisDetails: PaginateType<ThesisDetailType>
    filters?: {
        keyword: string;

        id: number;
        Thesis_No: number;
        Student_ID: string;
        Phone: string;
        Defend: string;
        Pass_State: string;
        Issue_Tem_Certificate: string;
        Other: string;
        Hardwork: string;
        Charateristic: string;
        Remark: string;
        Result: string;
    }
}>(); 
const form = useForm({
    id: null,
    Thesis_No: "",
    Student_ID: "",
    Phone: "",
    Defend: "",
    Pass_State: "",
    Issue_Tem_Certificate: "",
    Other: "",
    Hardwork: "",
    Charateristic: "",
    Remark: "",
    Result: "",
});

const onSubmit = () => {
    form.post(route("thesisDetail.store", form.id), {
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
        router.get(route("thesisDetail.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesisDetails"],
            replace: true,
        });
    }, 500),
);
const onClearFilter = () => {
    filterForm.keyword = "";
};

const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesisDetail.edit", id));
    form.id = data.id;
    form.Thesis_No = data.Thesis_No;
    form.Student_ID = data.Student_ID;
    form.Phone = data.Phone;
    form.Defend = data.Defend;
    form.Pass_State = data.Pass_State;
    form.Issue_Tem_Certificate = data.Issue_Tem_Certificate;
    form.Other = data.Other;
    form.Hardwork = data.Hardwork;
    form.Charateristic = data.Charateristic;
    form.Remark = data.Remark;
    form.Result = data.Result;
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
            router.delete(route("thesisDetail.destroy", id), {
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
            <h2 class="text-2xl font-bold">Create a ThesisDetail</h2>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>

            <form 
                @submit.prevent="onSubmit" 
                class="p-2 bg-white dark:bg-gray-900 rounded-lg">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <label class="label">Thesis_No</label>
                        <input v-model="form.Thesis_No" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Thesis_No">
                            {{ form.errors.Thesis_No }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Student_ID</label>
                        <input v-model="form.Student_ID" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Student_ID">
                            {{ form.errors.Student_ID }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Phone</label>
                        <input v-model="form.Phone" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Phone">
                            {{ form.errors.Phone }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Defend</label>
                        <input v-model="form.Defend" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Defend">
                            {{ form.errors.Defend }}
                        </label>
                    </div>
                </div>
                <div class="flex items-start gap-4">    
                    <div class="flex-1">
                        <label class="label">Pass_State</label>
                        <input v-model="form.Pass_State" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Pass_State">
                            {{ form.errors.Pass_State }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Issue_Tem_Certificate</label>
                        <input v-model="form.Issue_Tem_Certificate" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Issue_Tem_Certificate">
                            {{ form.errors.Issue_Tem_Certificate }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Other</label>
                        <input v-model="form.Other" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Other">
                            {{ form.errors.Other }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Hardwork</label>
                        <input v-model="form.Hardwork" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Hardwork">
                            {{ form.errors.Hardwork }}
                        </label>
                    </div>
                </div>
                <div class="flex items-start gap-4">    
                    <div class="flex-1">
                        <label class="label">Charateristic</label>
                        <input v-model="form.Charateristic" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Charateristic">
                            {{ form.errors.Charateristic }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Remark</label>
                        <input v-model="form.Remark" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Remark">
                            {{ form.errors.Remark }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Result</label>
                        <input v-model="form.Result" type="text" class="input input-primary w-full" />
                        <label class="label text-red-500 text-sm" v-if="form.errors.Result">
                            {{ form.errors.Result }}
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
                <h2 class="text-2xl font-bold">ThesisDetail Management</h2>
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
                            <th>Thesis_No</th>
                            <th>Student_ID</th>
                            <th>Phone</th>
                            <!-- <th>Defend</th> -->
                            <!-- <th>Pass_State</th> -->
                            <!-- <th>Issue_Tem_Certificate</th> -->
                            <!-- <th>Other</th> -->
                            <th>Hardwork</th>
                            <th>Charateristic</th>
                            <th>Remark</th>
                            <th>Result</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in thesisDetails" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Thesis_No }}</td>
                            <td>{{ item.Student_ID }}</td>
                            <td>{{ item.Phone }}</td>
                            <!-- <td>{{ item.Defend }}</td>
                            <td>{{ item.Pass_State }}</td>
                            <td>{{ item.Issue_Tem_Certificate }}</td>
                            <td>{{ item.Other }}</td> -->
                            <td>{{ item.Hardwork }}</td>
                            <td>{{ item.Charateristic }}</td>
                            <td>{{ item.Remark }}</td>
                            <td>{{ item.Result }}</td>
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
                        v-for="link in thesisDetails.links" 
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