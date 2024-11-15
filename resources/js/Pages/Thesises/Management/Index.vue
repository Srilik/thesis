<script setup lang="ts">
import ModalBreeze from "@/Components/ModalBreeze.vue";
import { Button } from "@/Components/ui/button";
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteesType } from "@/types/Thesis/thesisCommitteesType";
import { ThesisesType } from "@/types/Thesis/thesisesType";
import { ThesisStudentsType } from "@/types/Thesis/thesisStudentType";
import { EyeIcon } from "@heroicons/vue/24/solid";
import { router, useForm } from "@inertiajs/vue3";
import { PenBoxIcon, PencilIcon, TrashIcon } from "lucide-vue-next";
import Swal from "sweetalert2";
import { ref, watch } from "vue";
import useAxios from "@/Composables/useAxios";
const { fetch } = useAxios();

const showModal = ref(false);
const showModalAdvisor = ref(false);
const showModalStudentThesis = ref(false);
const showModalThesisReport = ref(false);

const onCloseModal = () => {
    showModal.value = false;
};
const onCloseModalAdvisor = () => {
    showModalAdvisor.value = false;
};

interface Props {
    filters?: {
        keyword?: string;
        thesis_id?: number;
    };
    thesises: PaginateType<ThesisesType>;
    thesisCommittees: PaginateType<ThesisCommitteesType>;
    thesisStudents: PaginateType<ThesisStudentsType>;
    errors: Record<string, string[]>;
}
const props = defineProps<Props>();

const thesises = ref<PaginateType<ThesisesType>>(props.thesises);
const thesisCommittees = ref<PaginateType<ThesisCommitteesType>>(
    props.thesisCommittees,
);
const thesisStudents = ref<PaginateType<ThesisStudentsType>>(
    props.thesisStudents,
);

watch(
    () => props.thesises,
    (newThesises) => {
        thesises.value = newThesises;
    },
);
const formThesis = useForm({
    id: null,
    group_id: "",
    academic_year: "",
    major: "",
    year: "",
    batch: "",
    topic: "",
    topic_kh: "",
    objective: "",
    objective_kh: "",
    description: "",
    organization: "",
    organization_type: "",
    organization_address: "",
    organization_phone: "",
    organization_email: "",
    lecturer_id: "",
});
const onSaveThesis = () => {
    formThesis.post(
        route("thesises.management.thesises.store", formThesis.id),
        {
            onSuccess: async () => {
                Swal.fire({
                    title: "Success",
                    icon: "success",
                    toast: true,
                    position: "top-end",
                    timer: 5000,
                    showConfirmButton: false,
                });
                formThesis.reset();
                formThesis.isDirty = false;
            },
        },
    );
};
const editThesis = async (thesisID: number) => {
    const { data } = await fetch<{}>(
        route("thesises.management.thesises.edit", thesisID),
    );

    formThesis.id = data.id;
    formThesis.group_id = data.group_id;
    formThesis.academic_year = data.academic_year;
    formThesis.major = data.major;
    formThesis.year = data.year;
    formThesis.batch = data.batch;
    formThesis.topic = data.topic;
    formThesis.topic_kh = data.topic_kh;
    formThesis.objective = data.objective;
    formThesis.objective_kh = data.objective_kh;
    formThesis.description = data.description;
    formThesis.organization = data.organization;
    formThesis.organization_type = data.organization_type;
    formThesis.organization_address = data.organization_address;
    formThesis.organization_phone = data.organization_phone;
    formThesis.organization_email = data.organization_email;
    formThesis.lecturer_id = data.lecturer_id;
};
const onDeleteThesis = (thesisID: number) => {
    Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(
                route("thesises.management.thesises.delete", thesisID),
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success",
                            icon: "success",
                            timer: 1000,
                        });
                    },
                },
            );
        }
    });
};
const onCloseThesis = () => {
    if (formThesis.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will lose your unsaved changes!",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                formThesis.reset();
                formThesis.clearErrors();
                showModal.value = false;
            }
        });
    } else {
        formThesis.reset();
        formThesis.clearErrors();
        showModal.value = false;
    }
};

watch(
    () => props.thesisCommittees,
    (newThesisCommittees) => {
        thesisCommittees.value = newThesisCommittees;
    },
);
const formThesisCommittee = useForm({
    id: null,
    thesis_id: "",
    lecturer_id: "",
    role: "",
    title: "",
});
const onSaveThesisCommittee = () => {
    formThesisCommittee.post(
        route(
            "thesises.management.thesisCommittees.store",
            formThesisCommittee.id,
        ),
        {
            onSuccess: async () => {
                Swal.fire({
                    title: "Success",
                    icon: "success",
                    toast: true,
                    position: "top-end",
                    timer: 5000,
                    showConfirmButton: false,
                });
                formThesisCommittee.reset();
                formThesisCommittee.isDirty = false;
            },
        },
    );
};
const editThesisCommittee = async (thesisCommitteeID: number) => {
    const { data } = await fetch<{}>(
        route("thesises.management.thesisCommittees.edit", thesisCommitteeID),
    );
    formThesisCommittee.id = data.id;
    formThesisCommittee.thesis_id = data.thesis_id;
    formThesisCommittee.lecturer_id = data.lecturer_id;
    formThesisCommittee.role = data.role;
    formThesisCommittee.title = data.title;
};
const onDeleteThesisCommittee = (thesisCommitteeID: number) => {
    Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(
                route(
                    "thesises.management.thesisCommittees.delete",
                    thesisCommitteeID,
                ),
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success",
                            icon: "success",
                            timer: 1000,
                        });
                    },
                },
            );
        }
    });
};
const onCloseThesisCommittee = () => {
    if (formThesisCommittee.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will lose your unsaved changes!",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                formThesisCommittee.reset();
                formThesisCommittee.clearErrors();
                showModal.value = false;
            }
        });
    } else {
        formThesisCommittee.reset();
        formThesisCommittee.clearErrors();
        showModal.value = false;
    }
};

watch(
    () => props.thesisStudents,
    (newThesisStudents) => {
        thesisStudents.value = newThesisStudents;
    },
);
const formThesisStudent = useForm({
    id: null,
    thesis_id: "",
    student_id: "",
    phone: "",
    email: "",
    remark: "",
});
const onSaveThesisStudent = () => {
    formThesisStudent.post(
        route("thesises.management.thesisStudents.store", formThesisStudent.id),
        {
            onSuccess: async () => {
                Swal.fire({
                    title: "Success",
                    icon: "success",
                    toast: true,
                    position: "top-end",
                    timer: 5000,
                    showConfirmButton: false,
                });
                formThesisStudent.reset();
                formThesisStudent.isDirty = false;
            },
        },
    );
};
const editThesisStudent = async (thesisStudentID: number) => {
    const { data } = await fetch<{}>(
        route("thesises.management.thesisStudents.edit", thesisStudentID),
    );
    formThesisStudent.id = data.id;
    formThesisStudent.thesis_id = data.thesis_id;
    formThesisStudent.student_id = data.student_id;
    formThesisStudent.phone = data.phone;
    formThesisStudent.email = data.email;
    formThesisStudent.remark = data.remark;
};
const onDeleteThesisStudent = (thesisStudentID: number) => {
    Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(
                route(
                    "thesises.management.thesisStudents.delete",
                    thesisStudentID,
                ),
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success",
                            icon: "success",
                            timer: 1000,
                        });
                    },
                },
            );
        }
    });
};
const onCloseThesisStudent = () => {
    if (formThesisStudent.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will lose your unsaved changes!",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                formThesisStudent.reset();
                formThesisStudent.clearErrors();
                showModal.value = false;
            }
        });
    } else {
        formThesisStudent.reset();
        formThesisStudent.clearErrors();
        showModal.value = false;
    }
};

const onAddStudent = () => {};
const onAddAdvisor = () => {};
const onAddCommittee = () => {};

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
                                    <div
                                        class="flex items-center justify-center gap-1"
                                    >
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
        <div role="tablist" class="bg-base-100 tabs tabs-lifted p-2">
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="font-bold tab mr-2 cursor-none"
                aria-label="General Thesis Informations"
            />

            <div
                role="tabpanel"
                class="p-6 overflow-x-auto tab-content border-base-300 rounded-box"
            >
                <div class="flex-1 bg-base-100 p-2 overflow-auto">
                    <!-- Input Thesis more Detail -->
                    <div class="space-y-1">
                        <div
                            class="flex flex-col lg:flex-row items-center gap-2"
                        >
                            <div class="w-full flex flex-col">
                                <label class="label">
                                    Year <span class="text-error">*</span>
                                </label>
                                <select
                                    v-model="formThesis.year"
                                    class="w-full select select-primary"
                                >
                                    <option value="">
                                        Select a Student Year
                                    </option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                </select>
                            </div>

                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Major <span class="text-error">*</span>
                                </label>
                                <select
                                    v-model="formThesis.major"
                                    class="w-full select select-primary"
                                >
                                    <option value="">Select a Major</option>
                                    <option>General Medicien</option>
                                    <option>Nurse</option>
                                    <option>Midwife</option>
                                    <option>Pharmarcy</option>
                                    <option>Dentist</option>
                                </select>
                            </div>

                            <div class="w-full flex flex-col">
                                <label class="label">
                                    Batch <span class="text-error">*</span>
                                </label>
                                <input
                                    v-model="formThesis.batch"
                                    type="number"
                                    class="w-full input input-primary"
                                    placeholder="Batch"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-col lg:flex-row items-center gap-2"
                        >
                            <div class="w-full flex flex-col">
                                <label class="label">
                                    Topic in Khmer
                                    <span class="text-error">*</span>
                                </label>
                                <!-- <input type="text" class="w-full textarea textarea-primary" /> -->
                                <textarea
                                    v-model="formThesis.topic_kh"
                                    class="w-full textarea textarea-primary"
                                    placeholder="Topic in Khmer"
                                ></textarea>
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="label">
                                    Topic in English<span class="text-error"
                                        >*</span
                                    >
                                </label>
                                <textarea
                                    v-model="formThesis.topic"
                                    class="w-full textarea textarea-primary"
                                    placeholder="Topic in English"
                                ></textarea>
                            </div>
                        </div>

                        <div
                            class="flex flex-col lg:flex-row items-center gap-2"
                        >
                            <div class="w-full flex flex-col">
                                <label class="label">
                                    Objective in Khmer
                                    <span class="text-error">*</span></label
                                >
                                <textarea
                                    v-model="formThesis.objective_kh"
                                    class="w-full textarea textarea-primary"
                                    placeholder="Objective in Khmer"
                                ></textarea>
                            </div>

                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Objective in English<span
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <textarea
                                    v-model="formThesis.objective"
                                    class="w-full textarea textarea-primary textarea-sm"
                                    placeholder="Objective in English"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Input Organizaition -->
                    <div
                        class="p-2 mt-4 mb-4 border-2 border-solid rounded-lg flex flex-col lg:flex-col"
                    >
                        <h2 class="text-lg font-bold">Organization</h2>

                        <div
                            class="flex flex-col lg:flex-row items-center gap-2"
                        >
                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Name <span class="text-error">*</span>
                                </label>
                                <input
                                    v-model="formThesis.organization"
                                    class="w-full input input-primary"
                                    placeholder="Organization Name"
                                />
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Type<span class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_type"
                                    class="w-full input input-primary"
                                    placeholder="Type of Organization"
                                />
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Phone Number<span class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    type="number"
                                    v-model="formThesis.organization_phone"
                                    class="w-full input input-primary"
                                    placeholder="012 345 678"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-col lg:flex-row items-center gap-2"
                        >
                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Email<span class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_email"
                                    type="email"
                                    class="w-full input input-primary"
                                    placeholder="username@gmail.com"
                                />
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="label"
                                    >Address of Organization<span
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_address"
                                    class="w-full input input-primary"
                                    placeholder="E.g.Keo Chenda St, Songkat Chrouy Changva, Khan Russey Keo, Phnom Penh."
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Table show Student -->
                    <div class="p-2 mt-1 bg-base-200 rounded-xl">
                        <h4 class="text-lg text-center">
                            Students Recently Added
                        </h4>
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
                        <!-- <div
                            class="overflow-x-auto border-base-200 border rounded-xl mt-2 bg-base-100"
                        > -->
                        <div
                            class="mt-2 overflow-hidden border bg-base-100 rounded-xl"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table
                                    class="overflow-x-auto w-full base-table2 fle flex-col"
                                >
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
                                            <td class="font-bold text-blue-800">
                                                B20228888
                                            </td>
                                            <td>Student Name</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-square btn-sm"
                                                >
                                                    <EyeIcon class="w-4 h-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-warning btn-square btn-sm"
                                                >
                                                    <PenBoxIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-error btn-square btn-sm"
                                                >
                                                    <TrashIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Button Close and Save -->
                    <div
                        class="flex flex-row items-center justify-end gap-2 mt-2 border-t"
                    >
                        <div class="space-x-1"></div>
                        <div class="space-x-1">
                            <Button
                                class="bg-warning hover:bg-warning/90"
                                type="button"
                                @click="onCloseThesis"
                            >
                                Close
                            </Button>
                            <Button
                                class="text-gray-100 bg-success hover:bg-success/90"
                                type="button"
                                @click.prevent="onSaveThesis"
                            >
                                Save
                            </Button>
                        </div>
                    </div>
                </div>
            </div>

            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="font-bold tab"
                aria-label="Advisors and Committees"
                defaultChecked
            />
            <div
                role="tabpanel"
                class="p-6 overflow-x-auto tab-content bg-base-100 border-base-300 rounded-box"
            >
                <!-- Advisor -->
                <div class="p-2 mt-4 border-2 border-solid rounded-lg">
                    <!-- Header -->
                    <h2 class="text-lg font-bold">Advisor</h2>
                    <!-- Input Advisor -->
                    <div class="flex flex-col lg:flex-row items-center gap-2">
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Advisor Name<span class="text-error"
                                    >*</span
                                ></label
                            >
                            <input
                                type="text"
                                class="w-full input input-primary"
                                placeholder="Advisor Name"
                            />
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Gender<span class="text-error">*</span></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Phone Number
                                <span class="text-error">*</span></label
                            >
                            <input
                                type="number"
                                class="w-full input input-primary"
                                placeholder="012 345 678"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center gap-2">
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Dapartment<span class="text-error"
                                    >*</span
                                ></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Department</option>
                                <option>Nursing</option>
                                <option>Pharmacy</option>
                                <option>General Medical</option>
                                <option>Laboratory Sciences</option>
                                <option>Health Administration</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Email<span class="text-error">*</span></label
                            >
                            <input
                                class="w-full input input-primary"
                                type="email"
                                placeholder="username@gmail.com"
                            />
                        </div>
                    </div>
                    <!-- Table show Advisor-->
                    <div class="p-2 mt-2 bg-base-200 rounded-xl">
                        <h4 class="text-lg text-center">
                            Advisor Recently Added
                        </h4>
                        <div
                            class="flex items-center justify-between gap-3 p-2 mt-2 bg-base-100 rounded-xl"
                        >
                            <form @submit.prevent="onAddCommittee">
                                <input
                                    type="text"
                                    class="mr-1 input input-primary"
                                    placeholder="Advisor Name"
                                    required
                                />
                                <button class="btn btn-success">Add</button>
                            </form>
                        </div>
                        <!-- <div
                            class="max-h-[calc(100vh-550px)] overflow-auto border-base-200 border rounded-xl mt-2 bg-base-100"
                        > -->
                        <div
                            class="mt-2 overflow-hidden border bg-base-100 rounded-xl"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table class="w-full base-table2">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Advisor Name</th>
                                            <th>Sex</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>1</td>
                                            <td class="font-bold text-blue-800">
                                                Advisor Name
                                            </td>
                                            <td>Male</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-square btn-sm"
                                                >
                                                    <EyeIcon class="w-4 h-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-warning btn-square btn-sm"
                                                >
                                                    <PenBoxIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-error btn-square btn-sm"
                                                >
                                                    <TrashIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Button Close & Save -->
                    <div
                        class="flex items-center justify-end gap-2 mt-2 border-t"
                    >
                        <div class="space-x-1"></div>
                        <div class="space-x-1">
                            <Button
                                class="bg-warning hover:bg-warning/90"
                                type="button"
                                @click="onCloseModalAdvisor"
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

                <!-- Committee -->
                <div class="p-2 mt-4 border-2 border-solid rounded-lg">
                    <!-- Header -->
                    <h2 class="text-lg font-bold">Committee</h2>
                    <!-- Input Committee -->
                    <div class="flex flex-col lg:flex-row items-center gap-2">
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Committee Name<span class="text-error"
                                    >*</span
                                ></label
                            >
                            <input
                                type="text"
                                class="w-full input input-primary"
                                placeholder="Committee Name"
                            />
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Gender<span class="text-error">*</span></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Phone Number
                                <span class="text-error">*</span></label
                            >
                            <input
                                type="number"
                                class="w-full input input-primary"
                                placeholder="012 345 678"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center gap-2">
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Dapartment<span class="text-error"
                                    >*</span
                                ></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Department</option>
                                <option>Nursing</option>
                                <option>Pharmacy</option>
                                <option>General Medical</option>
                                <option>Laboratory Sciences</option>
                                <option>Health Administration</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="label"
                                >Email<span class="text-error">*</span></label
                            >
                            <input
                                class="w-full input input-primary"
                                type="email"
                                placeholder="username@gmail.com"
                            />
                        </div>
                    </div>
                    <!-- Table show Committee-->
                    <div class="p-2 mt-2 bg-base-200 rounded-xl">
                        <h4 class="text-lg text-center">
                            Committee Recently Added
                        </h4>
                        <div
                            class="flex items-center justify-between gap-3 p-2 mt-2 bg-base-100 rounded-xl"
                        >
                            <form @submit.prevent="onAddCommittee">
                                <input
                                    type="text"
                                    class="mr-1 input input-primary"
                                    placeholder="Committee Name"
                                    required
                                />
                                <button class="btn btn-success">Add</button>
                            </form>
                        </div>
                        <!-- <div
                            class="max-h-[calc(100vh-550px)] overflow-auto border-base-200 border rounded-xl mt-2 bg-base-100"
                        > -->
                        <div
                            class="mt-2 overflow-hidden border bg-base-100 rounded-xl"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table class="w-full base-table2">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Committee Name</th>
                                            <th>Sex</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>1</td>
                                            <td class="font-bold text-blue-800">
                                                Committee Name
                                            </td>
                                            <td>Male</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-square btn-sm"
                                                >
                                                    <EyeIcon class="w-4 h-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-warning btn-square btn-sm"
                                                >
                                                    <PenBoxIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="ml-1 btn btn-error btn-square btn-sm"
                                                >
                                                    <TrashIcon
                                                        class="w-4 h-4"
                                                    />
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Button Close & Save -->
                    <div
                        class="flex items-center justify-end gap-2 mt-2 border-t"
                    >
                        <div class="space-x-1"></div>
                        <div class="space-x-1">
                            <Button
                                class="bg-warning hover:bg-warning/90"
                                type="button"
                                @click="onCloseModalAdvisor"
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
            </div>
        </div>
    </ModalBreeze>
</template>
<style></style>
