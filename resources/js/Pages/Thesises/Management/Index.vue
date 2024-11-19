<script setup lang="ts">
import ModalBreeze from "@/Components/ModalBreeze.vue";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteesType } from "@/types/Thesis/thesisCommitteesType";
import { ThesisesType } from "@/types/Thesis/thesisesType";
import { ThesisStudentsType } from "@/types/Thesis/thesisStudentType";
import {
    EyeIcon,
    UserGroupIcon,
    CloudArrowDownIcon,
    PrinterIcon,
    AcademicCapIcon,
} from "@heroicons/vue/24/solid";
import { router, useForm } from "@inertiajs/vue3";
import {
    PenBoxIcon,
    PencilIcon,
    TrashIcon,
    Plus,
    Printer,
} from "lucide-vue-next";
import Swal from "sweetalert2";
import { ref, watch } from "vue";
import useAxios from "@/Composables/useAxios";
import CamboboxHeadless from "@/Components/CamboboxHeadless.vue";
import { throttle, pickBy, filter } from "lodash";
const { fetch } = useAxios();

const showModalThesis = ref(false);
const showModalAdvisor = ref(false);
const showModalCommittee = ref(false);
const showModalStudentGroupThesis = ref(false);
const showModalThesisReport = ref(false);

const onCloseModalThesis = () => {
    showModalThesis.value = false;
};
const onCloseModalAdvisor = () => {
    showModalAdvisor.value = false;
};
const onCloseModalCommittee = () => {
    showModalCommittee.value = false;
};
const onCloseModalStudentGroupThesis = () => {
    showModalStudentGroupThesis.value = false;
};

interface Props {
    filters?: {
        keyword?: string;
        thesis_id?: number;
        major?: string;
        year?: string;
        topic?: string;
        lecturer_id?: string;
        group_id?: string;
        academic_year?: string;
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
                showModalThesis.value = false;
            }
        });
    } else {
        formThesis.reset();
        formThesis.clearErrors();
        showModalThesis.value = false;
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
                showModalThesis.value = false;
            }
        });
    } else {
        formThesisCommittee.reset();
        formThesisCommittee.clearErrors();
        showModalThesis.value = false;
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
                showModalStudentGroupThesis.value = false;
            }
        });
    } else {
        formThesisStudent.reset();
        formThesisStudent.clearErrors();
        showModalStudentGroupThesis.value = false;
    }
};

// ------------------------------------- Filter section----------------------
const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
    thesis_id: props.filters?.thesis_id ?? null,
    major: props.filters?.major ?? "",
    year: props.filters?.year ?? "",
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
    filterForm.topic = null;
    filterForm.advisor = null;
    filterForm.committee = "";
    filterForm.group_id = "";
    filterForm.academic_year = "";
    // filterForm.brand_id = null as number;
};

const onAddStudent = () => {};
const onAddAdvisor = () => {};
const onAddCommittee = () => {};
const onAddStudentGroupThesis = () => {};

const onSave = () => {};
</script>
<template>
    <App
        :breadcrumbs="[
            {
                name: 'Graduate School',
                url: route('thesises.index'),
            },
            {
                name: 'Examination  management',
                url: route('thesises.management.index'),
            },
        ]"
        title="Examination link management"
    >
        <div
            class="w-full p-2 mb-3 space-y-2 overflow-x-auto bg-base-200/15 rounded-xl"
        >
            <!-- <div
                class="flex flex-col p-2 mb-2 overflow-x-auto rounded-lg md:flex-row md:items-center md:justify-between bg-base-100"
            > -->
            <!-- Start Section: Input and Dropdowns -->
            <div class="flex gap-2 overflow-x-auto">
                <button
                    type="button"
                    class="btn btn-success"
                    @click="showModalThesis = true"
                >
                    <plus class="w-4 h-4" />
                    New
                </button>

                <button
                    type="button"
                    class="btn btn-warning"
                    @click="showModalAdvisor = true"
                >
                    <AcademicCapIcon class="w-4 h-4" />
                    Advisors
                </button>

                <!-- <button
                        type="button"
                        class="btn btn-primary"
                        @click="showModalStudentGroupThesis = true"
                    >
                        <UserGroupIcon class="w-4 h-4" />
                        Student Group Thesis...
                    </button> -->
                <!-- End Section: Buttons -->
                <div class="ml-auto md:flex-auto">
                    <button
                        type="button"
                        class="btn btn-error"
                        @click="showModalThesisReport = true"
                    >
                        <Printer class="w-4 h-4" />
                        Thesis Rported...
                    </button>
                </div>
            </div>
            <!-- </div> -->
            <div class="w-full overflow-x-auto md">
                <div
                    class="flex flex-col items-center gap-2 m-1 mb-6 md:flex-row"
                >
                    <Input
                        class="w-full h-10 font-bold border border-primary input bg-base-100 input-primary"
                        placeholder="Student ID..."
                        v-model="filterForm.keyword"
                    />

                    <!--Majors  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.major"
                        placeholder="Majors"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />

                    <!--Year  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.year"
                        placeholder="Year"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />
                    <!--Topic  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.topic"
                        placeholder="Topics"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />
                    <!--Advisor  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.advisor"
                        placeholder="Advisors"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />
                    <!--Committee  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.committee"
                        placeholder="Committee"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />
                    <!--Groups  dropdown -->
                    <CamboboxHeadless
                        v-model="filterForm.group_id"
                        placeholder="Groups "
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />
                    <!-- Academic Year -->
                    <CamboboxHeadless
                        v-model="filterForm.academic_year"
                        placeholder="Academic Year"
                        class="w-full h-10 font-bold border bg-base-100 border-primary"
                    />

                    <!-- Reset button -->
                    <button
                        type="button"
                        @click="onClearFilter"
                        class="w-full h-10 btn btn-warning btn-sm md:w-auto"
                    >
                        Reset
                    </button>
                </div>
            </div>
            <div class="mt-2 overflow-hidden border bg-base-100 rounded-xl">
                <div class="overflow-x-auto whitespace-nowrap">
                    <table class="w-full base-table2">
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
                            <tr>
                                <td>1</td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    General Medicien
                                </td>
                                <td>VIII</td>
                                <td>
                                    ការយល់ដឹងរបស់អាណាព្យាបាលអំពីជម្ងឺផ្តាសាយលើកុមារអាយុចាប់ពី​​
                                    ...
                                </td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    Doch Munibuth,
                                </td>
                                <td
                                    class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                >
                                    Sitha Solineath,<br />
                                    Sum Sreysuon, Chou Lida
                                </td>
                                <td>
                                    <div
                                        class="flex items-center justify-center gap-1"
                                    >
                                        <button class="btn btn-primary btn-sm">
                                            <EyeIcon class="w-4 h-4" />
                                        </button>
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
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
        <div role="tablist" class="p-2 bg-base-100 tabs tabs-lifted">
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="mr-2 font-bold tab cursor-none"
                aria-label="General Thesis Informations"
            />

            <div
                role="tabpanel"
                class="p-6 overflow-x-auto tab-content border-base-300 rounded-box"
            >
                <div class="flex-1 p-2 overflow-auto bg-base-100">
                    <!-- Input Thesis more Detail -->
                    <div class="space-y-1">
                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex flex-col w-full">
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

                            <div class="flex flex-col w-full">
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

                            <div class="flex flex-col w-full">
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
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex flex-col w-full">
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
                            <div class="flex flex-col w-full">
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
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex flex-col w-full">
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

                            <div class="flex flex-col w-full">
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
                        class="flex flex-col p-2 mt-4 mb-4 border-2 border-solid rounded-lg lg:flex-col"
                    >
                        <h2 class="text-lg font-bold">Organization</h2>

                        <div
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex flex-col w-full">
                                <label class="label"
                                    >Name <span class="text-error">*</span>
                                </label>
                                <input
                                    v-model="formThesis.organization"
                                    class="w-full input input-primary"
                                    placeholder="Organization Name"
                                />
                            </div>
                            <div class="flex flex-col w-full">
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
                            <div class="flex flex-col w-full">
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
                            class="flex flex-col items-center gap-2 lg:flex-row"
                        >
                            <div class="flex flex-col w-full">
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
                            <div class="flex flex-col w-full">
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
                            class="mt-2 overflow-x-auto border border-base-200 rounded-xl bg-base-100"
                        > -->
                        <div
                            class="mt-2 overflow-hidden border bg-base-100 rounded-xl"
                        >
                            <div class="overflow-x-auto whitespace-nowrap">
                                <table
                                    class="flex-col w-full overflow-x-auto base-table2 fle"
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
                    <div class="flex flex-col items-center gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
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
                        <div class="flex flex-col w-full">
                            <label class="label"
                                >Gender<span class="text-error">*</span></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full">
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
                    <div class="flex flex-col items-center gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
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
                        <div class="flex flex-col w-full">
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
                    <div class="flex flex-col items-center gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
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
                        <div class="flex flex-col w-full">
                            <label class="label"
                                >Gender<span class="text-error">*</span></label
                            >
                            <select class="w-full select select-primary">
                                <option value="">Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full">
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
                    <div class="flex flex-col items-center gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
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
                        <div class="flex flex-col w-full">
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

    <!-- Advisor -->
    <ModalBreeze
        :show="showModalAdvisor"
        :is-no-padding="true"
        max-width="7xl"
        @close="onCloseModalAdvisor"
    >
        <div class="overflow-hidden shadow-xl bg-base-100 rounded-2xl">
            <div class="flex items-center justify-between gap-2"></div>

            <div
                class="max-h-[calc(100vh-150px)] overflow-auto bg-base-100 p-2"
            >
                <h2
                    class="text-2xl font-bold text-center text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                >
                    Advisor(s) List View
                </h2>
                <!-- <div class="flex items-center gap-2"></div> -->

                <div
                    class="flex flex-col items-center justify-between gap-3 p-2 mt-2 sm:flex-row bg-base-100 rounded-xl"
                >
                    <form
                        @submit.prevent="onAddAdvisor"
                        class="w-full sm:w-auto"
                    >
                        <div class="flex flex-col gap-2 sm:flex-row sm:gap-3">
                            <button class="w-full btn btn-success sm:w-auto">
                                <CloudArrowDownIcon class="w-4 h-4" />Export
                            </button>
                            <button
                                class="w-full text-white btn btn-error sm:w-auto"
                            >
                                <PrinterIcon class="w-4 h-4" />Advisors
                                Reported...
                            </button>
                        </div>
                    </form>
                    <div
                        class="flex flex-col w-full gap-3 mt-2 overflow-x-auto sm:flex-row sm:w-auto sm:mt-0"
                    >
                        <!-- Input field -->
                        <input
                            type="text"
                            class="w-full h-10 mb-2 input input-primary input-sm sm:mb-0"
                            placeholder="Advisors Name..."
                        />

                        <!-- Lectures dropdown -->
                        <CamboboxHeadless
                            placeholder="Lectures"
                            class="w-full h-10 mb-2 border bg-base-100 border-primary sm:mb-0"
                        />

                        <!-- Topic dropdown -->
                        <CamboboxHeadless
                            placeholder="Topics"
                            class="w-full h-10 border bg-base-100 border-primary"
                        />
                    </div>
                </div>

                <div class="p-2 mt-1 bg-base-200 rounded-xl">
                    <h4 class="text-lg text-center">
                        Advisor(s) Recently Added
                    </h4>
                    <div
                        class="mt-2 overflow-hidden border bg-base-100 rounded-xl"
                    >
                        <div class="overflow-x-auto whitespace-nowrap">
                            <table
                                class="flex-col w-full overflow-x-auto base-table2 fle"
                            >
                                <!-- <div
                        class="max-h-[calc(100vh-550px)] overflow-auto border-base-200 border rounded-xl mt-2 bg-base-100"
                    > -->
                                <!-- <table class="w-full base-table2"> -->
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Advisor Name</th>
                                        <th>sex</th>
                                        <th>Role</th>
                                        <th>Topics</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-center">
                                    <tr>
                                        <td>1</td>
                                        <td
                                            class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                        >
                                            Doch Munibuth
                                        </td>
                                        <td>Male</td>
                                        <td>Department</td>

                                        <td>
                                            ការយល់ដឹងរបស់អាណាព្យាបាលអំពី ...
                                        </td>
                                        <td
                                            class="font-bold text-blue-900 dark:bg-gray-800 dark:text-blue-300"
                                        >
                                            Username@gmail.com
                                        </td>
                                        <td>012 345 678</td>
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
                                                <PenBoxIcon class="w-4 h-4" />
                                            </button>
                                            <button
                                                type="button"
                                                class="ml-1 btn btn-error btn-square btn-sm"
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
            </div>
        </div>
    </ModalBreeze>
</template>
<style></style>
