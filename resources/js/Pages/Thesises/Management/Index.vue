<script setup lang="ts">
import ModalBreeze from "@/Components/ModalBreeze.vue";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteesType } from "@/types/Thesis/thesisCommitteesType";
import { ThesisesType } from "@/types/Thesis/thesisesType";
import { ThesisStudentsType } from "@/types/Thesis/thesisStudentType";
import PaginationTw2 from "@/Components/PaginationTw2.vue";
import {
    EyeIcon,
    CloudArrowDownIcon,
    // PrinterIcon,
    AcademicCapIcon,
    ArrowPathIcon,
    XCircleIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
import { router, useForm } from "@inertiajs/vue3";
import {
    PenBoxIcon,
    PencilIcon,
    TrashIcon,
    Plus,
    Printer,
    PrinterIcon,
    SearchIcon,
} from "lucide-vue-next";
import Swal from "sweetalert2";
import { ref, watch, toRef } from "vue";
import useAxios from "@/Composables/useAxios";
import CamboboxHeadless from "@/Components/CamboboxHeadless.vue";
import { throttle, pickBy } from "lodash";
import { LecturerType } from "@/types/LecturerType";
import axios from "axios";
import AxiosPaginationTw from "@/Components/AxiosPaginationTw.vue";
import { Select } from "@/Components/ui/select";
import { StudentOldType, StudentType as BaStudentType } from "@/types/student";
import { ResourcePaginateType } from "@/types/ResourcePaginateType";
import usePrintV2 from "@/Composables/usePrintV2";

import { StudentType } from "@/types/student";

const { fetch } = useAxios();

const showModalThesis = ref(false);
const showModalAdvisor = ref(false);
const showModalCommittee = ref(false);
const showModalStudentGroupThesis = ref(false);
const showModalThesisReport = ref(false);

const onAddCommittee = () => {};

const onCloseModalThesis = () => {
    showModalThesis.value = false;
};
const onCloseModalAdvisor = () => {
    showModalAdvisor.value = false;
};

interface Props {
    filters?: {
        keyword?: string;
        thesis_id?: number;
        major?: string;
        year?: string;
        batch?: number;
        topic?: string;
        lecturer_id?: string;
        group_id?: string;
        academic_year?: string;
    };
    thesises: PaginateType<ThesisesType>;
    thesisCommittees: ThesisCommitteesType[];
    thesisStudents: ThesisStudentsType[];

    lecturers: LecturerType[];
    student: StudentType;
    keywords?: string;
    data?: string;
    studentOld?: StudentOldType;
    baStudent?: BaStudentType;
    studentOlds?: ResourcePaginateType<StudentOldType>;
    baStudents?: ResourcePaginateType<BaStudentType>;
    errors: Record<string, string[]>;
}
const props = defineProps<Props>();

const thesises = ref<PaginateType<ThesisesType>>(props.thesises);
const thesisCommittees = ref<ThesisCommitteesType[]>(props.thesisCommittees);
const thesisStudents = ref<ThesisStudentsType[]>(props.thesisStudents);

const lecturers = ref<LecturerType[]>(props.lecturers);
const student = ref<StudentType>(props.student);

// ------------------- Search Student -------------------
const searchFrom = ref<string>(props.data || "new");
const keywords = toRef(props.keywords);
const onSearch = () => {
    router.get(route("thesises.management.index"), {
        q: keywords.value,
        data: searchFrom.value,
    });
};

// ------------------- Thesis Form -------------------
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
const onSaveThesis = (thesisID: number) => {
    formThesis.post(route("thesises.management.thesises.store", thesisID), {
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
    });
};
const editThesis = async (thesisID: number) => {
    try {
        const { data } = await fetch<{
            thesis: ThesisesType;
            committee: ThesisCommitteesType[];
            student: StudentType[];
            lecturer: LecturerType;
        }>(route("thesises.management.thesises.edit", thesisID));
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

        formThesis.lecturer_id = data.lecturer.name;
    } catch (error) {
        console.error("Edit Error: ", error);
    }
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
                showModalThesis.value = false;
            }
        });
    } else {
        formThesis.reset();
        formThesis.clearErrors();
        showModalThesis.value = false;
    }
};

// ------------------- Thesis Committee & Advisor Form -------------------
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
const onSaveThesisCommittee = (thesisCommitteeID: number) => {
    formThesisCommittee.post(
        route("thesises.management.thesisCommittees.store", thesisCommitteeID),
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
    try {
        const { data } = await fetch<{
            thesisCommittee: ThesisCommitteesType;
            thesis: ThesisesType;
            student: ThesisStudentsType;
            lecturer: LecturerType;
        }>(
            route(
                "thesises.management.thesisCommittees.edit",
                thesisCommitteeID,
            ),
        );
        formThesisCommittee.id = data.id;
        formThesisCommittee.thesis_id = data.thesis.id;
        formThesisCommittee.lecturer_id = data.lecturer.name;
        formThesisCommittee.role = data.lecturer.role;
        formThesisCommittee.title = data.lecturer.title;
        formThesisCommittee.lecturer_id = data.lecturer.gender;
        formThesisCommittee.lecturer_id = data.lecturer.email;
        formThesisCommittee.lecturer_id = data.lecturer.mobile;
        formThesisCommittee.lecturer_id = data.lecturer.status;
        formThesisCommittee.lecturer_id = data.lecturer.id;
    } catch (error) {
        console.error("Edit Error: ", error);
    }
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
                showModalThesis.value = false;
            }
        });
    } else {
        formThesisCommittee.reset();
        formThesisCommittee.clearErrors();
        showModalThesis.value = false;
    }
};

// ------------------- Thesis Student Form -------------------
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
const onSaveThesisStudent = (thesisStudentID: number) => {
    formThesisStudent.post(
        route("thesises.management.thesisStudents.store", thesisStudentID),
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
    try {
        const { data } = await fetch<{
            thesisStudent: ThesisStudentsType;
            thesis: ThesisesType;
            student: StudentType;
        }>(route("thesises.management.thesisStudents.edit", thesisStudentID));
        formThesisStudent.id = data.id;
        // formThesisStudent.thesis_id = data.thesis_id;
        // formThesisStudent.student_id = data.student_id;
        formThesisStudent.phone = data.phone;
        formThesisStudent.email = data.email;
        formThesisStudent.remark = data.remark;

        formThesisStudent.thesis_id = data.thesis.id;
        formThesisStudent.student_id = data.student.name_of_student;
    } catch (error) {
        console.error("Edit Error: ", error);
    }
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
                showModalStudentGroupThesis.value = false;
            }
        });
    } else {
        formThesisStudent.reset();
        formThesisStudent.clearErrors();
        showModalStudentGroupThesis.value = false;
    }
};

// ------------------- Filter Form -------------------
const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
    thesis_id: props.filters?.thesis_id ?? null,
    major: props.filters?.major ?? "",
    year: props.filters?.year ?? "",
    batch: props.filters?.batch ?? "",
    topic: props.filters?.topic ?? null,
    advisor: props.filters?.lecturer_id ?? null,
    committee: props.filters?.lecturer_id ?? "",
    group_id: props.filters?.group_id ?? "",
    academic_year: props.filters?.academic_year ?? "",
});

const searchThesises = throttle(() => {
    router.get(route("thesises.management.index"), pickBy(filterForm.data()), {
        preserveState: true,
        only: ["thesises"],
        replace: true,
    });
}, 500);
watch(
    () => [
        filterForm.keyword,
        filterForm.thesis_id,
        filterForm.major,
        filterForm.year,
        filterForm.batch,
        filterForm.topic,
        filterForm.advisor,
        filterForm.committee,
        filterForm.group_id,
        filterForm.academic_year,
    ],
    searchThesises,
);
const onClearFilter = () => {
    filterForm.keyword = "";
    filterForm.thesis_id = null;
    filterForm.major = "";
    filterForm.year = "";
    filterForm.batch = "";
    filterForm.topic = null;
    filterForm.advisor = null;
    filterForm.committee = "";
    filterForm.group_id = "";
    filterForm.academic_year = "";
    // filterForm.brand_id = null as number;
};
</script>
<template>
    <App
        :breadcrumbs="[
            {
                name: 'Graduate School',
                url: route('thesises.index'),
            },
            {
                name: 'Examination  Management',
                url: route('thesises.management.index'),
            },
        ]"
        title="Examination link management"
    >
        <div
            class="mb-3 w-full space-y-2 overflow-x-auto rounded-xl bg-base-200/15 p-2"
        >
            <!-- Button -->
            <div class="rounded-xl border bg-base-100 p-2">
                <div class="flex gap-2 overflow-x-auto">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click="showModalThesis = true"
                    >
                        <plus class="h-4 w-4" />
                        New
                    </button>

                    <button
                        type="button"
                        class="btn btn-warning"
                        @click="showModalAdvisor = true"
                    >
                        <AcademicCapIcon class="h-4 w-4" />
                        Advisors
                    </button>
                    <!-- <div class="ml-auto"> -->
                    <button
                        type="button"
                        class="btn btn-error"
                        @click="showModalThesisReport = true"
                    >
                        <Printer class="h-4 w-4" />
                        Thesis's Report
                    </button>
                    <!-- </div> -->
                </div>
            </div>
            <!-- Filter Form -->
            <div class="rounded-xl border bg-base-100 p-2">
                <div class="md w-full overflow-x-auto md:w-1/2">
                    <div
                        class="m-1 flex flex-col items-center gap-2 md:flex-row"
                    >
                        <Input
                            v-model="filterForm.keyword"
                            class="input input-primary h-12 w-full border border-primary bg-base-100 font-bold"
                            placeholder="Student ID..."
                        />
                        <!--Advisor  dropdown -->
                        <CamboboxHeadless
                            v-model="filterForm.advisor"
                            :options="
                                thesises.data.map((item) => {
                                    return {
                                        value: item.id,
                                        label: item.lecturer_id,
                                    };
                                })
                            "
                            placeholder="Advisors"
                            class="h-12 w-full border border-primary bg-base-100 font-bold"
                        />
                        <!--Committee  dropdown -->
                        <CamboboxHeadless
                            v-model="filterForm.committee"
                            :options="
                                thesises.data.map((item) => {
                                    return {
                                        value: item.id,
                                        label: item.lecturer_id,
                                    };
                                })
                            "
                            placeholder="Committee"
                            class="h-12 w-full border border-primary bg-base-100 font-bold"
                        />
                        <!--Groups  dropdown -->
                        <CamboboxHeadless
                            v-model="filterForm.group_id"
                            :options="
                                thesises.data.map((item) => {
                                    return {
                                        value: item.group_id,
                                        label: item.group_id,
                                    };
                                })
                            "
                            placeholder="Groups "
                            class="h-12 w-full border border-primary bg-base-100 font-bold"
                        />
                        <div class="ml-auto w-full">
                            <!-- Reset button -->
                            <button
                                type="button"
                                class="btn btn-warning w-full md:w-auto"
                                @click="onClearFilter"
                            >
                                <ArrowPathIcon class="h-4 w-4" />Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="mt-2 overflow-hidden rounded-xl border bg-base-100">
                <div class="overflow-x-auto whitespace-nowrap">
                    <table class="base-table2 w-full">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Majors</th>
                                <th>Year</th>
                                <th>Topic</th>
                                <th>Advisor(s)</th>
                                <th>Student(s)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr
                                v-for="(thesis, index) in thesises.data"
                                :key="thesis.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    {{ thesis.major }}
                                </td>
                                <td>{{ thesis.year }}</td>
                                <td>
                                    {{ thesis.topic }}
                                </td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    {{ thesis.lecturer.name }}<br />
                                    {{ thesis.lecturer.id }}
                                </td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    {{ thesis.student.name_of_student }}<br />
                                    {{ thesis.student.id }}
                                </td>
                                <td>
                                    <div
                                        class="flex items-center justify-center gap-1"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm"
                                            @click="editThesis(thesis.id)"
                                        >
                                            <EyeIcon class="h-4 w-4" />
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-square btn-success btn-sm"
                                            @click="editThesis(thesis.id)"
                                        >
                                            <PencilIcon class="h-4 w-4" />
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-square btn-error btn-sm"
                                            @click="onDeleteThesis(thesis.id)"
                                        >
                                            <TrashIcon class="h-4 w-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination -->
            <div class="rounded-xl border">
                <!-- <PaginationTw2 :only="['thesises']" :paginate-data="thesises" /> -->
                <AxiosPaginationTw
                    v-if="thesises"
                    :key="thesises.current_page"
                    :current-page="thesises.current_page"
                    :from="thesises.from"
                    :to="thesises.to"
                    :links="thesises.links"
                    :per-page="thesises.per_page"
                    :total="thesises.total"
                    :last-page="thesises.last_page"
                    @update:data="thesises = $event"
                />
            </div>
        </div>
    </App>

    <!-- Thesis -->
    <ModalBreeze
        :show="showModalThesis"
        :is-no-padding="true"
        max-width="7xl"
        @close="onCloseModalThesis"
    >
        <div
            role="tablist"
            class="tabs tabs-lifted bg-gray-300 p-2 dark:bg-gray-700"
        >
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="tab font-bold"
                aria-label="General Thesis Informations"
                defaultChecked
            />
            <div
                role="tabpanel"
                class="tab-content overflow-x-auto rounded-box border-base-300 bg-base-100 p-6"
            >
                <div class="flex-1 overflow-auto bg-base-100 p-2">
                    <!-- Input Thesis more Detail -->
                    <div class="space-y-1">
                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Year
                                    <span
                                        v-if="formThesis.errors.year"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <select
                                    v-model="formThesis.year"
                                    class="select select-primary w-full"
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

                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Major
                                    <span
                                        v-if="formThesis.errors.major"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <select
                                    v-model="formThesis.major"
                                    class="select select-primary w-full"
                                >
                                    <option value="">Select a Major</option>
                                    <option>General Medicien</option>
                                    <option>Nurse</option>
                                    <option>Midwife</option>
                                    <option>Pharmarcy</option>
                                    <option>Dentist</option>
                                </select>
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Batch
                                    <span
                                        v-if="formThesis.errors.batch"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <input
                                    v-model="formThesis.batch"
                                    type="number"
                                    class="input input-primary w-full"
                                    placeholder="Batch"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Group ID
                                    <span
                                        v-if="formThesis.errors.group_id"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <!--Group ID dropdown -->
                                <CamboboxHeadless
                                    v-model="formThesis.group_id"
                                    :options="
                                        thesises.data.map((item) => {
                                            return {
                                                value: item.group_id,
                                                label: item.group_id,
                                            };
                                        })
                                    "
                                    placeholder="Group ID"
                                    class="h-12 w-full border border-primary bg-base-100 font-bold"
                                />
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Academic Year
                                    <span
                                        v-if="formThesis.errors.academic_year"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <select
                                    v-model="formThesis.academic_year"
                                    class="select select-primary w-full"
                                >
                                    <option value="">
                                        Select a Academic Year
                                    </option>
                                    <option>2022-2023</option>
                                    <option>2023-2024</option>
                                    <option>2024-2025</option>
                                    <option>2025-2026</option>
                                    <option>2026-2027</option>
                                </select>
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Lecturer ID
                                    <span
                                        v-if="formThesis.errors.lecturer_id"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <!--Lecturer dropdown -->
                                <CamboboxHeadless
                                    v-model="formThesis.lecturer_id"
                                    :options="
                                        (lecturers || []).map((item) => {
                                            return {
                                                value: item.id,
                                                label: item.name,
                                            };
                                        })
                                    "
                                    placeholder="Advisors"
                                    class="h-12 w-full border border-primary bg-base-100 font-bold"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Topic in Khmer
                                    <span
                                        v-if="formThesis.errors.topic_kh"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <textarea
                                    v-model="formThesis.topic_kh"
                                    class="textarea textarea-primary w-full"
                                    placeholder="Topic in Khmer"
                                ></textarea>
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Topic in English<span
                                        v-if="formThesis.errors.topic"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <textarea
                                    v-model="formThesis.topic"
                                    class="textarea textarea-primary w-full"
                                    placeholder="Topic in English"
                                ></textarea>
                            </div>
                        </div>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label">
                                    Objective in Khmer
                                    <span
                                        v-if="formThesis.errors.objective_kh"
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <textarea
                                    v-model="formThesis.objective_kh"
                                    class="textarea textarea-primary w-full"
                                    placeholder="Objective in Khmer"
                                ></textarea>
                            </div>

                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Objective in English<span
                                        v-if="formThesis.errors.objective"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <textarea
                                    v-model="formThesis.objective"
                                    class="textarea textarea-primary textarea-sm w-full"
                                    placeholder="Objective in English"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Input Organizaition -->
                    <div
                        class="mb-4 mt-4 flex flex-col rounded-lg border-2 border-solid p-2 lg:flex-col"
                    >
                        <h2 class="text-lg font-bold">Organization</h2>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Name
                                    <span
                                        v-if="formThesis.errors.organization"
                                        class="text-error"
                                        >*</span
                                    >
                                </label>
                                <input
                                    v-model="formThesis.organization"
                                    class="input input-primary w-full"
                                    placeholder="Organization Name"
                                />
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Type<span
                                        v-if="
                                            formThesis.errors.organization_type
                                        "
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_type"
                                    class="input input-primary w-full"
                                    placeholder="Type of Organization"
                                />
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Phone Number<span
                                        v-if="
                                            formThesis.errors.organization_phone
                                        "
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_phone"
                                    type="number"
                                    class="input input-primary w-full"
                                    placeholder="012 345 678"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Email<span
                                        v-if="
                                            formThesis.errors.organization_email
                                        "
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_email"
                                    type="email"
                                    class="input input-primary w-full"
                                    placeholder="username@gmail.com"
                                />
                            </div>
                            <div class="flex w-full flex-col">
                                <label class="label"
                                    >Address of Organization<span
                                        v-if="
                                            formThesis.errors
                                                .organization_address
                                        "
                                        class="text-error"
                                        >*</span
                                    ></label
                                >
                                <input
                                    v-model="formThesis.organization_address"
                                    class="input input-primary w-full"
                                    placeholder="E.g.Keo Chenda St, Songkat Chrouy Changva, Khan Russey Keo, Phnom Penh."
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Table Show Student -->
                    <div class="mt-1 rounded-xl bg-base-200 p-2">
                        <h4 class="text-center text-lg">
                            Students Recently Added
                        </h4>
                        <div
                            class="mt-2 flex items-center justify-between gap-3 rounded-xl bg-base-100 p-2"
                        >
                            <form @submit.prevent="onSearch">
                                <!-- <label class="flex items-center gap-2 pr-0.5"> -->
                                <input
                                    ref="searchInput"
                                    v-model="keywords"
                                    type="text"
                                    class="input input-primary mr-1 grow"
                                    placeholder="Student ID"
                                    required
                                    tabindex="0"
                                    autofocus
                                />
                                <Select v-model="searchFrom"> </Select>
                                <button type="submit" class="btn btn-success">
                                    <Plus class="h-4 w-4" />Add
                                </button>
                                <!-- </label> -->
                            </form>
                        </div>
                        <div
                            class="mt-2 overflow-hidden rounded-xl border bg-base-100"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table
                                    class="base-table2 fle w-full flex-col overflow-x-auto"
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
                                        <tr v-if="student">
                                            <td>{{ 1 }}</td>
                                            <td class="font-bold text-blue-800">
                                                {{ student.id }}
                                            </td>
                                            <td>
                                                {{ student.name_of_student }}
                                            </td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-success btn-sm"
                                                >
                                                    <EyeIcon class="h-4 w-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-warning btn-sm ml-1"
                                                >
                                                    <PenBoxIcon
                                                        class="h-4 w-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-error btn-sm ml-1"
                                                >
                                                    <TrashIcon
                                                        class="h-4 w-4"
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
                        class="mt-2 flex flex-row items-center justify-end gap-2 border-t"
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
                                class="bg-success text-gray-100 hover:bg-success/90"
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
                class="tab font-bold"
                aria-label="Advisors and Committees"
            />
            <div
                role="tabpanel"
                class="tab-content overflow-x-auto rounded-box border-base-300 bg-base-100 p-6"
            >
                <!-- Advisor -->
                <div class="mt-4 rounded-lg border-2 border-solid p-2">
                    <!-- Header -->
                    <h2 class="text-lg font-bold">Advisor</h2>
                    <!-- Input Advisor -->
                    <!-- <div class="flex flex-col items-center gap-2 lg:flex-row">
            <div class="flex w-full flex-col">
              <label class="label"
                >Advisor Name<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                type="text"
                class="input input-primary w-full"
                placeholder="Advisor Name"
              />
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Gender<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <select
                v-model="formThesisCommittee.lecturer_id"
                class="select select-primary w-full"
              >
                <option value="">Select a Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Phone Number
                <span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                type="number"
                class="input input-primary w-full"
                placeholder="012 345 678"
              />
            </div>
          </div>
          <div class="flex flex-col items-center gap-2 lg:flex-row">
            <div class="flex w-full flex-col">
              <label class="label"
                >Dapartment<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <select
                v-model="formThesisCommittee.lecturer_id"
                class="select select-primary w-full"
              >
                <option value="">Select a Department</option>
                <option>Nursing</option>
                <option>Pharmacy</option>
                <option>General Medical</option>
                <option>Laboratory Sciences</option>
                <option>Health Administration</option>
              </select>
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Email<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                class="input input-primary w-full"
                type="email"
                placeholder="username@gmail.com"
              />
            </div>
          </div> -->
                    <!-- Table show Advisor-->
                    <div class="mt-2 rounded-xl bg-base-200 p-2">
                        <h4 class="text-center text-lg">
                            Advisor Recently Added
                        </h4>
                        <div
                            class="mt-2 flex items-center justify-between gap-3 rounded-xl bg-base-100 p-2"
                        >
                            <form @submit.prevent="onSearch">
                                <input
                                    ref="searchInput"
                                    v-model="keywords"
                                    type="text"
                                    class="input input-primary mr-1"
                                    placeholder="Advisor Name"
                                    required
                                    tabindex="0"
                                    autofocus
                                />
                                <Select v-model="searchFrom"> </Select>
                                <button type="submit" class="btn btn-success">
                                    <Plus class="h-4 w-4" />Add
                                </button>
                                <!-- <button class="btn btn-success">Add</button> -->
                            </form>
                        </div>

                        <div
                            class="mt-2 overflow-hidden rounded-xl border bg-base-100"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table class="base-table2 w-full">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Advisor Name</th>
                                            <th>Sex</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr
                                            v-for="(
                                                advisor, index
                                            ) in lecturers"
                                            :key="advisor.id"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td class="font-bold text-blue-800">
                                                {{ advisor.name }}
                                            </td>
                                            <td>{{ advisor.gender }}</td>
                                            <td>{{ advisor.email }}</td>
                                            <td>{{ advisor.name_kh_en }}</td>
                                            <td>{{ advisor.email }}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-success btn-sm"
                                                    @click="
                                                        editThesisCommittee(
                                                            advisor.id,
                                                        )
                                                    "
                                                >
                                                    <EyeIcon class="h-4 w-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-warning btn-sm ml-1"
                                                    @click="
                                                        editThesisCommittee(
                                                            advisor.id,
                                                        )
                                                    "
                                                >
                                                    <PenBoxIcon
                                                        class="h-4 w-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-error btn-sm ml-1"
                                                    @click="
                                                        onDeleteThesisCommittee(
                                                            advisor.id,
                                                        )
                                                    "
                                                >
                                                    <TrashIcon
                                                        class="h-4 w-4"
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
                        class="mt-2 flex items-center justify-end gap-2 border-t"
                    >
                        <div class="space-x-1"></div>
                        <div class="space-x-1">
                            <Button
                                class="bg-warning hover:bg-warning/90"
                                type="button"
                                @click="onCloseModalThesis"
                            >
                                Close
                            </Button>
                            <Button
                                class="bg-success text-gray-100 hover:bg-success/90"
                                type="button"
                                @click.prevent="onSaveThesisCommittee"
                            >
                                Save
                            </Button>
                        </div>
                    </div>
                </div>

                <!-- Committee -->
                <div class="mt-4 rounded-lg border-2 border-solid p-2">
                    <!-- Header -->
                    <h2 class="text-lg font-bold">Committee</h2>
                    <!-- Input Committee -->
                    <!-- <div class="flex flex-col items-center gap-2 lg:flex-row">
            <div class="flex w-full flex-col">
              <label class="label"
                >Committee Name<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                type="text"
                class="input input-primary w-full"
                placeholder="Committee Name"
              />
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Gender<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <select
                v-model="formThesisCommittee.lecturer_id"
                class="select select-primary w-full"
              >
                <option value="">Select a Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Phone Number
                <span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                type="number"
                class="input input-primary w-full"
                placeholder="012 345 678"
              />
            </div>
          </div>
          <div class="flex flex-col items-center gap-2 lg:flex-row">
            <div class="flex w-full flex-col">
              <label class="label"
                >Dapartment<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <select
                v-model="formThesisCommittee.lecturer_id"
                class="select select-primary w-full"
              >
                <option value="">Select a Department</option>
                <option>Nursing</option>
                <option>Pharmacy</option>
                <option>General Medical</option>
                <option>Laboratory Sciences</option>
                <option>Health Administration</option>
              </select>
            </div>
            <div class="flex w-full flex-col">
              <label class="label"
                >Email<span
                  v-if="formThesisCommittee.errors.lecturer_id"
                  class="text-error"
                  >*</span
                ></label
              >
              <input
                v-model="formThesisCommittee.lecturer_id"
                class="input input-primary w-full"
                type="email"
                placeholder="username@gmail.com"
              />
            </div>
          </div> -->
                    <!-- Table show Committee-->
                    <div class="mt-2 rounded-xl bg-base-200 p-2">
                        <h4 class="text-center text-lg">
                            Committee Recently Added
                        </h4>
                        <div
                            class="mt-2 flex items-center justify-between gap-3 rounded-xl bg-base-100 p-2"
                        >
                            <form @submit.prevent="onAddCommittee">
                                <input
                                    type="text"
                                    class="input input-primary mr-1"
                                    placeholder="Committee Name"
                                    required
                                />
                                <button class="btn btn-success">Add</button>
                            </form>
                        </div>
                        <div
                            class="mt-2 overflow-hidden rounded-xl border bg-base-100"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table class="base-table2 w-full">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Committee Name</th>
                                            <th>Sex</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr
                                            v-for="(
                                                committee, index
                                            ) in lecturers"
                                            :key="committee.id"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td class="font-bold text-blue-800">
                                                {{ committee.name }}
                                            </td>
                                            <td>{{ committee.gender }}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-success btn-sm"
                                                    @click="
                                                        editThesisCommittee(
                                                            committee.id,
                                                        )
                                                    "
                                                >
                                                    <EyeIcon class="h-4 w-4" />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-warning btn-sm ml-1"
                                                    @click="
                                                        editThesisCommittee(
                                                            committee.id,
                                                        )
                                                    "
                                                >
                                                    <PenBoxIcon
                                                        class="h-4 w-4"
                                                    />
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-square btn-error btn-sm ml-1"
                                                    @click="
                                                        onDeleteThesisCommittee(
                                                            committee.id,
                                                        )
                                                    "
                                                >
                                                    <TrashIcon
                                                        class="h-4 w-4"
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
                        class="mt-2 flex items-center justify-end gap-2 border-t"
                    >
                        <div class="space-x-1"></div>
                        <div class="space-x-1">
                            <Button
                                class="bg-warning hover:bg-warning/90"
                                type="button"
                                @click="onCloseModalThesis"
                            >
                                Close
                            </Button>
                            <Button
                                class="bg-success text-gray-100 hover:bg-success/90"
                                type="button"
                                @click.prevent="onSaveThesisCommittee"
                            >
                                Save
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ModalBreeze>

    <!-- Advisor -->
    <ModalBreeze
        :show="showModalAdvisor"
        :is-no-padding="true"
        max-width="7xl"
        @close="onCloseModalAdvisor"
    >
        <div class="overflow-hidden rounded-2xl bg-base-100 shadow-xl">
            <div class="flex items-center justify-between gap-2"></div>

            <div
                class="max-h-[calc(100vh-150px)] overflow-auto bg-base-100 p-2"
            >
                <h2
                    class="text-center text-2xl font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                >
                    Advisor(s) List View
                </h2>
                <div
                    class="mt-2 flex flex-col items-center justify-between gap-3 rounded-xl bg-base-100 p-2 sm:flex-row"
                >
                    <form
                        class="w-full sm:w-auto"
                        onsubmit.prevent="onSaveThesisCommittee"
                    >
                        <div class="flex flex-col gap-2 sm:flex-row sm:gap-3">
                            <button class="btn btn-success w-full sm:w-auto">
                                <CloudArrowDownIcon class="h-4 w-4" />Export
                            </button>
                            <button
                                class="btn btn-error w-full text-white sm:w-auto"
                            >
                                <PrinterIcon class="h-4 w-4" />Advisor's
                                Report...
                            </button>
                        </div>
                    </form>

                    <!-- Filter  -->
                    <div
                        class="mt-2 flex w-full flex-col gap-3 overflow-x-auto p-1 sm:mt-0 sm:w-auto sm:flex-row"
                    >
                        <!-- Input field -->
                        <input
                            v-if="lecturers"
                            type="text"
                            class="input input-primary"
                            placeholder="Advisors Name..."
                        />

                        <!-- Lectures dropdown -->
                        <CamboboxHeadless
                            placeholder="Lecturers"
                            :options="
                                lecturers?.map((item) => {
                                    return {
                                        value: item.id,
                                        label: item.name,
                                    };
                                }) || []
                            "
                            class="border border-primary bg-base-100"
                        />

                        <!-- Topic dropdown -->
                        <CamboboxHeadless
                            placeholder="Topics"
                            :options="
                                thesises.data.map((item) => {
                                    return {
                                        value: item.topic,
                                        label: item.topic,
                                    };
                                })
                            "
                            class="border border-primary bg-base-100"
                        />
                        <!-- Reset button -->
                        <button
                            type="button"
                            class="btn btn-warning"
                            @click="onClearFilter"
                        >
                            <ArrowPathIcon class="h-4 w-4" />
                            Reset
                        </button>
                    </div>
                </div>

                <div class="mt-1 rounded-xl bg-base-200 p-2">
                    <h4 class="text-center text-lg">
                        Advisor(s) Recently Added
                    </h4>
                    <div
                        class="mt-2 overflow-hidden rounded-xl border bg-base-100"
                    >
                        <div class="overflow-x-auto whitespace-nowrap">
                            <table
                                class="base-table2 fle w-full flex-col overflow-x-auto"
                            >
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Advisor Name</th>
                                        <th>Gender</th>
                                        <th>Role</th>
                                        <th>Topics</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-sm">
                                    <tr
                                        v-for="(
                                            item, index
                                        ) in thesisCommittees"
                                        :key="item.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td
                                            class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                        >
                                            {{ item.lecturer.name }}
                                        </td>
                                        <td>{{ item.lecturer.gender }}</td>
                                        <td>{{ item.role }}</td>
                                        <td>{{ item.thesis.topic }}</td>

                                        <td>{{ item.lecturer.email }}</td>
                                        <td
                                            class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                        >
                                            {{ item.lecturer.mobile }}
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-square btn-success btn-sm"
                                                @click="
                                                    editThesisCommittee(item.id)
                                                "
                                            >
                                                <EyeIcon class="h-4 w-4" />
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-square btn-warning btn-sm ml-1"
                                                @click="
                                                    editThesisCommittee(item.id)
                                                "
                                            >
                                                <PenBoxIcon class="h-4 w-4" />
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-square btn-error btn-sm ml-1"
                                                @click="
                                                    onDeleteThesisCommittee(
                                                        item.id,
                                                    )
                                                "
                                            >
                                                <TrashIcon class="h-4 w-4" />
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="items mt-2 flex flex-row justify-end">
                    <button
                        class="btn btn-warning"
                        type="button"
                        @click="onCloseModalAdvisor"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </ModalBreeze>
</template>
