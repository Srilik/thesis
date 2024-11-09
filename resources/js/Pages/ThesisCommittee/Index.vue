<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteeType } from "@/types/thesisCommittee";
import { router, useForm } from "@inertiajs/vue3";
import { pick, pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import axios from "axios";

const props = defineProps<{
    thesisCommittee?: ThesisCommitteeType;
    thesisCommittees: PaginateType<ThesisCommitteeType>;

    academic_options?: string[];
    major_options?: string[];
    // committee_options?: string[];
    department_options?: string[];
    subject_options?: string[];

    filters?: {
        academic_year?: string | null;
        major?: string | null;
        // committee?: string | null;
        department?: string | null;
        subject?: string | null;
    };
}>();

const form = useForm({
    id: null,
    Academic_Year: "",
    Major: "",
    Committee: "",
    Department: "",
    Subject: "",
});

const onOpenModal = ref(false);

const onSave = () => {
    form.post(route("thesisCommittee.store", form.id ?? "update"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisCommittee has been saved.",
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
<<<<<<< HEAD
    academic_year: props.filters?.academic_Year ?? "",
=======
    academic_year: props.filters?.academic_year ?? "",
>>>>>>> main
    major: props.filters?.major ?? "",
    // committee: props.filters?.Committee ?? "",
    department: props.filters?.department ?? "",
    subject: props.filters?.subject ?? "",
});

watch(
    () => filterForm.data(),
    throttle(() => {
        router.get(route("thesisCommittee.index"), pickBy(filterForm.data()), {
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
            router.delete(route("thesisCommittee.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "The Committee has been deleted.",
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
    const { data } = await axios.get(route("thesisCommittee.edit", id));
    form.id = data.id;
    form.Academic_Year = data.Academic_Year;
    form.Major = data.Major;
    form.Committee = data.Committee;
    form.Department = data.Department;
    form.Subject = data.Subject;
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
<<<<<<< HEAD
            denyButtonText: No,
=======
            denyButtonText: "No",
>>>>>>> main
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
<<<<<<< HEAD
            <div class="text-center mt-2">
=======
            <div class="mt-2 text-center">
>>>>>>> main
                <h2 class="text-2xl font-bold">
                    {{
                        form.id
                            ? "Thesis Committee Update"
                            : "Thesis Committee Create"
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
<<<<<<< HEAD
                                    class="input input-primary w-full"
=======
                                    class="w-full input input-primary"
>>>>>>> main
                                    :class="{
                                        'input-error':
                                            form.errors.Academic_Year,
                                    }"
                                /> -->
<<<<<<< HEAD
                                <select v-model="form.Academic_Year" class="input input-primary w-full">
                                    <option value="">Select a Academic Year</option>
=======
                                <select
                                    v-model="form.Academic_Year"
                                    class="w-full input input-primary"
                                >
                                    <option value="">
                                        Select a Academic Year
                                    </option>
>>>>>>> main
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
<<<<<<< HEAD
                                <div v-if="form.errors.Academic_Year" class="text-error">
=======
                                <div
                                    v-if="form.errors.Academic_Year"
                                    class="text-error"
                                >
>>>>>>> main
                                    {{ form.errors.Academic_Year }}
                                </div>
                            </div>

                            <div class="flex flex-col w-full">
                                <label class="label">Major</label>
<<<<<<< HEAD
                                <!-- <input type="text" v-model="form.Major" class="input input-primary w-full" :class="{
                                    'input-error': form.errors.Major,
                                }" /> -->
                                <select v-model="form.Major" class="input input-primary w-full">
                                    <option value="">Select a Major</option>
                                    <!-- ARCHITECTURE -->
                                    <option value="Architectural Design">Architectural Design</option>
                                    <option value="Architecture and Urbanism">Architecture and Urbanism</option>
                                    <option value="Interior Design  ">Interior Design  </option>  
                                    <option value="Landscape Design  ">Landscape Design  </option>
                                    <option value="Urban Planning">Urban Planning</option>
                                    <!-- BUSINESS -->
                                    <option value="Accounting ">Accounting </option> 
                                    <option value="Auditing">Auditing</option>
                                    <option value="Human Resource Management">Human Resource Management</option>
                                    <option value="Management">Management</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Taxation">Taxation</option>
                                    <!-- CIVIL -->
                                    <option value="Bridge Design and Construction">Bridge Design and Construction</option> 
                                    <option value="Building Design and Construction">Building Design and Construction</option>  
                                    <option value="Civil Engineering">Civil Engineering</option>  
                                    <option value="Hydraulic Construction">Hydraulic Construction</option>  
                                    <option value="Road Design and Construction">Road Design and Construction</option>
                                    <!-- COMPUTER -->
                                    <option value="Computer Science">Computer Science  </option> 
                                    <option value="Creative Multimedia">Creative Multimedia  </option>  
                                    <option value="Design">Design</option>
                                    <option value="E-Commerce">E-Commerce</option>
                                    <option value="Information and Communication Technology Management">Information and Communication Technology Management</option>
                                    <option value="Network Engineering and Security">Network Engineering and Security</option>
                                    <option value="Software Development">Software Development      </option>    
                                    <!-- ECONOMIC -->
                                    <option value="Banking and Finance  ">Banking and Finance  </option>
                                    <option value="Commercial Property and Real Estate">Commercial Property and Real Estate</option>
                                    <option value="Development Economics  ">Development Economics  </option>
                                    <option value="Investment and Risk Management">Investment and Risk Management</option>
                                    <!-- ELECTRICAL -->
                                    <option value="Automation and Control System">Automation and Control System</option>
                                    <option value="Electricity ">Electricity </option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Telecommunication ">Telecommunication </option>
                                    <!-- ENGLISH -->
                                    <option value="Business English">Business English</option>
                                    <option value="Educational Management and Teaching">Educational Management and Teaching</option>
                                    <option value="English Communication">English Communication</option>
                                    <option value="English for Business Affairs">English for Business Affairs</option>
                                    <option value="English for International Relations">English for International Relations</option>
                                    <option value="English for International Relations and Diplomacy">English for International Relations and Diplomacy</option>
                                    <option value="English Translation ">English Translation </option>
                                    <!-- HOTEL -->
                                    <option value="Hospitality and Tourism Management">Hospitality and Tourism Management</option> 
                                    <!-- LAW -->
                                    <option value="Commercial Law">Commercial Law</option>
                                    <option value="Government and Public Administration ">Government and Public Administration </option>
                                    <option value="International Relation and Diplomacy">International Relation and Diplomacy</option>
                                    <option value="Legal and Justice Studies">Legal and Justice Studies</option>
                                </select>

                                <div v-if="form.errors.Major" class="text-error">
=======
                                <!-- <input type="text" v-model="form.Major" class="w-full input input-primary" :class="{
                                    'input-error': form.errors.Major,
                                }" /> -->
                                <select
                                    v-model="form.Major"
                                    class="w-full input input-primary"
                                >
                                    <option value="">Select a Major</option>
                                    <!-- ARCHITECTURE -->
                                    <option value="Architectural Design">
                                        Architectural Design
                                    </option>
                                    <option value="Architecture and Urbanism">
                                        Architecture and Urbanism
                                    </option>
                                    <option value="Interior Design  ">
                                        Interior Design
                                    </option>
                                    <option value="Landscape Design  ">
                                        Landscape Design
                                    </option>
                                    <option value="Urban Planning">
                                        Urban Planning
                                    </option>
                                    <!-- BUSINESS -->
                                    <option value="Accounting ">
                                        Accounting
                                    </option>
                                    <option value="Auditing">Auditing</option>
                                    <option value="Human Resource Management">
                                        Human Resource Management
                                    </option>
                                    <option value="Management">
                                        Management
                                    </option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Taxation">Taxation</option>
                                    <!-- CIVIL -->
                                    <option
                                        value="Bridge Design and Construction"
                                    >
                                        Bridge Design and Construction
                                    </option>
                                    <option
                                        value="Building Design and Construction"
                                    >
                                        Building Design and Construction
                                    </option>
                                    <option value="Civil Engineering">
                                        Civil Engineering
                                    </option>
                                    <option value="Hydraulic Construction">
                                        Hydraulic Construction
                                    </option>
                                    <option
                                        value="Road Design and Construction"
                                    >
                                        Road Design and Construction
                                    </option>
                                    <!-- COMPUTER -->
                                    <option value="Computer Science">
                                        Computer Science
                                    </option>
                                    <option value="Creative Multimedia">
                                        Creative Multimedia
                                    </option>
                                    <option value="Design">Design</option>
                                    <option value="E-Commerce">
                                        E-Commerce
                                    </option>
                                    <option
                                        value="Information and Communication Technology Management"
                                    >
                                        Information and Communication Technology
                                        Management
                                    </option>
                                    <option
                                        value="Network Engineering and Security"
                                    >
                                        Network Engineering and Security
                                    </option>
                                    <option value="Software Development">
                                        Software Development
                                    </option>
                                    <!-- ECONOMIC -->
                                    <option value="Banking and Finance  ">
                                        Banking and Finance
                                    </option>
                                    <option
                                        value="Commercial Property and Real Estate"
                                    >
                                        Commercial Property and Real Estate
                                    </option>
                                    <option value="Development Economics  ">
                                        Development Economics
                                    </option>
                                    <option
                                        value="Investment and Risk Management"
                                    >
                                        Investment and Risk Management
                                    </option>
                                    <!-- ELECTRICAL -->
                                    <option
                                        value="Automation and Control System"
                                    >
                                        Automation and Control System
                                    </option>
                                    <option value="Electricity ">
                                        Electricity
                                    </option>
                                    <option value="Electronics">
                                        Electronics
                                    </option>
                                    <option value="Telecommunication ">
                                        Telecommunication
                                    </option>
                                    <!-- ENGLISH -->
                                    <option value="Business English">
                                        Business English
                                    </option>
                                    <option
                                        value="Educational Management and Teaching"
                                    >
                                        Educational Management and Teaching
                                    </option>
                                    <option value="English Communication">
                                        English Communication
                                    </option>
                                    <option
                                        value="English for Business Affairs"
                                    >
                                        English for Business Affairs
                                    </option>
                                    <option
                                        value="English for International Relations"
                                    >
                                        English for International Relations
                                    </option>
                                    <option
                                        value="English for International Relations and Diplomacy"
                                    >
                                        English for International Relations and
                                        Diplomacy
                                    </option>
                                    <option value="English Translation ">
                                        English Translation
                                    </option>
                                    <!-- HOTEL -->
                                    <option
                                        value="Hospitality and Tourism Management"
                                    >
                                        Hospitality and Tourism Management
                                    </option>
                                    <!-- LAW -->
                                    <option value="Commercial Law">
                                        Commercial Law
                                    </option>
                                    <option
                                        value="Government and Public Administration "
                                    >
                                        Government and Public Administration
                                    </option>
                                    <option
                                        value="International Relation and Diplomacy"
                                    >
                                        International Relation and Diplomacy
                                    </option>
                                    <option value="Legal and Justice Studies">
                                        Legal and Justice Studies
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.Major"
                                    class="text-error"
                                >
>>>>>>> main
                                    {{ form.errors.Major }}
                                </div>
                            </div>

                            <div class="flex flex-col w-full">
                                <label class="label">Committee</label>
<<<<<<< HEAD
                                <input type="text" v-model="form.Committee" class="input input-primary w-full" :class="{
                                    'input-error': form.errors.Committee,
                                }" />

                                <div v-if="form.errors.Committee" class="text-error">
=======
                                <input
                                    type="text"
                                    v-model="form.Committee"
                                    class="w-full input input-primary"
                                    :class="{
                                        'input-error': form.errors.Committee,
                                    }"
                                />

                                <div
                                    v-if="form.errors.Committee"
                                    class="text-error"
                                >
>>>>>>> main
                                    {{ form.errors.Committee }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">Department</label>
                                <!-- <input
                                    type="text"
                                    v-model="form.Department"
<<<<<<< HEAD
                                    class="input input-primary w-full"
=======
                                    class="w-full input input-primary"
>>>>>>> main
                                    :class="{
                                        'input-error': form.errors.Department,
                                    }"
                                /> -->
<<<<<<< HEAD
                                <select v-model="form.Department" class="input input-primary w-full">
                                    <option value="">Select a Department</option>
                                    <option value="Architecture and Urbanism">Architecture and Urbanism</option>
                                    <option value="Business Administration">Business Administration</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Computer Studies">Computer Studies</option>
                                    <option value="Department of Research and Develop">Department of Research and Develop</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
                                    <option value="English">English</option>
                                    <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                                    <option value="Law">Law</option>
                                </select>
                                <div v-if="form.errors.Department" class="text-error">
=======
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
                                    <option value="Business Administration">
                                        Business Administration
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
                                    <option value="Economics">Economics</option>
                                    <option
                                        value="Electrical and Electronics Engineering"
                                    >
                                        Electrical and Electronics Engineering
                                    </option>
                                    <option value="English">English</option>
                                    <option value="Hospitality and Tourism">
                                        Hospitality and Tourism
                                    </option>
                                    <option value="Law">Law</option>
                                </select>
                                <div
                                    v-if="form.errors.Department"
                                    class="text-error"
                                >
>>>>>>> main
                                    {{ form.errors.Department }}
                                </div>
                            </div>

                            <div class="flex flex-col w-full">
                                <label class="label">Subject</label>
<<<<<<< HEAD
                                <!-- <input type="text" v-model="form.Subject" class="input input-primary w-full" :class="{
                                    'input-error': form.errors.Subject,
                                }" /> -->
                                <select v-model="form.Subject" class="input input-primary w-full">
                                    <option value="">Select a Subject</option>
                                    <option value="Introduction to Computer"> Introduction to Computer </option>
                                    <option value="Color and Sketching III"> Color and Sketching III </option>
                                    <option value="Computer Graphic Design (2D & 3D Design)"> Computer Graphic Design (2D & 3D Design) </option>
                                    <option value="Core English & Writing II"> Core English & Writing II </option>
                                    <option value="Engineering Drawing"> Engineering Drawing </option>
                                    <option value="Physics for Engineering I"> Physics for Engineering I </option>
                                    <option value="History of Khmer Architecture"> History of Khmer Architecture </option>
                                    <option value="Corporate Finance"> Corporate Finance </option>
                                    <option value="General Management"> General Management </option>
                                    <option value="Advertising and Sale Promotion"> Advertising and Sale Promotion </option>
                                    <option value="Pre-Stressed Concrete Design"> Pre-Stressed Concrete Design </option>
                                    <option value="Intercultural Communication"> Intercultural Communication </option>
                                    <option value="Applied Linguistics"> Applied Linguistics </option>
                                    <option value="Advanced Hotel Management"> Advanced Hotel Management </option>
                                    <option value="Administrative and Procedure Law"> Administrative and Procedure Law </option>
                                    <option value="Sustainable Design"> Sustainable Design </option>
                                    <option value="Managerial and Cost Accounting"> Managerial and Cost Accounting </option>
                                    <option value="Project Management"> Project Management </option>
                                    <option value="Basic Marketing"> Basic Marketing </option>
                                    <option value="Reinforced Concrete Design"> Reinforced Concrete Design </option>
                                    <option value="International Relations"> International Relations </option>
                                    <option value="Foundations of Education"> Foundations of Education </option>
                                    <option value="Tourism Policy and Public Planning"> Tourism Policy and Public Planning </option>
                                    <option value="Civil and Procedure Law"> Civil and Procedure Law </option>
                                    <option value="Urban Planning"> Urban Planning </option>
                                    <option value="Principles of Accounting"> Principles of Accounting </option>
                                    <option value="Strategic Management"> Strategic Management </option>
                                    <option value="Marketing Strategy"> Marketing Strategy </option>
                                    <option value="Structural Analysis"> Structural Analysis </option>
                                    <option value="Term Paper Writing"> Term Paper Writing </option>
                                    <option value="Teaching Methodology"> Teaching Methodology </option>
                                    <option value="Travel Agency Management"> Travel Agency Management </option>
                                    <option value="Criminal and Procedure Law"> Criminal and Procedure Law </option>
                                    <option value="Computer Network MS NOS Administration"> Computer Network MS NOS Administration </option>
                                    <option value="Digital Television Project"> Digital Television Project </option>
                                    <option value="Network Administrator (Microsoft)"> Network Administrator (Microsoft) </option>
                                    <option value="Data Structure and Algorithms in C/C++"> Data Structure and Algorithms in C/C++ </option>
                                    <option value="Accounting  for Bank"> Accounting  for Bank </option>
                                    <option value="Feedback Control System"> Feedback Control System </option>
                                    <option value="Introduction to Mass Communication"> Introduction to Mass Communication </option>
                                    <option value="Graphic Design Project"> Graphic Design Project </option>
                                    <option value="Network Administrator (Open Source)"> Network Administrator (Open Source) </option>
                                    <option value="Database Management System"> Database Management System </option>
                                    <option value="Network and Power Distribution"> Network and Power Distribution </option>
                                    <option value="Technical Writing"> Technical Writing </option>
                                    <option value="Short Film Project"> Short Film Project </option>
                                    <option value="Network Security (Cisco+IS)"> Network Security (Cisco+IS) </option>
                                    <option value="System Analysis and Design"> System Analysis and Design </option>
                                    <option value="Risk Management for Bank Activities"> Risk Management for Bank Activities </option>
                                    <option value="Telecommunication System"> Telecommunication System </option>
                                    <option value="Cultural Studies A1"> Cultural Studies A1 </option>
                                    <option value="Construction Technology"> Construction Technology </option>
                                    <option value="Conservation I"> Conservation I </option>
                                    <option value="Marketing Research"> Marketing Research </option>
                                    <option value="Database Management System with Oracle"> Database Management System with Oracle </option>
                                    <option value="3D Motion Graphic Design"> 3D Motion Graphic Design </option>
                                    <option value="Digital Electronics II"> Digital Electronics II </option>
                                    <option value="Diplomacy 1A"> Diplomacy 1A </option>
                                    <option value="Educational Management"> Educational Management </option>
                                    <option value="Restaurent and Bar management"> Restaurent and Bar management </option>
                                    <option value="Civil Procedure I"> Civil Procedure I </option>
                                    <option value="Construction Management & Analysis I"> Construction Management & Analysis I </option>
                                    <option value="Linux Enterprise Server Administrator"> Linux Enterprise Server Administrator </option>
                                    <option value="Advance Computer Network in Window Server"> Advance Computer Network in Window Server </option>
                                    <option value="Auditing"> Auditing </option>
                                    <option value="Grammar & Composition I"> Grammar & Composition I </option>
                                    <option value="Industrial Power Distribution & Energy Efficiency"> Industrial Power Distribution & Energy Efficiency </option>
                                    <option value="Grammar & Reading A1"> Grammar & Reading A1 </option>
                                    <option value="Color and Sketching V"> Color and Sketching V </option>
                                    <option value="Fluid Mechanics and Hydraulics Engineering I"> Fluid Mechanics and Hydraulics Engineering I </option>
                                    <option value="Professional Practice in Architecture I"> Professional Practice in Architecture I </option>
                                    <option value="Principles of Accounting I"> Principles of Accounting I </option>
                                    <option value="Dot NET Programming I"> Dot NET Programming I </option>
                                    <option value="Business Communication"> Business Communication </option>
                                    <option value="Civil Law I"> Civil Law I </option>
                                    <option value="Financial Statement Analysis"> Financial Statement Analysis </option>
                                    <option value="Java Programming"> Java Programming </option>
                                    <option value="Advanced Digital Television and Broadcasting"> Advanced Digital Television and Broadcasting </option>
                                    <option value="Environmental Economics"> Environmental Economics </option>
                                    <option value="Electrical Machines I"> Electrical Machines I </option>
                                    <option value="Law and Rule of Construction"> Law and Rule of Construction </option>
                                    <option value="Grammar & Reading B1"> Grammar & Reading B1 </option>
                                    <option value="Computer Graphic Design"> Computer Graphic Design </option>
                                    <option value="Scaling Networks"> Scaling Networks </option>
                                    <option value="Corporate Finance I"> Corporate Finance I </option>
                                    <option value="International Business"> International Business </option>
                                    <option value="Microprocessors II"> Microprocessors II </option>
                                    <option value="Reading & Writing"> Reading & Writing </option>
                                    <option value="Computer Graphic Design III (3D-Max)"> Computer Graphic Design III (3D-Max) </option>
                                    <option value="Principles of Marketing"> Principles of Marketing </option>
                                    <option value="Database Management System I"> Database Management System I </option>
                                    <option value="Computer (Network Engineering)"> Computer (Network Engineering) </option>
                                    <option value="Japanese"> Japanese </option>
                                    <option value="Constitutional Law-1"> Constitutional Law-1 </option>
                                    <option value="Macroeconomics"> Macroeconomics </option>
                                    <option value="Hydrology"> Hydrology </option>
                                    <option value="Macroeconomics II"> Macroeconomics II </option>
                                    <option value="Industrial Equipments"> Industrial Equipments </option>
                                    <option value="Inter-Cultural Communication"> Inter-Cultural Communication </option>
                                    <option value="Listening & Speaking B1"> Listening & Speaking B1 </option>
                                    <option value="Project Planning and Implementation"> Project Planning and Implementation </option>
                                    <option value="Reinforced Concrete Design I"> Reinforced Concrete Design I </option>
                                    <option value="Listening & Speaking A1"> Listening & Speaking A1 </option>
                                    <option value="IT Essential"> IT Essential </option>
                                    <option value="Adverting Graphic Design"> Adverting Graphic Design </option>
                                    <option value="Window Server Administrator"> Window Server Administrator </option>
                                    <option value="Java Programming II"> Java Programming II </option>
                                    <option value="Modulation"> Modulation </option>
                                    <option value="Linux Server Administrator"> Linux Server Administrator </option>
                                    <option value="Descriptive Geometry I"> Descriptive Geometry I </option>
                                    <option value="Auto CAD (2D)"> Auto CAD (2D) </option>
                                    <option value="Literature Studies A1"> Literature Studies A1 </option>
                                    <option value="History of Architecture I"> History of Architecture I </option>
                                    <option value="Urban Regulation"> Urban Regulation </option>
                                    <option value="Principles of Management"> Principles of Management </option>
                                    <option value="Digital Design"> Digital Design </option>
                                    <option value="Soft Skills I"> Soft Skills I </option>
                                    <option value="Computer Network"> Computer Network </option>
                                    <option value="Criminal Law I"> Criminal Law I </option>
                                    <option value="Operation Management"> Operation Management </option>
                                    <option value="Soil Mechanics and Foundations I"> Soil Mechanics and Foundations I </option>
                                    <option value="Networks-Server System"> Networks-Server System </option>
                                    <option value="Mathematics for Engineers II"> Mathematics for Engineers II </option>
                                    <option value="Literature Studies B1"> Literature Studies B1 </option>
                                    <option value="Criminal Procedure I"> Criminal Procedure I </option>
                                    <option value="Road Construction I"> Road Construction I </option>
                                    <option value="Cinema Marketing & Contents Business"> Cinema Marketing & Contents Business </option>
                                    <option value="Microsoft SQL Server II"> Microsoft SQL Server II </option>
                                    <option value="Monetary and Banking System"> Monetary and Banking System </option>
                                    <option value="Public Speaking I"> Public Speaking I </option>
                                    <option value="Network and Power Distribute I"> Network and Power Distribute I </option>
                                    <option value="Business Law"> Business Law </option>
                                    <option value="Chemistry for Engineering"> Chemistry for Engineering </option>
                                    <option value="Writing Skills A1"> Writing Skills A1 </option>
                                    <option value="Strength of Materials I"> Strength of Materials I </option>
                                    <option value="Information systems"> Information systems </option>
                                    <option value="Microeconomics II"> Microeconomics II </option>
                                    <option value="Electrical Circuit Analysis I"> Electrical Circuit Analysis I </option>
                                    <option value="Tourism Geography in Cambodia"> Tourism Geography in Cambodia </option>
                                    <option value="Land and​ Construction Law"> Land and​ Construction Law </option>
                                    <option value="Cost Accounting"> Cost Accounting </option>
                                    <option value="SPSS"> SPSS </option>
                                    <option value="Object-Oriented Methodology and Programming"> Object-Oriented Methodology and Programming </option>
                                    <option value="Sensors and Interfaces"> Sensors and Interfaces </option>
                                    <option value="Writing Skills B1"> Writing Skills B1 </option>
                                    <option value="Finance and Taxation Law"> Finance and Taxation Law </option>
                                    <option value="Sanitary Engineering Design"> Sanitary Engineering Design </option>
                                    <option value="Digital Television & Broadcasting I"> Digital Television & Broadcasting I </option>
                                    <option value="Land and Construction Law"> Land and Construction Law </option>
                                    <option value="Digital Film Directing & Making I"> Digital Film Directing & Making I </option>
                                    <option value="Power Electronics II"> Power Electronics II </option>
                                    <option value="Introduction of design (2D&3D)"> Introduction of design (2D&3D) </option>
                                    <option value="Introduction to Statistics"> Introduction to Statistics </option>
                                    <option value="Mathematics for Engineering III"> Mathematics for Engineering III </option>
                                    <option value="Structural Analysis I"> Structural Analysis I </option>
                                    <option value="Advanced Programming in C#"> Advanced Programming in C# </option>
                                    <option value="Mathematics for Engineers I"> Mathematics for Engineers I </option>
                                    <option value="Legal Terminology in English"> Legal Terminology in English </option>
                                    <option value="Taxation"> Taxation </option>
                                    <option value="Human Resource Management"> Human Resource Management </option>
                                    <option value="Statistic and Random Process"> Statistic and Random Process </option>
                                    <option value="Legal and Justice Policy"> Legal and Justice Policy </option>
                                    <option value="Steel Design"> Steel Design </option>
                                    <option value="Imaging for Narrative & Story Boards I"> Imaging for Narrative & Story Boards I </option>
                                    <option value="Power Plants"> Power Plants  </option>

                                    <option value="Architectural Design for Civil Engineering"> Architectural Design for Civil Engineering </option>
                                    <option value="C Programming"> C Programming </option>
                                    <option value="Khmer Culture"> Khmer Culture </option>
                                    <option value="Administrative Law  and Procedure"> Administrative Law  and Procedure </option>
                                    <option value="Anglong and Digital Filters"> Anglong and Digital Filters </option>
                                    <option value="Auto CAD Civil 3D"> Auto CAD Civil 3D </option>
                                    <option value="3D Animation Production I"> 3D Animation Production I </option>
                                    <option value="Human Resource Management in Hospitality"> Human Resource Management in Hospitality </option>
                                    <option value="Feed Back Control Systems I"> Feed Back Control Systems I </option>
                                    <option value="Analog Electronics II"> Analog Electronics II </option>
                                    <option value="Electromagnetic Theory II"> Electromagnetic Theory II </option>
                                    <option value="Computer Graphic Design II (2D & 3D-Design)"> Computer Graphic Design II (2D & 3D-Design) </option>
                                    <option value="Descriptive Geometry III"> Descriptive Geometry III </option>
                                    <option value="Khmer Arch (Design & Sculpture)"> Khmer Arch (Design & Sculpture) </option>
                                    <option value="Topographical Surveying for Architecture"> Topographical Surveying for Architecture </option>
                                    <option value="Business and Economics Statistics"> Business and Economics Statistics </option>
                                    <option value="Entrepreneurship"> Entrepreneurship </option>
                                    <option value="Financial Mathematics"> Financial Mathematics </option>
                                    <option value="Principles of Accounting II"> Principles of Accounting II </option>
                                    <option value="Concrete mix design"> Concrete mix design </option>
                                    <option value="Electricity in Building"> Electricity in Building </option>
                                    <option value="Engineering Geology"> Engineering Geology </option>
                                    <option value="Engineering Tool & Operation"> Engineering Tool & Operation </option>
                                    <option value="Physics for Engineering II"> Physics for Engineering II </option>
                                    <option value="Data Structure & Algorithm in C/C++"> Data Structure & Algorithm in C/C++ </option>
                                    <option value="Digital Electronic I"> Digital Electronic I </option>
                                    <option value="Cultural Studies 2"> Cultural Studies 2 </option>
                                    <option value="Labor Law"> Labor Law </option>
                                    <option value="Contract Law"> Contract Law </option>
                                    <option value="Constitutional Law II"> Constitutional Law II </option>
                                    <option value="Criminal Law II ( Special)"> Criminal Law II ( Special) </option>
                                    <option value="Civil Law II"> Civil Law II </option>
                                    <option value="Basic Engineering II (Str. and Rei. Concrete)"> Basic Engineering II (Str. and Rei. Concrete) </option>
                                    <option value="History of Architecture II"> History of Architecture II </option>
                                    <option value="Consumer Behavior"> Consumer Behavior </option>
                                    <option value="Engineering Surveying"> Engineering Surveying </option>
                                    <option value="Fluid Mechanics and Hydraulics Engineering II"> Fluid Mechanics and Hydraulics Engineering II </option>
                                    <option value="Soil Mechanics and Foundations II"> Soil Mechanics and Foundations II </option>
                                    <option value="Transportation and Planning"> Transportation and Planning </option>
                                    <option value="Electromagnetic Theory I"> Electromagnetic Theory I </option>
                                    <option value="Electrical System Design for Buildings"> Electrical System Design for Buildings </option>
                                    <option value="Diplomacy 1B"> Diplomacy 1B </option>
                                    <option value="Business Law I"> Business Law I </option>
                                    <option value="Landscape Design (Basic & Advances Landscape)"> Landscape Design (Basic & Advances Landscape) </option>
                                    <option value="Conservation II"> Conservation II </option>
                                    <option value="Project Planing and Implementations"> Project Planing and Implementations </option>
                                    <option value="Reinforces Concrete Design II"> Reinforces Concrete Design II </option>
                                    <option value="Color and Sketching IV"> Color and Sketching IV </option>
                                    <option value="Professional Practice in Architecture II"> Professional Practice in Architecture II </option>
                                    <option value="Management Practice"> Management Practice </option>
                                    <option value="Theory of Mechanics"> Theory of Mechanics </option>
                                    <option value="Digital Design (1st Sem)"> Digital Design (1st Sem) </option>
                                    <option value="Web Development and Programming I"> Web Development and Programming I </option>
                                    <option value="Digital Film Storytelling II"> Digital Film Storytelling II </option>
                                    <option value="Digital Television & Broadcasting II"> Digital Television & Broadcasting II </option>
                                    <option value="Matlab Application"> Matlab Application </option>
                                    <option value="Thermal Processes and Cooling Systems I"> Thermal Processes and Cooling Systems I </option>
                                    <option value="Listening and Speaking 2"> Listening and Speaking 2 </option>
                                    <option value="Literature Studies 2"> Literature Studies 2 </option>
                                    <option value="Writing Skills 2"> Writing Skills 2 </option>
                                    <option value="Leadership"> Leadership </option>
                                    <option value="Research Methods"> Research Methods </option>
                                    <option value="Services Marketing"> Services Marketing </option>
                                    <option value="Strength of Materials II"> Strength of Materials II </option>
                                    <option value="Linux Server Administrator II"> Linux Server Administrator II </option>
                                    <option value="Advance Digital Televition and Promoting"> Advance Digital Televition and Promoting </option>
                                    <option value="Connecting Networks"> Connecting Networks </option>
                                    <option value="Database System Oracle I"> Database System Oracle I </option>
                                    <option value="Banking Practice & Law"> Banking Practice & Law </option>
                                    <option value="Grammar and Composition II"> Grammar and Composition II </option>
                                    <option value="Literature Studies 3"> Literature Studies 3 </option>
                                    <option value="Grammar & Writing"> Grammar & Writing </option>
                                    <option value="Writing Skills 3"> Writing Skills 3 </option>
                                    <option value="Cost and Benefit Analysis in Hospitality"> Cost and Benefit Analysis in Hospitality </option>
                                    <option value="Justice and Human Rights"> Justice and Human Rights </option>
                                    <option value="Construction Management & Analysis II"> Construction Management & Analysis II </option>
                                    <option value="Earthen Dam Design & Slope protections"> Earthen Dam Design & Slope protections </option>
                                    <option value="GIS and remote sensing"> GIS and remote sensing </option>
                                    <option value="Road Construction II"> Road Construction II </option>
                                    <option value="Modeling and Controlling Power Electronics"> Modeling and Controlling Power Electronics </option>
                                    <option value="Network Transmission & Power Distribution II"> Network Transmission & Power Distribution II </option>
                                    <option value="Virtual Instrumentation"> Virtual Instrumentation </option>
                                    <option value="Grammar and Reading 2"> Grammar and Reading 2 </option>
                                    <option value="Power Electronics I"> Power Electronics I </option>
                                    <option value="Japanese IV"> Japanese IV </option>
                                    <option value="Wooden Design"> Wooden Design </option>
                                    <option value="Analog and Digital Filter II"> Analog and Digital Filter II </option>
                                    <option value="Civil Procedure II"> Civil Procedure II </option>
                                    <option value="Advanced Java Programming"> Advanced Java Programming </option>
                                    <option value="3D Motion Graphic Design II"> 3D Motion Graphic Design II </option>
                                    <option value="Feed Back Control Systems II"> Feed Back Control Systems II </option>
                                    <option value="Color and Sketching VI"> Color and Sketching VI </option>
                                    <option value="Routing & Switching Basic"> Routing & Switching Basic </option>
                                    <option value="Listening and Speaking 3"> Listening and Speaking 3 </option>
                                    <option value="3D Animation Production II"> 3D Animation Production II </option>
                                    <option value="Advance Digital Photography IV"> Advance Digital Photography IV </option>
                                    <option value="Linux Enterprise Server Network Service"> Linux Enterprise Server Network Service </option>
                                    <option value="IT Professional: Web App. II"> IT Professional: Web App. II </option>
                                    <option value="Electrical Machinces II"> Electrical Machinces II </option>
                                    <option value="Database Management Systems II"> Database Management Systems II </option>
                                    <option value="Server and Storage System"> Server and Storage System </option>
                                    <option value="Analog Electronic Circuits I"> Analog Electronic Circuits I </option>
                                    <option value="Intermediate Accounting"> Intermediate Accounting </option>
                                    <option value="Accounting for Bank"> Accounting for Bank </option>
                                    <option value="Advance Digital Photography II"> Advance Digital Photography II </option>
                                    <option value="MS Network Technology"> MS Network Technology </option>
                                    <option value="Microsoft Security"> Microsoft Security </option>
                                    <option value="Mobile Technology I"> Mobile Technology I </option>
                                    <option value="Evidence Law"> Evidence Law </option>
                                    <option value="Motor Drivers"> Motor Drivers </option>
                                    <option value="Soft Skills"> Soft Skills </option>
                                    <option value="Advanced Programming in C# II"> Advanced Programming in C# II </option>
                                    <option value="Food and Beverage Operations"> Food and Beverage Operations </option>
                                    <option value="Managerial Accounting"> Managerial Accounting </option>
                                    <option value="Total Quality Management"> Total Quality Management </option>
                                    <option value="Structural Analysis II"> Structural Analysis II </option>
                                    <option value="ASEAN Economics"> ASEAN Economics </option>
                                    <option value="Internation Relations"> Internation Relations </option>
                                    <option value="Data Communication"> Data Communication </option>
                                    <option value="Contents Planning & Storyboarding II"> Contents Planning & Storyboarding II </option>
                                    <option value="Principle of Accounting"> Principle of Accounting </option>
                                    <option value="Brand Identity Design"> Brand Identity Design </option>
                                    <option value="Software Engineering"> Software Engineering </option>
                                    <option value="Public Speaking 3"> Public Speaking 3 </option>
                                    <option value="Insurance Law"> Insurance Law </option>
                                    <option value="Dot Net Programming II"> Dot Net Programming II </option>
                                    <option value="Computer Network I"> Computer Network I </option>
                                    <option value="Electrical Circuit Analysis II"> Electrical Circuit Analysis II </option>
                                    <option value="Criminal Law II (Special)"> Criminal Law II (Special) </option>
                                    <option value="Profit Planning and Control"> Profit Planning and Control </option>
                                    <option value="International Finance"> International Finance </option>
                                    <option value="Corporate Finance II"> Corporate Finance II </option>
                                    <option value="Community Development"> Community Development </option>
                                    <option value="Microprocessors I"> Microprocessors I </option>
                                    <option value="Meeting Incentive Convention Exhibition Management"> Meeting Incentive Convention Exhibition Management </option>
                                    <option value="Optical Communication"> Optical Communication </option>
                                    <option value="Java Programming I"> Java Programming I </option>
                                    <option value="Macroeconomics I"> Macroeconomics I </option>
                                    <option value="Hotel Operation Management"> Hotel Operation Management </option>
                                    <option value="QuickBooks"> QuickBooks </option>
                                    <option value="Money and Capital Market"> Money and Capital Market </option>
                                    <option value="Research Methodology"> Research Methodology </option>
                                    <option value="Wireless Mobile Programming I"> Wireless Mobile Programming I </option>
                                    <option value="Digital Film Directing & Making II"> Digital Film Directing & Making II </option>
                                    <option value="WTO & ASEAN Legal System"> WTO & ASEAN Legal System </option>
                                    <option value="Telecommunication Systems I"> Telecommunication Systems I </option>
                                    <option value="Microsoft SQL Server I"> Microsoft SQL Server I </option>
                                    <option value="Japanese II"> Japanese II </option>
                                    <option value="Program Logic Control (PLC)"> Program Logic Control (PLC) </option>
                                    <option value="Strategic Management in Hospitality"> Strategic Management in Hospitality </option>
                                    <option value="Media Interaction Design"> Media Interaction Design </option>
                                    <option value="Renewable Energy"> Renewable Energy </option>
                                    <option value="Wave Propagation I"> Wave Propagation I </option>
                                    <option value="Signals and Systems"> Signals and Systems </option>
                                    <option value="Testing"> Testing </option>
                                    <option value="Corlor and Sketching"> Corlor and Sketching </option>
                                    <option value="Core English 2A"> Core English 2A </option>
                                    <option value="Core English 2B"> Core English 2B </option>
                                    <option value="Creation Concept"> Creation Concept </option>
                                    <option value="Digital Photography II"> Digital Photography II </option>
                                    <option value="Introduction to Politial Science"> Introduction to Politial Science </option>
                                    <option value="Introduction to State and Law"> Introduction to State and Law </option>
                                    <option value="Math for Bus and Eco"> Math for Bus and Eco </option>

                                    <option value="Math for Computer Science II"> Math for Computer Science II </option>
                                    <option value="Math for Engineering I"> Math for Engineering I </option>
                                    <option value="Math for Engineering II"> Math for Engineering II </option>
                                    <option value="Principle of Business"> Principle of Business </option>
                                    <option value="Programming in C/C++"> Programming in C/C++ </option>
                                    <option value="Foundamental of Architecture"> Foundamental of Architecture </option>
                                    <option value="Software Application"> Software Application </option>
                                    <option value="Mathematics for Engineering II"> Mathematics for Engineering II </option>
                                    <option value="Core English 1B"> Core English 1B </option>
                                    <option value="Programming Methodology in C++"> Programming Methodology in C++ </option>
                                    <option value="Introduction to Philosophy"> Introduction to Philosophy </option>
                                    <option value="Khmer Studies"> Khmer Studies </option>
                                    <option value="Mathematics for computer Science 2"> Mathematics for computer Science 2 </option>
                                    <option value="Microeconomics I"> Microeconomics I </option>
                                    <option value="Human & Society"> Human & Society </option>
                                    <option value="Introduction to Political Science"> Introduction to Political Science </option>
                                    <option value="Principle of Economics"> Principle of Economics </option>
                                    <option value="Introduction to Tourism"> Introduction to Tourism </option>
                                    <option value="Fundamental of Physics"> Fundamental of Physics </option>
                                    <option value="Principles of Statistics"> Principles of Statistics </option>
                                    <option value="English 1A"> English 1A </option>
                                    <option value="Color and Sketching"> Color and Sketching </option>
                                    <option value="Principles of Business"> Principles of Business </option>
                                    <option value="Applied Mathematics for Bus and Eco"> Applied Mathematics for Bus and Eco </option>
                                    <option value="Electricity and Electronics"> Electricity and Electronics </option>
                                    <option value="English 2A"> English 2A </option>
                                    <option value="Principles of Economics"> Principles of Economics </option>
                                    <option value="Mathematic for Engineering I"> Mathematic for Engineering I </option>
                                    <option value="Mathematics for Computer Science I"> Mathematics for Computer Science I </option>
                                    <option value="Psychology"> Psychology </option>
                                    <option value="Digital Photography I"> Digital Photography I </option>
                                    <option value="Introduction to Multimedai"> Introduction to Multimedai </option>
                                    <option value="test"> test </option>
                                    <option value="Descriptive Geometry "> Descriptive Geometry  </option>
                                    <option value="Introduction  to Statistics"> Introduction  to Statistics </option>
                                    <option value="Fluid Mechanics and Hydraulics Engineering"> Fluid Mechanics and Hydraulics Engineering </option>
                                    <option value="Sewage and Water System"> Sewage and Water System </option>
                                    <option value="Program Robot"> Program Robot </option>
                                    <option value="Public Finance"> Public Finance </option>
                                    <option value="Business Plan for Tourism"> Business Plan for Tourism </option>
                                    <option value="Investment Management"> Investment Management </option>
                                    <option value="Managing Team"> Managing Team </option>
                                    <option value="Money and Capital Markets"> Money and Capital Markets </option>
                                    <option value="Business to Business Marketing"> Business to Business Marketing </option>
                                    <option value="Advertising and Sales Promotion"> Advertising and Sales Promotion </option>
                                    <option value="Bridge Ccnstruction"> Bridge Ccnstruction </option>
                                    <option value="Bank Management"> Bank Management </option>
                                    <option value="Optimization of Power System"> Optimization of Power System </option>
                                    <option value="Technical Writing I"> Technical Writing I </option>
                                    <option value="International Public Law"> International Public Law </option>
                                    <option value="Resort Management"> Resort Management </option>
                                    <option value="Tourism Policy and Public Planing"> Tourism Policy and Public Planing </option>
                                    <option value="Criminalistics"> Criminalistics </option>
                                    <option value="Private International Law"> Private International Law </option>
                                    <option value="Bridge Construction"> Bridge Construction </option>
                                    <option value="Organizational Development"> Organizational Development </option>
                                    <option value="Credit Management"> Credit Management </option>
                                    <option value="Applied Linguistics I"> Applied Linguistics I </option>
                                    <option value="Inormation Security(IS)"> Inormation Security(IS) </option>
                                    <option value="3D Visual Effect"> 3D Visual Effect </option>
                                    <option value="Information Security"> Information Security </option>
                                    <option value="Intercultural Business Communication"> Intercultural Business Communication </option>
                                    <option value="Diplomacy in the Age of Globalization"> Diplomacy in the Age of Globalization </option>
                                    <option value="Analysis of Cambodian Economics"> Analysis of Cambodian Economics </option>
                                    <option value="Foundations of Education I"> Foundations of Education I </option>
                                    <option value="Wireless Mobile Programming II"> Wireless Mobile Programming II </option>
                                    <option value="Advanced Media Art Project"> Advanced Media Art Project </option>
                                    <option value="CCNA Security"> CCNA Security </option>
                                    <option value="Mobile Technology II"> Mobile Technology II </option>
                                    <option value="Electrical Standard for Builing in Cambodia"> Electrical Standard for Builing in Cambodia </option>
                                    <option value="International Business 2A"> International Business 2A </option>
                                    <option value="Inter.Cultural"> Inter.Cultural </option>
                                    <option value="Enterpreneurship"> Enterpreneurship </option>
                                    <option value="Juvenile Criminal Justice System in Cambodia"> Juvenile Criminal Justice System in Cambodia </option>
                                    <option value="Forecasting Analysis"> Forecasting Analysis </option>
                                    <option value="Teaching Methodology I"> Teaching Methodology I </option>
                                    <option value="Advanced Accounting"> Advanced Accounting </option>
                                    <option value="Digital Image Processing"> Digital Image Processing </option>
                                    <option value="Integrative Creative Design"> Integrative Creative Design </option>
                                    <option value="Linux Enterprise Sever Security"> Linux Enterprise Sever Security </option>
                                    <option value="English for IT"> English for IT </option>
                                    <option value="Electromagnetic Compatibility"> Electromagnetic Compatibility </option>
                                    <option value="Introduction to Mass Communication I"> Introduction to Mass Communication I </option>
                                    <option value="Internation Relation"> Internation Relation </option>
                                    <option value="Introduction to Financial Analysis and Risk Mgt"> Introduction to Financial Analysis and Risk Mgt </option>
                                    <option value="Personal Selling"> Personal Selling </option>
                                    <option value="E-Commerce Technologies"> E-Commerce Technologies </option>
                                    <option value="Practical Works for Digital Film"> Practical Works for Digital Film </option>
                                    <option value="Customer Relationship Management"> Customer Relationship Management </option>
                                    <option value="Engineering Management & Project Planning"> Engineering Management & Project Planning </option>
                                    <option value="GIS Systems and Remote Sensing"> GIS Systems and Remote Sensing </option>
                                    <option value="Research Methodology and Guidelines(Writhing Thesi"> Research Methodology and Guidelines(Writhing Thesi </option>
                                    <option value="Management Information System(MIS)"> Management Information System(MIS) </option>
                                    <option value="High Voltage Engineering"> High Voltage Engineering </option>
                                    <option value="Rural Development"> Rural Development </option>
                                    <option value="International Accounting Standard"> International Accounting Standard </option>
                                    <option value="Telecommunication Systems II"> Telecommunication Systems II </option>
                                    <option value="Wave Propagation II"> Wave Propagation II </option>
                                    <option value="Descriptive Geometry II"> Descriptive Geometry II </option>
                                    <option value="Principle of Statistic"> Principle of Statistic </option>
                                    <option value="Web Application I"> Web Application I </option>
                                    <option value="Front Office Management"> Front Office Management </option>
                                    <option value="Basic Engineering I"> Basic Engineering I </option>
                                    <option value="MICE Operation Management"> MICE Operation Management </option>
                                    <option value="Research Methodology and Guidelines(Writhing Thesi)"> Research Methodology and Guidelines(Writhing Thesi) </option>
                                    <option value="Research Methodology and Guidelines(Writhing Thesis)"> Research Methodology and Guidelines(Writhing Thesis) </option>
                                    <option value="International Business 2B"> International Business 2B </option>
                                    <option value="Inter. Cultural"> Inter. Cultural </option>
                                    <option value="Conservation"> Conservation </option>
                                    <option value="Landscape Design"> Landscape Design </option>
                                    <option value="Development Economics"> Development Economics </option>
                                    <option value="Diplomacy"> Diplomacy </option>
                                    <option value="Film Production"> Film Production </option>
                                    <option value="Fine Art Photography"> Fine Art Photography </option>
                                    <option value="Integrative Design Project"> Integrative Design Project </option>
                                    <option value="I Love U"> I Love U </option>
                                    <option value="Analog and Digital Filters"> Analog and Digital Filters </option>
                                    <option value="English for Traveling and Hospitality"> English for Traveling and Hospitality </option>
                                    <option value="Housekeeping Operation Management"> Housekeeping Operation Management </option>
                                    <option value="Criminal Justice Studies"> Criminal Justice Studies </option>
                                    <option value="Digital Film Storytelling I"> Digital Film Storytelling I </option>
                                    <option value="Food & Beverage Operation Management"> Food & Beverage Operation Management </option>
                                    <option value="Digital Photography"> Digital Photography </option>
                                    <option value="ICT in Tourism Industry"> ICT in Tourism Industry </option>
                                    <option value="Japanese for Hospitality A"> Japanese for Hospitality A </option>
                                    <option value="Media Research Methodology"> Media Research Methodology </option>
                                    <option value="Computer Graphic Design I"> Computer Graphic Design I </option>
                                    <option value="Business Plan in Tourism"> Business Plan in Tourism </option>
                                    <option value="Grammar and Reading III"> Grammar and Reading III </option>
                                    <option value="Tourism Safety and Security"> Tourism Safety and Security </option>
                                    <option value="Criminal Procedure II"> Criminal Procedure II </option>
                                    <option value="English for Travelling and Tourism II"> English for Travelling and Tourism II </option>
                                    <option value="Agricultural Economics"> Agricultural Economics </option>
                                    <option value="Electrical and Electricity"> Electrical and Electricity </option>
                                    <option value="Web Developing with PHP"> Web Developing with PHP </option>
                                    <option value="Hospitality and Tourism Marketing"> Hospitality and Tourism Marketing </option>
                                    <option value="Japanese for Hospitality B"> Japanese for Hospitality B </option>
                                    <option value="Fundamental of Physic"> Fundamental of Physic </option>
                                    <option value="Introduction to Computer (IT Essential)"> Introduction to Computer (IT Essential) </option>
                                    <option value="Computer Graphic Design II"> Computer Graphic Design II </option>
                                    <option value="Core English 2B"> "Core English 2B" </option>
                                    <option value=" Principle of Business">  Principle of Business </option>
                                    <option value="ភាសាអង់គ្លេស"> ភាសាអង់គ្លេស </option>
                                    <option value="Program Logic Control"> Program Logic Control </option>
                                    <option value="Introduction to Internet of Think (IoT)"> Introduction to Internet of Think (IoT) </option>
                                    <option value="Microprocessors & Digital Design"> Microprocessors & Digital Design </option>
                                    <option value="Introduction Artificial Intelligence (AI)"> Introduction Artificial Intelligence (AI) </option>
                                    <option value="Introduction to Big Data"> Introduction to Big Data </option>
                                    <option value="Introduction to Python"> Introduction to Python </option>
                                    <option value="Content Planning & Storytelling I"> Content Planning & Storytelling I </option>
                                    <option value="Introduction to OOM & P"> Introduction to OOM & P </option>
                                    <option value="Tourism Impact Management"> Tourism Impact Management </option>                                     
                                </select>

                                <div v-if="form.errors.Subject" class="text-error">
=======
                                <!-- <input type="text" v-model="form.Subject" class="w-full input input-primary" :class="{
                                    'input-error': form.errors.Subject,
                                }" /> -->
                                <select
                                    v-model="form.Subject"
                                    class="w-full input input-primary"
                                >
                                    <option value="">Select a Subject</option>
                                    <option value="Introduction to Computer">
                                        Introduction to Computer
                                    </option>
                                    <option value="Color and Sketching III">
                                        Color and Sketching III
                                    </option>
                                    <option
                                        value="Computer Graphic Design (2D & 3D Design)"
                                    >
                                        Computer Graphic Design (2D & 3D Design)
                                    </option>
                                    <option value="Core English & Writing II">
                                        Core English & Writing II
                                    </option>
                                    <option value="Engineering Drawing">
                                        Engineering Drawing
                                    </option>
                                    <option value="Physics for Engineering I">
                                        Physics for Engineering I
                                    </option>
                                    <option
                                        value="History of Khmer Architecture"
                                    >
                                        History of Khmer Architecture
                                    </option>
                                    <option value="Corporate Finance">
                                        Corporate Finance
                                    </option>
                                    <option value="General Management">
                                        General Management
                                    </option>
                                    <option
                                        value="Advertising and Sale Promotion"
                                    >
                                        Advertising and Sale Promotion
                                    </option>
                                    <option
                                        value="Pre-Stressed Concrete Design"
                                    >
                                        Pre-Stressed Concrete Design
                                    </option>
                                    <option value="Intercultural Communication">
                                        Intercultural Communication
                                    </option>
                                    <option value="Applied Linguistics">
                                        Applied Linguistics
                                    </option>
                                    <option value="Advanced Hotel Management">
                                        Advanced Hotel Management
                                    </option>
                                    <option
                                        value="Administrative and Procedure Law"
                                    >
                                        Administrative and Procedure Law
                                    </option>
                                    <option value="Sustainable Design">
                                        Sustainable Design
                                    </option>
                                    <option
                                        value="Managerial and Cost Accounting"
                                    >
                                        Managerial and Cost Accounting
                                    </option>
                                    <option value="Project Management">
                                        Project Management
                                    </option>
                                    <option value="Basic Marketing">
                                        Basic Marketing
                                    </option>
                                    <option value="Reinforced Concrete Design">
                                        Reinforced Concrete Design
                                    </option>
                                    <option value="International Relations">
                                        International Relations
                                    </option>
                                    <option value="Foundations of Education">
                                        Foundations of Education
                                    </option>
                                    <option
                                        value="Tourism Policy and Public Planning"
                                    >
                                        Tourism Policy and Public Planning
                                    </option>
                                    <option value="Civil and Procedure Law">
                                        Civil and Procedure Law
                                    </option>
                                    <option value="Urban Planning">
                                        Urban Planning
                                    </option>
                                    <option value="Principles of Accounting">
                                        Principles of Accounting
                                    </option>
                                    <option value="Strategic Management">
                                        Strategic Management
                                    </option>
                                    <option value="Marketing Strategy">
                                        Marketing Strategy
                                    </option>
                                    <option value="Structural Analysis">
                                        Structural Analysis
                                    </option>
                                    <option value="Term Paper Writing">
                                        Term Paper Writing
                                    </option>
                                    <option value="Teaching Methodology">
                                        Teaching Methodology
                                    </option>
                                    <option value="Travel Agency Management">
                                        Travel Agency Management
                                    </option>
                                    <option value="Criminal and Procedure Law">
                                        Criminal and Procedure Law
                                    </option>
                                    <option
                                        value="Computer Network MS NOS Administration"
                                    >
                                        Computer Network MS NOS Administration
                                    </option>
                                    <option value="Digital Television Project">
                                        Digital Television Project
                                    </option>
                                    <option
                                        value="Network Administrator (Microsoft)"
                                    >
                                        Network Administrator (Microsoft)
                                    </option>
                                    <option
                                        value="Data Structure and Algorithms in C/C++"
                                    >
                                        Data Structure and Algorithms in C/C++
                                    </option>
                                    <option value="Accounting  for Bank">
                                        Accounting for Bank
                                    </option>
                                    <option value="Feedback Control System">
                                        Feedback Control System
                                    </option>
                                    <option
                                        value="Introduction to Mass Communication"
                                    >
                                        Introduction to Mass Communication
                                    </option>
                                    <option value="Graphic Design Project">
                                        Graphic Design Project
                                    </option>
                                    <option
                                        value="Network Administrator (Open Source)"
                                    >
                                        Network Administrator (Open Source)
                                    </option>
                                    <option value="Database Management System">
                                        Database Management System
                                    </option>
                                    <option
                                        value="Network and Power Distribution"
                                    >
                                        Network and Power Distribution
                                    </option>
                                    <option value="Technical Writing">
                                        Technical Writing
                                    </option>
                                    <option value="Short Film Project">
                                        Short Film Project
                                    </option>
                                    <option value="Network Security (Cisco+IS)">
                                        Network Security (Cisco+IS)
                                    </option>
                                    <option value="System Analysis and Design">
                                        System Analysis and Design
                                    </option>
                                    <option
                                        value="Risk Management for Bank Activities"
                                    >
                                        Risk Management for Bank Activities
                                    </option>
                                    <option value="Telecommunication System">
                                        Telecommunication System
                                    </option>
                                    <option value="Cultural Studies A1">
                                        Cultural Studies A1
                                    </option>
                                    <option value="Construction Technology">
                                        Construction Technology
                                    </option>
                                    <option value="Conservation I">
                                        Conservation I
                                    </option>
                                    <option value="Marketing Research">
                                        Marketing Research
                                    </option>
                                    <option
                                        value="Database Management System with Oracle"
                                    >
                                        Database Management System with Oracle
                                    </option>
                                    <option value="3D Motion Graphic Design">
                                        3D Motion Graphic Design
                                    </option>
                                    <option value="Digital Electronics II">
                                        Digital Electronics II
                                    </option>
                                    <option value="Diplomacy 1A">
                                        Diplomacy 1A
                                    </option>
                                    <option value="Educational Management">
                                        Educational Management
                                    </option>
                                    <option
                                        value="Restaurent and Bar management"
                                    >
                                        Restaurent and Bar management
                                    </option>
                                    <option value="Civil Procedure I">
                                        Civil Procedure I
                                    </option>
                                    <option
                                        value="Construction Management & Analysis I"
                                    >
                                        Construction Management & Analysis I
                                    </option>
                                    <option
                                        value="Linux Enterprise Server Administrator"
                                    >
                                        Linux Enterprise Server Administrator
                                    </option>
                                    <option
                                        value="Advance Computer Network in Window Server"
                                    >
                                        Advance Computer Network in Window
                                        Server
                                    </option>
                                    <option value="Auditing">Auditing</option>
                                    <option value="Grammar & Composition I">
                                        Grammar & Composition I
                                    </option>
                                    <option
                                        value="Industrial Power Distribution & Energy Efficiency"
                                    >
                                        Industrial Power Distribution & Energy
                                        Efficiency
                                    </option>
                                    <option value="Grammar & Reading A1">
                                        Grammar & Reading A1
                                    </option>
                                    <option value="Color and Sketching V">
                                        Color and Sketching V
                                    </option>
                                    <option
                                        value="Fluid Mechanics and Hydraulics Engineering I"
                                    >
                                        Fluid Mechanics and Hydraulics
                                        Engineering I
                                    </option>
                                    <option
                                        value="Professional Practice in Architecture I"
                                    >
                                        Professional Practice in Architecture I
                                    </option>
                                    <option value="Principles of Accounting I">
                                        Principles of Accounting I
                                    </option>
                                    <option value="Dot NET Programming I">
                                        Dot NET Programming I
                                    </option>
                                    <option value="Business Communication">
                                        Business Communication
                                    </option>
                                    <option value="Civil Law I">
                                        Civil Law I
                                    </option>
                                    <option
                                        value="Financial Statement Analysis"
                                    >
                                        Financial Statement Analysis
                                    </option>
                                    <option value="Java Programming">
                                        Java Programming
                                    </option>
                                    <option
                                        value="Advanced Digital Television and Broadcasting"
                                    >
                                        Advanced Digital Television and
                                        Broadcasting
                                    </option>
                                    <option value="Environmental Economics">
                                        Environmental Economics
                                    </option>
                                    <option value="Electrical Machines I">
                                        Electrical Machines I
                                    </option>
                                    <option
                                        value="Law and Rule of Construction"
                                    >
                                        Law and Rule of Construction
                                    </option>
                                    <option value="Grammar & Reading B1">
                                        Grammar & Reading B1
                                    </option>
                                    <option value="Computer Graphic Design">
                                        Computer Graphic Design
                                    </option>
                                    <option value="Scaling Networks">
                                        Scaling Networks
                                    </option>
                                    <option value="Corporate Finance I">
                                        Corporate Finance I
                                    </option>
                                    <option value="International Business">
                                        International Business
                                    </option>
                                    <option value="Microprocessors II">
                                        Microprocessors II
                                    </option>
                                    <option value="Reading & Writing">
                                        Reading & Writing
                                    </option>
                                    <option
                                        value="Computer Graphic Design III (3D-Max)"
                                    >
                                        Computer Graphic Design III (3D-Max)
                                    </option>
                                    <option value="Principles of Marketing">
                                        Principles of Marketing
                                    </option>
                                    <option
                                        value="Database Management System I"
                                    >
                                        Database Management System I
                                    </option>
                                    <option
                                        value="Computer (Network Engineering)"
                                    >
                                        Computer (Network Engineering)
                                    </option>
                                    <option value="Japanese">Japanese</option>
                                    <option value="Constitutional Law-1">
                                        Constitutional Law-1
                                    </option>
                                    <option value="Macroeconomics">
                                        Macroeconomics
                                    </option>
                                    <option value="Hydrology">Hydrology</option>
                                    <option value="Macroeconomics II">
                                        Macroeconomics II
                                    </option>
                                    <option value="Industrial Equipments">
                                        Industrial Equipments
                                    </option>
                                    <option
                                        value="Inter-Cultural Communication"
                                    >
                                        Inter-Cultural Communication
                                    </option>
                                    <option value="Listening & Speaking B1">
                                        Listening & Speaking B1
                                    </option>
                                    <option
                                        value="Project Planning and Implementation"
                                    >
                                        Project Planning and Implementation
                                    </option>
                                    <option
                                        value="Reinforced Concrete Design I"
                                    >
                                        Reinforced Concrete Design I
                                    </option>
                                    <option value="Listening & Speaking A1">
                                        Listening & Speaking A1
                                    </option>
                                    <option value="IT Essential">
                                        IT Essential
                                    </option>
                                    <option value="Adverting Graphic Design">
                                        Adverting Graphic Design
                                    </option>
                                    <option value="Window Server Administrator">
                                        Window Server Administrator
                                    </option>
                                    <option value="Java Programming II">
                                        Java Programming II
                                    </option>
                                    <option value="Modulation">
                                        Modulation
                                    </option>
                                    <option value="Linux Server Administrator">
                                        Linux Server Administrator
                                    </option>
                                    <option value="Descriptive Geometry I">
                                        Descriptive Geometry I
                                    </option>
                                    <option value="Auto CAD (2D)">
                                        Auto CAD (2D)
                                    </option>
                                    <option value="Literature Studies A1">
                                        Literature Studies A1
                                    </option>
                                    <option value="History of Architecture I">
                                        History of Architecture I
                                    </option>
                                    <option value="Urban Regulation">
                                        Urban Regulation
                                    </option>
                                    <option value="Principles of Management">
                                        Principles of Management
                                    </option>
                                    <option value="Digital Design">
                                        Digital Design
                                    </option>
                                    <option value="Soft Skills I">
                                        Soft Skills I
                                    </option>
                                    <option value="Computer Network">
                                        Computer Network
                                    </option>
                                    <option value="Criminal Law I">
                                        Criminal Law I
                                    </option>
                                    <option value="Operation Management">
                                        Operation Management
                                    </option>
                                    <option
                                        value="Soil Mechanics and Foundations I"
                                    >
                                        Soil Mechanics and Foundations I
                                    </option>
                                    <option value="Networks-Server System">
                                        Networks-Server System
                                    </option>
                                    <option
                                        value="Mathematics for Engineers II"
                                    >
                                        Mathematics for Engineers II
                                    </option>
                                    <option value="Literature Studies B1">
                                        Literature Studies B1
                                    </option>
                                    <option value="Criminal Procedure I">
                                        Criminal Procedure I
                                    </option>
                                    <option value="Road Construction I">
                                        Road Construction I
                                    </option>
                                    <option
                                        value="Cinema Marketing & Contents Business"
                                    >
                                        Cinema Marketing & Contents Business
                                    </option>
                                    <option value="Microsoft SQL Server II">
                                        Microsoft SQL Server II
                                    </option>
                                    <option value="Monetary and Banking System">
                                        Monetary and Banking System
                                    </option>
                                    <option value="Public Speaking I">
                                        Public Speaking I
                                    </option>
                                    <option
                                        value="Network and Power Distribute I"
                                    >
                                        Network and Power Distribute I
                                    </option>
                                    <option value="Business Law">
                                        Business Law
                                    </option>
                                    <option value="Chemistry for Engineering">
                                        Chemistry for Engineering
                                    </option>
                                    <option value="Writing Skills A1">
                                        Writing Skills A1
                                    </option>
                                    <option value="Strength of Materials I">
                                        Strength of Materials I
                                    </option>
                                    <option value="Information systems">
                                        Information systems
                                    </option>
                                    <option value="Microeconomics II">
                                        Microeconomics II
                                    </option>
                                    <option
                                        value="Electrical Circuit Analysis I"
                                    >
                                        Electrical Circuit Analysis I
                                    </option>
                                    <option
                                        value="Tourism Geography in Cambodia"
                                    >
                                        Tourism Geography in Cambodia
                                    </option>
                                    <option value="Land and​ Construction Law">
                                        Land and​ Construction Law
                                    </option>
                                    <option value="Cost Accounting">
                                        Cost Accounting
                                    </option>
                                    <option value="SPSS">SPSS</option>
                                    <option
                                        value="Object-Oriented Methodology and Programming"
                                    >
                                        Object-Oriented Methodology and
                                        Programming
                                    </option>
                                    <option value="Sensors and Interfaces">
                                        Sensors and Interfaces
                                    </option>
                                    <option value="Writing Skills B1">
                                        Writing Skills B1
                                    </option>
                                    <option value="Finance and Taxation Law">
                                        Finance and Taxation Law
                                    </option>
                                    <option value="Sanitary Engineering Design">
                                        Sanitary Engineering Design
                                    </option>
                                    <option
                                        value="Digital Television & Broadcasting I"
                                    >
                                        Digital Television & Broadcasting I
                                    </option>
                                    <option value="Land and Construction Law">
                                        Land and Construction Law
                                    </option>
                                    <option
                                        value="Digital Film Directing & Making I"
                                    >
                                        Digital Film Directing & Making I
                                    </option>
                                    <option value="Power Electronics II">
                                        Power Electronics II
                                    </option>
                                    <option
                                        value="Introduction of design (2D&3D)"
                                    >
                                        Introduction of design (2D&3D)
                                    </option>
                                    <option value="Introduction to Statistics">
                                        Introduction to Statistics
                                    </option>
                                    <option
                                        value="Mathematics for Engineering III"
                                    >
                                        Mathematics for Engineering III
                                    </option>
                                    <option value="Structural Analysis I">
                                        Structural Analysis I
                                    </option>
                                    <option value="Advanced Programming in C#">
                                        Advanced Programming in C#
                                    </option>
                                    <option value="Mathematics for Engineers I">
                                        Mathematics for Engineers I
                                    </option>
                                    <option
                                        value="Legal Terminology in English"
                                    >
                                        Legal Terminology in English
                                    </option>
                                    <option value="Taxation">Taxation</option>
                                    <option value="Human Resource Management">
                                        Human Resource Management
                                    </option>
                                    <option
                                        value="Statistic and Random Process"
                                    >
                                        Statistic and Random Process
                                    </option>
                                    <option value="Legal and Justice Policy">
                                        Legal and Justice Policy
                                    </option>
                                    <option value="Steel Design">
                                        Steel Design
                                    </option>
                                    <option
                                        value="Imaging for Narrative & Story Boards I"
                                    >
                                        Imaging for Narrative & Story Boards I
                                    </option>
                                    <option value="Power Plants">
                                        Power Plants
                                    </option>

                                    <option
                                        value="Architectural Design for Civil Engineering"
                                    >
                                        Architectural Design for Civil
                                        Engineering
                                    </option>
                                    <option value="C Programming">
                                        C Programming
                                    </option>
                                    <option value="Khmer Culture">
                                        Khmer Culture
                                    </option>
                                    <option
                                        value="Administrative Law  and Procedure"
                                    >
                                        Administrative Law and Procedure
                                    </option>
                                    <option value="Anglong and Digital Filters">
                                        Anglong and Digital Filters
                                    </option>
                                    <option value="Auto CAD Civil 3D">
                                        Auto CAD Civil 3D
                                    </option>
                                    <option value="3D Animation Production I">
                                        3D Animation Production I
                                    </option>
                                    <option
                                        value="Human Resource Management in Hospitality"
                                    >
                                        Human Resource Management in Hospitality
                                    </option>
                                    <option value="Feed Back Control Systems I">
                                        Feed Back Control Systems I
                                    </option>
                                    <option value="Analog Electronics II">
                                        Analog Electronics II
                                    </option>
                                    <option value="Electromagnetic Theory II">
                                        Electromagnetic Theory II
                                    </option>
                                    <option
                                        value="Computer Graphic Design II (2D & 3D-Design)"
                                    >
                                        Computer Graphic Design II (2D &
                                        3D-Design)
                                    </option>
                                    <option value="Descriptive Geometry III">
                                        Descriptive Geometry III
                                    </option>
                                    <option
                                        value="Khmer Arch (Design & Sculpture)"
                                    >
                                        Khmer Arch (Design & Sculpture)
                                    </option>
                                    <option
                                        value="Topographical Surveying for Architecture"
                                    >
                                        Topographical Surveying for Architecture
                                    </option>
                                    <option
                                        value="Business and Economics Statistics"
                                    >
                                        Business and Economics Statistics
                                    </option>
                                    <option value="Entrepreneurship">
                                        Entrepreneurship
                                    </option>
                                    <option value="Financial Mathematics">
                                        Financial Mathematics
                                    </option>
                                    <option value="Principles of Accounting II">
                                        Principles of Accounting II
                                    </option>
                                    <option value="Concrete mix design">
                                        Concrete mix design
                                    </option>
                                    <option value="Electricity in Building">
                                        Electricity in Building
                                    </option>
                                    <option value="Engineering Geology">
                                        Engineering Geology
                                    </option>
                                    <option
                                        value="Engineering Tool & Operation"
                                    >
                                        Engineering Tool & Operation
                                    </option>
                                    <option value="Physics for Engineering II">
                                        Physics for Engineering II
                                    </option>
                                    <option
                                        value="Data Structure & Algorithm in C/C++"
                                    >
                                        Data Structure & Algorithm in C/C++
                                    </option>
                                    <option value="Digital Electronic I">
                                        Digital Electronic I
                                    </option>
                                    <option value="Cultural Studies 2">
                                        Cultural Studies 2
                                    </option>
                                    <option value="Labor Law">Labor Law</option>
                                    <option value="Contract Law">
                                        Contract Law
                                    </option>
                                    <option value="Constitutional Law II">
                                        Constitutional Law II
                                    </option>
                                    <option value="Criminal Law II ( Special)">
                                        Criminal Law II ( Special)
                                    </option>
                                    <option value="Civil Law II">
                                        Civil Law II
                                    </option>
                                    <option
                                        value="Basic Engineering II (Str. and Rei. Concrete)"
                                    >
                                        Basic Engineering II (Str. and Rei.
                                        Concrete)
                                    </option>
                                    <option value="History of Architecture II">
                                        History of Architecture II
                                    </option>
                                    <option value="Consumer Behavior">
                                        Consumer Behavior
                                    </option>
                                    <option value="Engineering Surveying">
                                        Engineering Surveying
                                    </option>
                                    <option
                                        value="Fluid Mechanics and Hydraulics Engineering II"
                                    >
                                        Fluid Mechanics and Hydraulics
                                        Engineering II
                                    </option>
                                    <option
                                        value="Soil Mechanics and Foundations II"
                                    >
                                        Soil Mechanics and Foundations II
                                    </option>
                                    <option value="Transportation and Planning">
                                        Transportation and Planning
                                    </option>
                                    <option value="Electromagnetic Theory I">
                                        Electromagnetic Theory I
                                    </option>
                                    <option
                                        value="Electrical System Design for Buildings"
                                    >
                                        Electrical System Design for Buildings
                                    </option>
                                    <option value="Diplomacy 1B">
                                        Diplomacy 1B
                                    </option>
                                    <option value="Business Law I">
                                        Business Law I
                                    </option>
                                    <option
                                        value="Landscape Design (Basic & Advances Landscape)"
                                    >
                                        Landscape Design (Basic & Advances
                                        Landscape)
                                    </option>
                                    <option value="Conservation II">
                                        Conservation II
                                    </option>
                                    <option
                                        value="Project Planing and Implementations"
                                    >
                                        Project Planing and Implementations
                                    </option>
                                    <option
                                        value="Reinforces Concrete Design II"
                                    >
                                        Reinforces Concrete Design II
                                    </option>
                                    <option value="Color and Sketching IV">
                                        Color and Sketching IV
                                    </option>
                                    <option
                                        value="Professional Practice in Architecture II"
                                    >
                                        Professional Practice in Architecture II
                                    </option>
                                    <option value="Management Practice">
                                        Management Practice
                                    </option>
                                    <option value="Theory of Mechanics">
                                        Theory of Mechanics
                                    </option>
                                    <option value="Digital Design (1st Sem)">
                                        Digital Design (1st Sem)
                                    </option>
                                    <option
                                        value="Web Development and Programming I"
                                    >
                                        Web Development and Programming I
                                    </option>
                                    <option
                                        value="Digital Film Storytelling II"
                                    >
                                        Digital Film Storytelling II
                                    </option>
                                    <option
                                        value="Digital Television & Broadcasting II"
                                    >
                                        Digital Television & Broadcasting II
                                    </option>
                                    <option value="Matlab Application">
                                        Matlab Application
                                    </option>
                                    <option
                                        value="Thermal Processes and Cooling Systems I"
                                    >
                                        Thermal Processes and Cooling Systems I
                                    </option>
                                    <option value="Listening and Speaking 2">
                                        Listening and Speaking 2
                                    </option>
                                    <option value="Literature Studies 2">
                                        Literature Studies 2
                                    </option>
                                    <option value="Writing Skills 2">
                                        Writing Skills 2
                                    </option>
                                    <option value="Leadership">
                                        Leadership
                                    </option>
                                    <option value="Research Methods">
                                        Research Methods
                                    </option>
                                    <option value="Services Marketing">
                                        Services Marketing
                                    </option>
                                    <option value="Strength of Materials II">
                                        Strength of Materials II
                                    </option>
                                    <option
                                        value="Linux Server Administrator II"
                                    >
                                        Linux Server Administrator II
                                    </option>
                                    <option
                                        value="Advance Digital Televition and Promoting"
                                    >
                                        Advance Digital Televition and Promoting
                                    </option>
                                    <option value="Connecting Networks">
                                        Connecting Networks
                                    </option>
                                    <option value="Database System Oracle I">
                                        Database System Oracle I
                                    </option>
                                    <option value="Banking Practice & Law">
                                        Banking Practice & Law
                                    </option>
                                    <option value="Grammar and Composition II">
                                        Grammar and Composition II
                                    </option>
                                    <option value="Literature Studies 3">
                                        Literature Studies 3
                                    </option>
                                    <option value="Grammar & Writing">
                                        Grammar & Writing
                                    </option>
                                    <option value="Writing Skills 3">
                                        Writing Skills 3
                                    </option>
                                    <option
                                        value="Cost and Benefit Analysis in Hospitality"
                                    >
                                        Cost and Benefit Analysis in Hospitality
                                    </option>
                                    <option value="Justice and Human Rights">
                                        Justice and Human Rights
                                    </option>
                                    <option
                                        value="Construction Management & Analysis II"
                                    >
                                        Construction Management & Analysis II
                                    </option>
                                    <option
                                        value="Earthen Dam Design & Slope protections"
                                    >
                                        Earthen Dam Design & Slope protections
                                    </option>
                                    <option value="GIS and remote sensing">
                                        GIS and remote sensing
                                    </option>
                                    <option value="Road Construction II">
                                        Road Construction II
                                    </option>
                                    <option
                                        value="Modeling and Controlling Power Electronics"
                                    >
                                        Modeling and Controlling Power
                                        Electronics
                                    </option>
                                    <option
                                        value="Network Transmission & Power Distribution II"
                                    >
                                        Network Transmission & Power
                                        Distribution II
                                    </option>
                                    <option value="Virtual Instrumentation">
                                        Virtual Instrumentation
                                    </option>
                                    <option value="Grammar and Reading 2">
                                        Grammar and Reading 2
                                    </option>
                                    <option value="Power Electronics I">
                                        Power Electronics I
                                    </option>
                                    <option value="Japanese IV">
                                        Japanese IV
                                    </option>
                                    <option value="Wooden Design">
                                        Wooden Design
                                    </option>
                                    <option
                                        value="Analog and Digital Filter II"
                                    >
                                        Analog and Digital Filter II
                                    </option>
                                    <option value="Civil Procedure II">
                                        Civil Procedure II
                                    </option>
                                    <option value="Advanced Java Programming">
                                        Advanced Java Programming
                                    </option>
                                    <option value="3D Motion Graphic Design II">
                                        3D Motion Graphic Design II
                                    </option>
                                    <option
                                        value="Feed Back Control Systems II"
                                    >
                                        Feed Back Control Systems II
                                    </option>
                                    <option value="Color and Sketching VI">
                                        Color and Sketching VI
                                    </option>
                                    <option value="Routing & Switching Basic">
                                        Routing & Switching Basic
                                    </option>
                                    <option value="Listening and Speaking 3">
                                        Listening and Speaking 3
                                    </option>
                                    <option value="3D Animation Production II">
                                        3D Animation Production II
                                    </option>
                                    <option
                                        value="Advance Digital Photography IV"
                                    >
                                        Advance Digital Photography IV
                                    </option>
                                    <option
                                        value="Linux Enterprise Server Network Service"
                                    >
                                        Linux Enterprise Server Network Service
                                    </option>
                                    <option
                                        value="IT Professional: Web App. II"
                                    >
                                        IT Professional: Web App. II
                                    </option>
                                    <option value="Electrical Machinces II">
                                        Electrical Machinces II
                                    </option>
                                    <option
                                        value="Database Management Systems II"
                                    >
                                        Database Management Systems II
                                    </option>
                                    <option value="Server and Storage System">
                                        Server and Storage System
                                    </option>
                                    <option
                                        value="Analog Electronic Circuits I"
                                    >
                                        Analog Electronic Circuits I
                                    </option>
                                    <option value="Intermediate Accounting">
                                        Intermediate Accounting
                                    </option>
                                    <option value="Accounting for Bank">
                                        Accounting for Bank
                                    </option>
                                    <option
                                        value="Advance Digital Photography II"
                                    >
                                        Advance Digital Photography II
                                    </option>
                                    <option value="MS Network Technology">
                                        MS Network Technology
                                    </option>
                                    <option value="Microsoft Security">
                                        Microsoft Security
                                    </option>
                                    <option value="Mobile Technology I">
                                        Mobile Technology I
                                    </option>
                                    <option value="Evidence Law">
                                        Evidence Law
                                    </option>
                                    <option value="Motor Drivers">
                                        Motor Drivers
                                    </option>
                                    <option value="Soft Skills">
                                        Soft Skills
                                    </option>
                                    <option
                                        value="Advanced Programming in C# II"
                                    >
                                        Advanced Programming in C# II
                                    </option>
                                    <option
                                        value="Food and Beverage Operations"
                                    >
                                        Food and Beverage Operations
                                    </option>
                                    <option value="Managerial Accounting">
                                        Managerial Accounting
                                    </option>
                                    <option value="Total Quality Management">
                                        Total Quality Management
                                    </option>
                                    <option value="Structural Analysis II">
                                        Structural Analysis II
                                    </option>
                                    <option value="ASEAN Economics">
                                        ASEAN Economics
                                    </option>
                                    <option value="Internation Relations">
                                        Internation Relations
                                    </option>
                                    <option value="Data Communication">
                                        Data Communication
                                    </option>
                                    <option
                                        value="Contents Planning & Storyboarding II"
                                    >
                                        Contents Planning & Storyboarding II
                                    </option>
                                    <option value="Principle of Accounting">
                                        Principle of Accounting
                                    </option>
                                    <option value="Brand Identity Design">
                                        Brand Identity Design
                                    </option>
                                    <option value="Software Engineering">
                                        Software Engineering
                                    </option>
                                    <option value="Public Speaking 3">
                                        Public Speaking 3
                                    </option>
                                    <option value="Insurance Law">
                                        Insurance Law
                                    </option>
                                    <option value="Dot Net Programming II">
                                        Dot Net Programming II
                                    </option>
                                    <option value="Computer Network I">
                                        Computer Network I
                                    </option>
                                    <option
                                        value="Electrical Circuit Analysis II"
                                    >
                                        Electrical Circuit Analysis II
                                    </option>
                                    <option value="Criminal Law II (Special)">
                                        Criminal Law II (Special)
                                    </option>
                                    <option value="Profit Planning and Control">
                                        Profit Planning and Control
                                    </option>
                                    <option value="International Finance">
                                        International Finance
                                    </option>
                                    <option value="Corporate Finance II">
                                        Corporate Finance II
                                    </option>
                                    <option value="Community Development">
                                        Community Development
                                    </option>
                                    <option value="Microprocessors I">
                                        Microprocessors I
                                    </option>
                                    <option
                                        value="Meeting Incentive Convention Exhibition Management"
                                    >
                                        Meeting Incentive Convention Exhibition
                                        Management
                                    </option>
                                    <option value="Optical Communication">
                                        Optical Communication
                                    </option>
                                    <option value="Java Programming I">
                                        Java Programming I
                                    </option>
                                    <option value="Macroeconomics I">
                                        Macroeconomics I
                                    </option>
                                    <option value="Hotel Operation Management">
                                        Hotel Operation Management
                                    </option>
                                    <option value="QuickBooks">
                                        QuickBooks
                                    </option>
                                    <option value="Money and Capital Market">
                                        Money and Capital Market
                                    </option>
                                    <option value="Research Methodology">
                                        Research Methodology
                                    </option>
                                    <option
                                        value="Wireless Mobile Programming I"
                                    >
                                        Wireless Mobile Programming I
                                    </option>
                                    <option
                                        value="Digital Film Directing & Making II"
                                    >
                                        Digital Film Directing & Making II
                                    </option>
                                    <option value="WTO & ASEAN Legal System">
                                        WTO & ASEAN Legal System
                                    </option>
                                    <option value="Telecommunication Systems I">
                                        Telecommunication Systems I
                                    </option>
                                    <option value="Microsoft SQL Server I">
                                        Microsoft SQL Server I
                                    </option>
                                    <option value="Japanese II">
                                        Japanese II
                                    </option>
                                    <option value="Program Logic Control (PLC)">
                                        Program Logic Control (PLC)
                                    </option>
                                    <option
                                        value="Strategic Management in Hospitality"
                                    >
                                        Strategic Management in Hospitality
                                    </option>
                                    <option value="Media Interaction Design">
                                        Media Interaction Design
                                    </option>
                                    <option value="Renewable Energy">
                                        Renewable Energy
                                    </option>
                                    <option value="Wave Propagation I">
                                        Wave Propagation I
                                    </option>
                                    <option value="Signals and Systems">
                                        Signals and Systems
                                    </option>
                                    <option value="Testing">Testing</option>
                                    <option value="Corlor and Sketching">
                                        Corlor and Sketching
                                    </option>
                                    <option value="Core English 2A">
                                        Core English 2A
                                    </option>
                                    <option value="Core English 2B">
                                        Core English 2B
                                    </option>
                                    <option value="Creation Concept">
                                        Creation Concept
                                    </option>
                                    <option value="Digital Photography II">
                                        Digital Photography II
                                    </option>
                                    <option
                                        value="Introduction to Politial Science"
                                    >
                                        Introduction to Politial Science
                                    </option>
                                    <option
                                        value="Introduction to State and Law"
                                    >
                                        Introduction to State and Law
                                    </option>
                                    <option value="Math for Bus and Eco">
                                        Math for Bus and Eco
                                    </option>

                                    <option
                                        value="Math for Computer Science II"
                                    >
                                        Math for Computer Science II
                                    </option>
                                    <option value="Math for Engineering I">
                                        Math for Engineering I
                                    </option>
                                    <option value="Math for Engineering II">
                                        Math for Engineering II
                                    </option>
                                    <option value="Principle of Business">
                                        Principle of Business
                                    </option>
                                    <option value="Programming in C/C++">
                                        Programming in C/C++
                                    </option>
                                    <option
                                        value="Foundamental of Architecture"
                                    >
                                        Foundamental of Architecture
                                    </option>
                                    <option value="Software Application">
                                        Software Application
                                    </option>
                                    <option
                                        value="Mathematics for Engineering II"
                                    >
                                        Mathematics for Engineering II
                                    </option>
                                    <option value="Core English 1B">
                                        Core English 1B
                                    </option>
                                    <option
                                        value="Programming Methodology in C++"
                                    >
                                        Programming Methodology in C++
                                    </option>
                                    <option value="Introduction to Philosophy">
                                        Introduction to Philosophy
                                    </option>
                                    <option value="Khmer Studies">
                                        Khmer Studies
                                    </option>
                                    <option
                                        value="Mathematics for computer Science 2"
                                    >
                                        Mathematics for computer Science 2
                                    </option>
                                    <option value="Microeconomics I">
                                        Microeconomics I
                                    </option>
                                    <option value="Human & Society">
                                        Human & Society
                                    </option>
                                    <option
                                        value="Introduction to Political Science"
                                    >
                                        Introduction to Political Science
                                    </option>
                                    <option value="Principle of Economics">
                                        Principle of Economics
                                    </option>
                                    <option value="Introduction to Tourism">
                                        Introduction to Tourism
                                    </option>
                                    <option value="Fundamental of Physics">
                                        Fundamental of Physics
                                    </option>
                                    <option value="Principles of Statistics">
                                        Principles of Statistics
                                    </option>
                                    <option value="English 1A">
                                        English 1A
                                    </option>
                                    <option value="Color and Sketching">
                                        Color and Sketching
                                    </option>
                                    <option value="Principles of Business">
                                        Principles of Business
                                    </option>
                                    <option
                                        value="Applied Mathematics for Bus and Eco"
                                    >
                                        Applied Mathematics for Bus and Eco
                                    </option>
                                    <option value="Electricity and Electronics">
                                        Electricity and Electronics
                                    </option>
                                    <option value="English 2A">
                                        English 2A
                                    </option>
                                    <option value="Principles of Economics">
                                        Principles of Economics
                                    </option>
                                    <option
                                        value="Mathematic for Engineering I"
                                    >
                                        Mathematic for Engineering I
                                    </option>
                                    <option
                                        value="Mathematics for Computer Science I"
                                    >
                                        Mathematics for Computer Science I
                                    </option>
                                    <option value="Psychology">
                                        Psychology
                                    </option>
                                    <option value="Digital Photography I">
                                        Digital Photography I
                                    </option>
                                    <option value="Introduction to Multimedai">
                                        Introduction to Multimedai
                                    </option>
                                    <option value="test">test</option>
                                    <option value="Descriptive Geometry ">
                                        Descriptive Geometry
                                    </option>
                                    <option value="Introduction  to Statistics">
                                        Introduction to Statistics
                                    </option>
                                    <option
                                        value="Fluid Mechanics and Hydraulics Engineering"
                                    >
                                        Fluid Mechanics and Hydraulics
                                        Engineering
                                    </option>
                                    <option value="Sewage and Water System">
                                        Sewage and Water System
                                    </option>
                                    <option value="Program Robot">
                                        Program Robot
                                    </option>
                                    <option value="Public Finance">
                                        Public Finance
                                    </option>
                                    <option value="Business Plan for Tourism">
                                        Business Plan for Tourism
                                    </option>
                                    <option value="Investment Management">
                                        Investment Management
                                    </option>
                                    <option value="Managing Team">
                                        Managing Team
                                    </option>
                                    <option value="Money and Capital Markets">
                                        Money and Capital Markets
                                    </option>
                                    <option
                                        value="Business to Business Marketing"
                                    >
                                        Business to Business Marketing
                                    </option>
                                    <option
                                        value="Advertising and Sales Promotion"
                                    >
                                        Advertising and Sales Promotion
                                    </option>
                                    <option value="Bridge Ccnstruction">
                                        Bridge Ccnstruction
                                    </option>
                                    <option value="Bank Management">
                                        Bank Management
                                    </option>
                                    <option
                                        value="Optimization of Power System"
                                    >
                                        Optimization of Power System
                                    </option>
                                    <option value="Technical Writing I">
                                        Technical Writing I
                                    </option>
                                    <option value="International Public Law">
                                        International Public Law
                                    </option>
                                    <option value="Resort Management">
                                        Resort Management
                                    </option>
                                    <option
                                        value="Tourism Policy and Public Planing"
                                    >
                                        Tourism Policy and Public Planing
                                    </option>
                                    <option value="Criminalistics">
                                        Criminalistics
                                    </option>
                                    <option value="Private International Law">
                                        Private International Law
                                    </option>
                                    <option value="Bridge Construction">
                                        Bridge Construction
                                    </option>
                                    <option value="Organizational Development">
                                        Organizational Development
                                    </option>
                                    <option value="Credit Management">
                                        Credit Management
                                    </option>
                                    <option value="Applied Linguistics I">
                                        Applied Linguistics I
                                    </option>
                                    <option value="Inormation Security(IS)">
                                        Inormation Security(IS)
                                    </option>
                                    <option value="3D Visual Effect">
                                        3D Visual Effect
                                    </option>
                                    <option value="Information Security">
                                        Information Security
                                    </option>
                                    <option
                                        value="Intercultural Business Communication"
                                    >
                                        Intercultural Business Communication
                                    </option>
                                    <option
                                        value="Diplomacy in the Age of Globalization"
                                    >
                                        Diplomacy in the Age of Globalization
                                    </option>
                                    <option
                                        value="Analysis of Cambodian Economics"
                                    >
                                        Analysis of Cambodian Economics
                                    </option>
                                    <option value="Foundations of Education I">
                                        Foundations of Education I
                                    </option>
                                    <option
                                        value="Wireless Mobile Programming II"
                                    >
                                        Wireless Mobile Programming II
                                    </option>
                                    <option value="Advanced Media Art Project">
                                        Advanced Media Art Project
                                    </option>
                                    <option value="CCNA Security">
                                        CCNA Security
                                    </option>
                                    <option value="Mobile Technology II">
                                        Mobile Technology II
                                    </option>
                                    <option
                                        value="Electrical Standard for Builing in Cambodia"
                                    >
                                        Electrical Standard for Builing in
                                        Cambodia
                                    </option>
                                    <option value="International Business 2A">
                                        International Business 2A
                                    </option>
                                    <option value="Inter.Cultural">
                                        Inter.Cultural
                                    </option>
                                    <option value="Enterpreneurship">
                                        Enterpreneurship
                                    </option>
                                    <option
                                        value="Juvenile Criminal Justice System in Cambodia"
                                    >
                                        Juvenile Criminal Justice System in
                                        Cambodia
                                    </option>
                                    <option value="Forecasting Analysis">
                                        Forecasting Analysis
                                    </option>
                                    <option value="Teaching Methodology I">
                                        Teaching Methodology I
                                    </option>
                                    <option value="Advanced Accounting">
                                        Advanced Accounting
                                    </option>
                                    <option value="Digital Image Processing">
                                        Digital Image Processing
                                    </option>
                                    <option value="Integrative Creative Design">
                                        Integrative Creative Design
                                    </option>
                                    <option
                                        value="Linux Enterprise Sever Security"
                                    >
                                        Linux Enterprise Sever Security
                                    </option>
                                    <option value="English for IT">
                                        English for IT
                                    </option>
                                    <option
                                        value="Electromagnetic Compatibility"
                                    >
                                        Electromagnetic Compatibility
                                    </option>
                                    <option
                                        value="Introduction to Mass Communication I"
                                    >
                                        Introduction to Mass Communication I
                                    </option>
                                    <option value="Internation Relation">
                                        Internation Relation
                                    </option>
                                    <option
                                        value="Introduction to Financial Analysis and Risk Mgt"
                                    >
                                        Introduction to Financial Analysis and
                                        Risk Mgt
                                    </option>
                                    <option value="Personal Selling">
                                        Personal Selling
                                    </option>
                                    <option value="E-Commerce Technologies">
                                        E-Commerce Technologies
                                    </option>
                                    <option
                                        value="Practical Works for Digital Film"
                                    >
                                        Practical Works for Digital Film
                                    </option>
                                    <option
                                        value="Customer Relationship Management"
                                    >
                                        Customer Relationship Management
                                    </option>
                                    <option
                                        value="Engineering Management & Project Planning"
                                    >
                                        Engineering Management & Project
                                        Planning
                                    </option>
                                    <option
                                        value="GIS Systems and Remote Sensing"
                                    >
                                        GIS Systems and Remote Sensing
                                    </option>
                                    <option
                                        value="Research Methodology and Guidelines(Writhing Thesi"
                                    >
                                        Research Methodology and
                                        Guidelines(Writhing Thesi
                                    </option>
                                    <option
                                        value="Management Information System(MIS)"
                                    >
                                        Management Information System(MIS)
                                    </option>
                                    <option value="High Voltage Engineering">
                                        High Voltage Engineering
                                    </option>
                                    <option value="Rural Development">
                                        Rural Development
                                    </option>
                                    <option
                                        value="International Accounting Standard"
                                    >
                                        International Accounting Standard
                                    </option>
                                    <option
                                        value="Telecommunication Systems II"
                                    >
                                        Telecommunication Systems II
                                    </option>
                                    <option value="Wave Propagation II">
                                        Wave Propagation II
                                    </option>
                                    <option value="Descriptive Geometry II">
                                        Descriptive Geometry II
                                    </option>
                                    <option value="Principle of Statistic">
                                        Principle of Statistic
                                    </option>
                                    <option value="Web Application I">
                                        Web Application I
                                    </option>
                                    <option value="Front Office Management">
                                        Front Office Management
                                    </option>
                                    <option value="Basic Engineering I">
                                        Basic Engineering I
                                    </option>
                                    <option value="MICE Operation Management">
                                        MICE Operation Management
                                    </option>
                                    <option
                                        value="Research Methodology and Guidelines(Writhing Thesi)"
                                    >
                                        Research Methodology and
                                        Guidelines(Writhing Thesi)
                                    </option>
                                    <option
                                        value="Research Methodology and Guidelines(Writhing Thesis)"
                                    >
                                        Research Methodology and
                                        Guidelines(Writhing Thesis)
                                    </option>
                                    <option value="International Business 2B">
                                        International Business 2B
                                    </option>
                                    <option value="Inter. Cultural">
                                        Inter. Cultural
                                    </option>
                                    <option value="Conservation">
                                        Conservation
                                    </option>
                                    <option value="Landscape Design">
                                        Landscape Design
                                    </option>
                                    <option value="Development Economics">
                                        Development Economics
                                    </option>
                                    <option value="Diplomacy">Diplomacy</option>
                                    <option value="Film Production">
                                        Film Production
                                    </option>
                                    <option value="Fine Art Photography">
                                        Fine Art Photography
                                    </option>
                                    <option value="Integrative Design Project">
                                        Integrative Design Project
                                    </option>
                                    <option value="I Love U">I Love U</option>
                                    <option value="Analog and Digital Filters">
                                        Analog and Digital Filters
                                    </option>
                                    <option
                                        value="English for Traveling and Hospitality"
                                    >
                                        English for Traveling and Hospitality
                                    </option>
                                    <option
                                        value="Housekeeping Operation Management"
                                    >
                                        Housekeeping Operation Management
                                    </option>
                                    <option value="Criminal Justice Studies">
                                        Criminal Justice Studies
                                    </option>
                                    <option value="Digital Film Storytelling I">
                                        Digital Film Storytelling I
                                    </option>
                                    <option
                                        value="Food & Beverage Operation Management"
                                    >
                                        Food & Beverage Operation Management
                                    </option>
                                    <option value="Digital Photography">
                                        Digital Photography
                                    </option>
                                    <option value="ICT in Tourism Industry">
                                        ICT in Tourism Industry
                                    </option>
                                    <option value="Japanese for Hospitality A">
                                        Japanese for Hospitality A
                                    </option>
                                    <option value="Media Research Methodology">
                                        Media Research Methodology
                                    </option>
                                    <option value="Computer Graphic Design I">
                                        Computer Graphic Design I
                                    </option>
                                    <option value="Business Plan in Tourism">
                                        Business Plan in Tourism
                                    </option>
                                    <option value="Grammar and Reading III">
                                        Grammar and Reading III
                                    </option>
                                    <option value="Tourism Safety and Security">
                                        Tourism Safety and Security
                                    </option>
                                    <option value="Criminal Procedure II">
                                        Criminal Procedure II
                                    </option>
                                    <option
                                        value="English for Travelling and Tourism II"
                                    >
                                        English for Travelling and Tourism II
                                    </option>
                                    <option value="Agricultural Economics">
                                        Agricultural Economics
                                    </option>
                                    <option value="Electrical and Electricity">
                                        Electrical and Electricity
                                    </option>
                                    <option value="Web Developing with PHP">
                                        Web Developing with PHP
                                    </option>
                                    <option
                                        value="Hospitality and Tourism Marketing"
                                    >
                                        Hospitality and Tourism Marketing
                                    </option>
                                    <option value="Japanese for Hospitality B">
                                        Japanese for Hospitality B
                                    </option>
                                    <option value="Fundamental of Physic">
                                        Fundamental of Physic
                                    </option>
                                    <option
                                        value="Introduction to Computer (IT Essential)"
                                    >
                                        Introduction to Computer (IT Essential)
                                    </option>
                                    <option value="Computer Graphic Design II">
                                        Computer Graphic Design II
                                    </option>
                                    <option value="Core English 2B">
                                        "Core English 2B"
                                    </option>
                                    <option value=" Principle of Business">
                                        Principle of Business
                                    </option>
                                    <option value="ភាសាអង់គ្លេស">
                                        ភាសាអង់គ្លេស
                                    </option>
                                    <option value="Program Logic Control">
                                        Program Logic Control
                                    </option>
                                    <option
                                        value="Introduction to Internet of Think (IoT)"
                                    >
                                        Introduction to Internet of Think (IoT)
                                    </option>
                                    <option
                                        value="Microprocessors & Digital Design"
                                    >
                                        Microprocessors & Digital Design
                                    </option>
                                    <option
                                        value="Introduction Artificial Intelligence (AI)"
                                    >
                                        Introduction Artificial Intelligence
                                        (AI)
                                    </option>
                                    <option value="Introduction to Big Data">
                                        Introduction to Big Data
                                    </option>
                                    <option value="Introduction to Python">
                                        Introduction to Python
                                    </option>
                                    <option
                                        value="Content Planning & Storytelling I"
                                    >
                                        Content Planning & Storytelling I
                                    </option>
                                    <option value="Introduction to OOM & P">
                                        Introduction to OOM & P
                                    </option>
                                    <option value="Tourism Impact Management">
                                        Tourism Impact Management
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.Subject"
                                    class="text-error"
                                >
>>>>>>> main
                                    {{ form.errors.Subject }}
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                    <div class="mt-3 flex justify-end gap-4">
                        <button type="button" class="btn btn-warning" @click="oncloseModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
=======
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
>>>>>>> main
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
                <h2 class="text-2xl font-bold">ThesisCommittee Management</h2>
<<<<<<< HEAD
                <div class="mt-2 bg-base-100 px-2 pb-2 rounded-xl flex gap-2">
                    <div class="mt-auto">
                        <!-- <Link
=======
                <div class="flex gap-2 px-2 pb-2 mt-2 bg-base-100 rounded-xl">
                    <!-- <div class="mt-auto"> -->
                    <!-- <Link
>>>>>>> main
                            href="/thesisCommittee/"
                            class="p-2 text-white bg-yellow-600 rounded-md"
                        >
                            Back
                        </Link> -->
<<<<<<< HEAD
                        <button class="btn btn-primary align-bottom" @click="onOpenModal = true">
                            New
                        </button>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Academic Year</label>
                        <select v-model="filterForm.academic_year" class="select select-info w-full">
                            <option value="">All Years</option>
                            <option v-for="years in academic_options" :value="years">
                                {{ years }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Major</label>
                        <select v-model="filterForm.major" class="select select-info w-full">
                            <option value="">All Majors</option>
                            <option v-for="majors in major_options" :value="majors">
                                {{ majors }}
                            </option>
                        </select>
                    </div>

                    <!-- <div class="flex flex-col w-full">
                        <label class="label label-text">Committee Name</label>
                        <select v-model="filterForm.committee" class="select select-info w-full">
                            <option value="">All Committees</option>
                            <option v-for="committees in committee_options" :value="committees">
                                {{ committees }}
                            </option>
                        </select>
                    </div> -->

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Department</label>
                        <select v-model="filterForm.department" class="select select-info w-full">
                            <option value="">All Departments</option>
                            <option v-for="departments in department_options" :value="departments">
                                {{ departments }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Subject</label>
                        <select v-model="filterForm.subject" class="select select-info w-full">
                            <option value="">All Subjects</option>
                            <option v-for="subjects in subject_options" :value="subjects">
                                {{ subjects }}
                            </option>
                        </select>
                    </div>

                    <div class="mt-auto">
                        <button class="btn btn-warning" type="button" @click="onClearFilter">
                            Clear
                        </button>
=======
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
>>>>>>> main
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Major</label>
                        <select
                            v-model="filterForm.major"
                            class="w-full select select-info"
                        >
                            <option value="">All Majors</option>
                            <option
                                v-for="majors in major_options"
                                :value="majors"
                            >
                                {{ majors }}
                            </option>
                        </select>
                    </div>

                    <!-- <div class="flex flex-col w-full">
                        <label class="label label-text">Committee Name</label>
                        <select v-model="filterForm.committee" class="w-full select select-info">
                            <option value="">All Committees</option>
                            <option v-for="committees in committee_options" :value="committees">
                                {{ committees }}
                            </option>
                        </select>
                    </div> -->

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

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Subject</label>
                        <select
                            v-model="filterForm.subject"
                            class="w-full select select-info"
                        >
                            <option value="">All Subjects</option>
                            <option
                                v-for="subjects in subject_options"
                                :value="subjects"
                            >
                                {{ subjects }}
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
<<<<<<< HEAD
            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="text uppercase text-sm">
=======
            <div class="overflow-x-auto bg-base-100 rounded-xl">
                <table class="table">
                    <thead>
                        <tr class="text-sm uppercase text">
>>>>>>> main
                            <th>Id</th>
                            <th>Academic Year</th>
                            <th>Major</th>
                            <th>Committee</th>
                            <th>Department</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="thesisCommittees && thesisCommittees.data">
<<<<<<< HEAD
                        <tr v-for="(item, index) in thesisCommittees.data" :key="index">
=======
                        <tr
                            v-for="(item, index) in thesisCommittees.data"
                            :key="index"
                        >
>>>>>>> main
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Major }}</td>
                            <td>{{ item.Committee }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Subject }}</td>
                            <td>
<<<<<<< HEAD
                                <button type="button" @click="onEdit(item.id)" class="btn btn-warning mr-2">
                                    Edit
                                </button>
                                <button type="button" @click="onDelete(item.id)" class="btn btn-error">
=======
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
                                    <i class="fa-solid fa-trash-can"></i>
>>>>>>> main
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
<<<<<<< HEAD
                    <Link v-for="link in thesisCommittees.links" :href="link.url ?? '#'" class="join-item btn"
                        :class="{ 'btn-info': link.active }">
                    <span v-html="link.label"></span>
=======
                    <Link
                        v-for="link in thesisCommittees.links"
                        :href="link.url ?? '#'"
                        class="join-item btn"
                        :class="{ 'btn-info': link.active }"
                    >
                        <span v-html="link.label"></span>
>>>>>>> main
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
