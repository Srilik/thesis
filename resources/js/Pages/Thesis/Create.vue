<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisType } from "@/types/thesisType";
import { useForm } from "@inertiajs/vue3";
import { MoveLeft } from "lucide-vue-next";
import Swal from "sweetalert2";

import Button from 'primevue/button'
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-blue/theme.css';

const props = defineProps<{

    thesis?: ThesisType;
}>();

const form = useForm({
    id: props.thesis?.id ?? "",
    Thesis_No: props.thesis?.Thesis_No ?? "",
    Thesis_Group: props.thesis?.Thesis_Group ?? "",
    Academic_Year: props.thesis?.Academic_Year ?? "",
    Department: props.thesis?.Department ?? "",
    Major: props.thesis?.Major ?? "",
    Year: props.thesis?.Year ?? "",
    Batch: props.thesis?.Batch ?? "",
    Session: props.thesis?.Session ?? "",
    Organizaition: props.thesis?.Organizaition ?? "",
    Organization_Type: props.thesis?.Organization_Type ?? "",
    Location: props.thesis?.Location ?? "",
    Organization_Phone: props.thesis?.Organization_Phone ?? "",
    Title: props.thesis?.Title ?? "",
    Title_Khmer: props.thesis?.Title_Khmer ?? "",
    Objective: props.thesis?.Objective ?? "",
    Objective_Khmer: props.thesis?.Objective_Khmer ?? "",
    Summary: props.thesis?.Summary ?? "",
    Submit_Date: props.thesis?.Submit_Date ?? "",
    Teacher_id: props.thesis?.Teacher_id ?? "",
    Defend_Date: props.thesis?.Defend_Date ?? "",
    Book_Score: props.thesis?.Book_Score ?? "",
    Defend_time: props.thesis?.Defend_time ?? "",
    Submit_book: props.thesis?.Submit_book ?? "",
    Building: props.thesis?.Building ?? "",
    Room: props.thesis?.Room ?? "",
});

const onSave = () => {
    form.post(route("thesis.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Success",
                timer: 3000,
                position: "top-end",
                toast: true,
            });
        },
    });
};
</script>
<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a Thesis</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl flex justify-between">
                    <Link :href="route('thesis.index')" class="btn btn-info flex items-center">
                        <MoveLeft class="w-5 h-5 mr-1" />
                        Back
                    </Link>
                    <Button class="btn btn-info" @click="onSave">
                        <i class="pi pi-save"></i> Save
                    </Button>
                </div>
            </div>

            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <!-- form -->
                <form @submit.prevent="onSave">

                    <div class="flex flex-col gap-6 lg:flex-row mb-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_No</label>
                            <input v-model="form.Thesis_No" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Thesis_No }" />
                            <div class="text-error" v-if="form.errors.Thesis_No">
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_Group</label>
                            <input v-model="form.Thesis_Group" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Thesis_Group }" />
                            <div class="text-error" v-if="form.errors.Thesis_Group">
                                {{ form.errors.Thesis_Group }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <input v-model="form.Academic_Year" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" />
                            <div class="text-error" v-if="form.errors.Academic_Year">
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Department</label>
                            <input v-model="form.Department" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Department }" />
                            <div class="text-error" v-if="form.errors.Department">
                                {{ form.errors.Department }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Major</label>
                            <input v-model="form.Major" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Major }" />
                            <div class="text-error" v-if="form.errors.Major">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Year</label>
                            <input v-model="form.Year" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Year }" />
                            <div class="text-error" v-if="form.errors.Year">
                                {{ form.errors.Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Batch</label>
                            <input v-model="form.Batch" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Batch }" />
                            <div class="text-error" v-if="form.errors.Batch">
                                {{ form.errors.Batch }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Session</label>
                            <input v-model="form.Session" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Session }" />
                            <div class="text-error" v-if="form.errors.Session">
                                {{ form.errors.Session }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organizaition</label>
                            <input v-model="form.Organizaition" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organizaition }" />
                            <div class="text-error" v-if="form.errors.Organizaition">
                                {{ form.errors.Organizaition }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Type</label>
                            <input v-model="form.Organization_Type" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organization_Type }" />
                            <div class="text-error" v-if="form.errors.Organization_Type">
                                {{ form.errors.Organization_Type }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Title</label>
                            <textarea 
                                v-model="form.Title" class="input input-info w-full h-full"
                                :class="{ 'textarea-error': form.errors.Title }">
                            </textarea>
                            <div class="text-error" v-if="form.errors.Title">
                                {{ form.errors.Title }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title_Khmer</label>
                            <textarea 
                                v-model="form.Title_Khmer" class="input input-info w-full h-full"
                                :class="{ 'textarea-error': form.errors.Title_Khmer }">
                            </textarea>
                            <div class="text-error" v-if="form.errors.Title_Khmer">
                                {{ form.errors.Title_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective</label>
                            <textarea 
                                v-model="form.Objective" class="input input-info w-full h-full"
                                :class="{ 'textarea-error': form.errors.Objective }">
                            </textarea>
                            <div class="text-error" v-if="form.errors.Objective">
                                {{ form.errors.Objective }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective_Khmer</label>
                            <textarea 
                                v-model="form.Objective_Khmer" class="input input-info w-full h-full"
                                :class="{ 'textarea-error': form.errors.Objective_Khmer }">
                            </textarea>
                            <div class="text-error" v-if="form.errors.Objective_Khmer">
                                {{ form.errors.Objective_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <textarea 
                                v-model="form.Summary" class="input input-info w-full h-full"
                                :class="{ 'textarea-error': form.errors.Summary }">
                            </textarea>
                            <div class="text-error" v-if="form.errors.Summary">
                                {{ form.errors.Summary }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Location</label>
                            <input v-model="form.Location" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Location }" />
                            <div class="text-error" v-if="form.errors.Location">
                                {{ form.errors.Location }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Phone</label>
                            <input v-model="form.Organization_Phone" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organization_Phone }" />
                            <div class="text-error" v-if="form.errors.Organization_Phone">
                                {{ form.errors.Organization_Phone }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_Date</label>
                            <input v-model="form.Submit_Date" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_Date }" />
                            <div class="text-error" v-if="form.errors.Submit_Date">
                                {{ form.errors.Submit_Date }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Teacher_id</label>
                            <input v-model="form.Teacher_id" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Teacher_id }" />
                            <div class="text-error" v-if="form.errors.Teacher_id">
                                {{ form.errors.Teacher_id }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_Date</label>
                            <input v-model="form.Defend_Date" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_Date }" />
                            <div class="text-error" v-if="form.errors.Defend_Date">
                                {{ form.errors.Defend_Date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Book_Score</label>
                            <input v-model="form.Book_Score" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Book_Score }" />
                            <div class="text-error" v-if="form.errors.Book_Score">
                                {{ form.errors.Book_Score }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_time</label>
                            <input v-model="form.Defend_time" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_time }" />
                            <div class="text-error" v-if="form.errors.Defend_time">
                                {{ form.errors.Defend_time }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_book</label>
                            <input v-model="form.Submit_book" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_book }" />
                            <div class="text-error" v-if="form.errors.Submit_book">
                                {{ form.errors.Submit_book }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Building</label>
                            <input v-model="form.Building" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Building }" />
                            <div class="text-error" v-if="form.errors.Building">
                                {{ form.errors.Building }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Room</label>
                            <input v-model="form.Room" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Room }" />
                            <div class="text-error" v-if="form.errors.Room">
                                {{ form.errors.Room }}
                            </div>
                        </div>
                    </div>

                    <!-- <div class="mt-4 flex justify-end">
                        <button type="submit" class="btn btn-info">
                            Save
                        </button>
                    </div> -->
                </form>
            </div>
        </div>
    </App>
</template>