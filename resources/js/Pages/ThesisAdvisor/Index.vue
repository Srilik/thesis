<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { router, useForm } from "@inertiajs/vue3";
import { pick, pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import axios from "axios";

const props = defineProps<{
    thesisAdvisor?: ThesisAdvisorType;
    thesisAdvisors: PaginateType<ThesisAdvisorType>;
    academic_options?: string[];
    advisor_options?: string[];
    department_options?: string[];
    filters?: {
        academic_year?: string | null;
        advisor?: string | null;
        department?: string | null;
    };
}>();

const form = useForm({
    id: null,
    Academic_Year: "",
    Advisor: "",
    College: "",
    Department: "",
});

const onOpenModal = ref(false);

const onSave = () => {
    form.post(route("thesisAdvisor.store", form.id ?? "update"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisAdvisor has been saved.",
                timer: 1500,
                position: "top-end",
                toast: true,
            });
            onOpenModal.value = false;
            form.reset();
            form.clearErrors();
        },
    });
};

const filterForm = useForm({
    academic_year: props.filters?.academic_year ?? "",
    advisor: props.filters?.advisor ?? "",
    department: props.filters?.department ?? "",
});

watch(
    () => filterForm.data(),
    throttle(() => {
        router.get(route("thesisAdvisor.index"), pickBy(filterForm.data()), {
            preserveState: true,
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.reset();
};

const onDelete = (id: number) => {
    Swal.fire({
        title: "Do you want to delete?",
        icon: "warning",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("thesisAdvisor.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "The Advisor has been deleted.",
                        showConfirmButton: false,
                        toast: true,
                        timer: 1000,
                        position: "top-end",
                    });
                },
            });
        }
    });
};
const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesisAdvisor.edit", id));
    form.id = data.id;
    form.Academic_Year = data.Academic_Year;
    form.Advisor = data.Advisor;
    form.College = data.College;
    form.Department = data.Department;
    onOpenModal.value = true;
};

const oncloseModal = () => {
    if (form.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to close this form?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                onOpenModal.value = false;
                form.reset();
                form.clearErrors();
            }
        });
    } else {
        onOpenModal.value = false;
        form.reset();
        form.clearErrors();
    }
};
</script>

<template>
    <Modal :show="onOpenModal" maxWidth="2xl" @close="oncloseModal">
        <div class="p-3 bg-base-200 rounded-xl">
            <div class="mt-2 text-center">
                <h2 class="text-2xl font-bold">
                    {{
                        form.id
                            ? "Thesis Advisor Update"
                            : "Thesis Advisor Create"
                    }}
                </h2>
            </div>
            <div class="p-4 rounded-xl">
                <form @submit.prevent="onSave">
                    <div class="flex flex-col w-full">
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">Academic year</label>
                                <!-- <input
                                    type="text"
                                    v-model="form.Academic_Year"
                                    class="w-full input input-primary"
                                    :class="{
                                        'input-error':
                                            form.errors.Academic_Year,
                                    }"
                                /> -->
                                <select
                                    v-model="form.Academic_Year"
                                    class="w-full input input-primary"
                                >
                                    <option value="">
                                        Select a Academic Year
                                    </option>
                                    <option value="2000-2001">2000-2001</option>
                                    <option value="2001-2002">2001-2002</option>
                                    <option value="2002-2003">2002-2003</option>
                                    <option value="2003-2004">2003-2004</option>
                                    <option value="2004-2005">2004-2005</option>
                                    <option value="2005-2006">2005-2006</option>
                                    <option value="2006-2007">2006-2007</option>
                                    <option value="2007-2008">2007-2008</option>
                                    <option value="2008-2009">2008-2009</option>
                                    <option value="2009-2010">2009-2010</option>
                                    <option value="2010-2011">2010-2011</option>
                                    <option value="2011-2012">2011-2012</option>
                                    <option value="2012-2013">2012-2013</option>
                                    <option value="2013-2014">2013-2014</option>
                                    <option value="2014-2015">2014-2015</option>
                                    <option value="2015-2016">2015-2016</option>
                                    <option value="2016-2017">2016-2017</option>
                                    <option value="2017-2018">2017-2018</option>
                                    <option value="2018-2019">2018-2019</option>
                                    <option value="2019-2020">2019-2020</option>
                                    <option value="2020-2021">2020-2021</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2025-2026">2025-2026</option>
                                    <option value="2026-2027">2026-2027</option>
                                </select>
                                <div
                                    v-if="form.errors.Academic_Year"
                                    class="text-error"
                                >
                                    {{ form.errors.Academic_Year }}
                                </div>
                            </div>

                            <div class="flex flex-col w-full">
                                <label class="label">Advisor</label>
                                <input
                                    type="text"
                                    v-model="form.Advisor"
                                    class="w-full input input-primary"
                                    :class="{
                                        'input-error': form.errors.Advisor,
                                    }"
                                />

                                <div
                                    v-if="form.errors.Advisor"
                                    class="text-error"
                                >
                                    {{ form.errors.Advisor }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">College</label>
                                <!-- <input
                                    type="text"
                                    v-model="form.College"
                                    class="w-full input input-primary"
                                    :class="{
                                        'input-error': form.errors.College,
                                    }"
                                /> -->
                                <select
                                    v-model="form.College"
                                    class="w-full input input-primary"
                                >
                                    <option value="">Select a College</option>
                                    <option value="sciences">Sciences</option>
                                    <option value="social sciences">
                                        Social Sciences
                                    </option>
                                </select>
                                <div
                                    v-if="form.errors.College"
                                    class="text-error"
                                >
                                    {{ form.errors.College }}
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <label class="label">Department</label>
                                <!-- <input
                                    type="text"
                                    v-model="form.Department"
                                    class="w-full input input-primary"
                                    :class="{
                                        'input-error': form.errors.Department,
                                    }"
                                /> -->
                                <select
                                    v-model="form.Department"
                                    class="w-full input input-primary"
                                >
                                    <option value="">
                                        Select a Department
                                    </option>
                                    <option value="Architecture and Urbanism">
                                        Architecture and Urbanism
                                    </option>
                                    <option value="Civil Engineering">
                                        Civil Engineering
                                    </option>
                                    <option value="Computer Studies">
                                        Computer Studies
                                    </option>
                                    <option
                                        value="Department of Research and Develop"
                                    >
                                        Department of Research and Develop
                                    </option>
                                    <option
                                        value="Electrical and Electronics Engineering"
                                    >
                                        Electrical and Electronics Engineering
                                    </option>
                                </select>
                                <div
                                    v-if="form.errors.Department"
                                    class="text-error"
                                >
                                    {{ form.errors.Department }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-3">
                        <button
                            type="button"
                            class="btn btn-warning"
                            @click="oncloseModal"
                        >
                            <i class="fa-solid fa-xmark"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-regular fa-floppy-disk"></i>
                            {{ form.id ? "Update" : "Save" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
    <App>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisAdvisor Management</h2>
                <div class="flex gap-2 px-2 pb-2 mt-2 bg-base-100 rounded-xl">
                    <!-- <div class="mt-auto"> -->
                    <button
                        class="align-bottom btn btn-primary mt-9"
                        @click="onOpenModal = true"
                    >
                        <i class="fa-solid fa-plus"></i>

                        New
                    </button>
                    <!-- </div> -->

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Academic Year</label>
                        <select
                            v-model="filterForm.academic_year"
                            class="w-full select select-info"
                        >
                            <option value="">All Years</option>
                            <option
                                v-for="years in academic_options"
                                :value="years"
                            >
                                {{ years }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Advisor Name</label>
                        <select
                            v-model="filterForm.advisor"
                            class="w-full select select-info"
                        >
                            <option value="">All Advisors</option>
                            <option
                                v-for="advisors in advisor_options"
                                :value="advisors"
                            >
                                {{ advisors }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Department</label>
                        <select
                            v-model="filterForm.department"
                            class="w-full select select-info"
                        >
                            <option value="">All Departments</option>
                            <option
                                v-for="departments in department_options"
                                :value="departments"
                            >
                                {{ departments }}
                            </option>
                        </select>
                    </div>

                    <!-- <div class="mt-auto"> -->
                    <button
                        class="btn btn-warning mt-9"
                        type="button"
                        @click="onClearFilter"
                    >
                        <i class="fa-solid fa-eraser"></i>
                        Clear
                    </button>
                    <!-- </div> -->
                </div>
            </div>
            <div class="overflow-x-auto bg-base-100 rounded-xl">
                <table class="table">
                    <thead>
                        <tr class="text-sm uppercase text">
                            <th>Id</th>
                            <th>Academic</th>
                            <th>Advisor</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="thesisAdvisors && thesisAdvisors.data">
                        <tr
                            v-for="(item, index) in thesisAdvisors.data"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Advisor }}</td>
                            <td>{{ item.College }}</td>
                            <td>{{ item.Department }}</td>
                            <td>
                                <button
                                    type="button"
                                    @click="onEdit(item.id)"
                                    class="mr-2 btn btn-warning"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    @click="onDelete(item.id)"
                                    class="btn btn-error"
                                >
                                    <i class="fa-solid fa-trash-plus"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center p-2 mt-2 bg-base-100 rounded-xl">
                <div class="join">
                    <Link
                        v-for="link in thesisAdvisors.links"
                        :href="link.url ?? '#'"
                        class="join-item btn"
                        :class="{ 'btn-info': link.active }"
                    >
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
