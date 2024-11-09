<<<<<<< HEAD
<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisDetailType } from "@/types/thesisDetail";
import { useForm } from "@inertiajs/vue3";
import { MoveLeft } from "lucide-vue-next";
import Swal from "sweetalert2";

const props = defineProps<{
    // rooms: {
    //     room_id: string;
    //     name: string;
    // }[];
    // statuses: {
    //     id: number;
    //     name: string;
    // }[];
    thesisDetail?: ThesisDetailType;
}>();

// form object
const form = useForm({
    id: props.thesisDetail?.id ?? "",
    Thesis_No: props.thesisDetail?.Thesis_No ?? "",
    Student_ID: props.thesisDetail?.Student_ID ?? "",
    Phone: props.thesisDetail?.Phone ?? "",
    Defend: props.thesisDetail?.Defend ?? "",
    Pass_State: props.thesisDetail?.Pass_State ?? "",
    Issue_Tem_Certificate: props.thesisDetail?.Issue_Tem_Certificate ?? "",
    Other: props.thesisDetail?.Other ?? "",
    Hardwork: props.thesisDetail?.Hardwork ?? "",
    Charateristic: props.thesisDetail?.Charateristic ?? "",
    Remark: props.thesisDetail?.Remark ?? "",
    Result: props.thesisDetail?.Result ?? "",

    // room_id: props.thesisDetail?.room_id ?? "",
    // status_id: props.thesisDetail?.status_id ?? null,
});

// handle form submission
const onSave = () => {
    form.post(route("thesisDetail.store"), {
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
=======
<script setup>
import { ref } from "vue";
// const thesisDetailName = ref()
>>>>>>> main
</script>

<template>
<<<<<<< HEAD
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisDetail</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesisDetail.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />
                    Back</Link>
                </div>
            </div>
            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <!-- form -->
                <form @submit.prevent="onSave">
                    <div>
                        <label class="label">Thesis_No</label>
                        <input v-model="form.Thesis_No" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Thesis_No }" />
                        <div class="text-error" v-if="form.errors.Thesis_No">
                            {{ form.errors.Thesis_No }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Student_ID</label>
                        <input v-model="form.Student_ID" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Student_ID }" />
                        <div class="text-error" v-if="form.errors.Student_ID">
                            {{ form.errors.Student_ID }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Phone</label>
                        <input v-model="form.Phone" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Phone }" />
                        <div class="text-error" v-if="form.errors.Phone">
                            {{ form.errors.Phone }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Defend</label>
                        <input v-model="form.Defend" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Defend }" />
                        <div class="text-error" v-if="form.errors.Defend">
                            {{ form.errors.Defend }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Pass_State</label>
                        <input v-model="form.Pass_State" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Pass_State }" />
                        <div class="text-error" v-if="form.errors.Pass_State">
                            {{ form.errors.Pass_State }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Issue_Tem_Certificate</label>
                        <input v-model="form.Issue_Tem_Certificate" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Issue_Tem_Certificate }" />
                        <div class="text-error" v-if="form.errors.Issue_Tem_Certificate">
                            {{ form.errors.Issue_Tem_Certificate }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Other</label>
                        <input v-model="form.Other" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Other }" />
                        <div class="text-error" v-if="form.errors.Other">
                            {{ form.errors.Other }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Hardwork</label>
                        <input v-model="form.Hardwork" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Hardwork }" />
                        <div class="text-error" v-if="form.errors.Hardwork">
                            {{ form.errors.Hardwork }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Charateristic</label>
                        <input v-model="form.Charateristic" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Charateristic }" />
                        <div class="text-error" v-if="form.errors.Charateristic">
                            {{ form.errors.Charateristic }}
                        </div>
                    </div>
                    <div>
                        <label class="label">Remark</label>
                        <textarea v-model="form.Remark" class="textarea textarea-primary w-full"></textarea>
                    </div>
                    <!-- <div>
                        <label class="label">Remark</label>
                        <input v-model="form.Remark" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Remark }" />
                        <div class="text-error" v-if="form.errors.Remark">
                            {{ form.errors.Remark }}
                        </div>
                    </div> -->
                    <div>
                        <label class="label">Result</label>
                        <input v-model="form.Result" class="input input-primary w-full"
                            :class="{ 'input-error': form.errors.Result }" />
                        <div class="text-error" v-if="form.errors.Result">
                            {{ form.errors.Result }}
                        </div>
                    </div>

                    <!-- <div>
                        <label class="label">Description</label>
                        <textarea v-model="form.description" class="textarea textarea-primary w-full"></textarea>
                    </div> -->

                    <!-- <div class="flex gap-2">
                        <div class="w-full">
                            <label class="label">Room</label>
                            <select v-model="form.room_id" class="select select-primary w-full"
                                :class="{ 'select-error': form.errors.room_id }">
                                <option value="">Select Room</option>
                                <option :value="item.room_id" v-for="(item, index) in rooms">
                                    {{ item.name }}
                                </option>
                            </select>
                            <div class="text-error" v-if="form.errors.room_id">
                                {{ form.errors.room_id }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="label">Status</label>
                            <select v-model="form.status_id" class="select select-primary w-full" :class="{
                        'select-error': form.errors.status_id,
                    }">
                                <option :value="null">Select Status</option>
                                <option :value="item.id" v-for="(item, index) in statuses">
                                    {{ item.name }}
                                </option>
                            </select>
                            <div class="text-error" v-if="form.errors.status_id">
                                {{ form.errors.status_id }}
                            </div>
                        </div>
                    </div> -->

                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </App>
</template>
=======
    <div class="container p-4 px-8 mx-auto mt-6 bg-gray-200 border rounded-xl">
        <!-- md:text-sm -->
        <h2
            class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600 xl:text-teal-600"
        >
            Create ThesisDetail
        </h2>

        <div class="flex flex-col gap-4 mt-4">
            <!-- {{ thesisDetailName }} -->
            <!-- form in here -->
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Thesis_No</label>
                    <input
                        v-model="Thesis_No"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Student_ID</label>
                    <input
                        v-model="Student_ID"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Phone</label>
                    <input v-model="Phone" type="text" class="p-2 rounded-md" />
                </div>
                <div class="flex flex-col w-full">
                    <label>Defend</label>
                    <input
                        v-model="Defend"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
            </div>
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Pass_State</label>
                    <input
                        v-model="Pass_State"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Issue_Tem_Certificate</label>
                    <input
                        v-model="Issue_Tem_Certificate"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Other</label>
                    <input v-model="Other" type="text" class="p-2 rounded-md" />
                </div>
                <div class="flex flex-col w-full">
                    <label>Hardwork</label>
                    <input
                        v-model="Hardwork"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
            </div>
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Charateristic</label>
                    <input
                        v-model="Charateristic"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Remark</label>
                    <input
                        v-model="Remark"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
                <div class="flex flex-col w-full">
                    <label>Result</label>
                    <input
                        v-model="Result"
                        type="text"
                        class="p-2 rounded-md"
                    />
                </div>
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa-regular fa-floppy-disk"></i>Save
                </button>
            </div>
            <div class="flex justify-end">
                <button
                    class="p-2 text-white bg-blue-600 rounded-lg active:bg-blue-800"
                    type="submit"
                >
                    CREATE
                </button>
            </div>
        </div>
    </div>
</template>
>>>>>>> main
