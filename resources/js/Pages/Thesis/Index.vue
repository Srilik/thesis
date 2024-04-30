<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisType } from "@/types/thesisType";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisorType";
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
    thesisAdvisors: ThesisAdvisorType[];
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
    Thesis_No: props.filters?.Thesis_No ?? "",
    Thesis_Group: props.filters?.Thesis_Group ?? "",
    Academic_Year: props.filters?.Academic_Year ?? "",
    Department: props.filters?.Department ?? "",
    Major: props.filters?.Major ?? "",
    Year: props.filters?.Year ?? "",
    Batch: props.filters?.Batch ?? "",
    Session: props.filters?.Session ?? "",
    Organizaition: props.filters?.Organizaition ?? "",
    Organization_Type: props.filters?.Organization_Type ?? "",
    Location: props.filters?.Location ?? "",
    Organization_Phone: props.filters?.Organization_Phone ?? "",
    Title: props.filters?.Title ?? "",
    Title_Khmer: props.filters?.Title_Khmer ?? "",
    Objective: props.filters?.Objective ?? "",
    Objective_Khmer: props.filters?.Objective_Khmer ?? "",
    Summary: props.filters?.Summary ?? "",
    Submit_Date: props.filters?.Submit_Date ?? "",
    Teacher_id: props.filters?.Teacher_id ?? "",
    Defend_Date: props.filters?.Defend_Date ?? "",
    Book_Score: props.filters?.Book_Score ?? "",
    Defend_time: props.filters?.Defend_time ?? "",
    Submit_book: props.filters?.Submit_book ?? "",
    Building: props.filters?.Building ?? "",
    Room: props.filters?.Room ?? "",
});
watch(
    () => filterForm.data(),
    throttle(() => {
        console.log("log data");
        router.get(route("thesis.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only: ["thesis"],
            replace: true,
        });
    }, 500),
);
const onClearFilter = () => {
    filterForm.keyword = "";
    filterForm.Thesis_No = "";
    filterForm.Thesis_Group = "";
    filterForm.Academic_Year = "";
    filterForm.Department = "";
    filterForm.Major = "";
    filterForm.Year = "";
    filterForm.Batch = "";
    filterForm.Session = "";
    filterForm.Organizaition = "";
    filterForm.Organization_Type = "";
    filterForm.Location = "";
    filterForm.Organization_Phone = "";
    filterForm.Title = "";
    filterForm.Title_Khmer = "";
    filterForm.Objective = "";
    filterForm.Objective_Khmer = "";
    filterForm.Summary = "";
    filterForm.Submit_Date = "";
    filterForm.Teacher_id = "";
    filterForm.Defend_Date = "";
    filterForm.Book_Score = "";
    filterForm.Defend_time = "";
    filterForm.Submit_book = "";
    filterForm.Building = "";
    filterForm.Room = "";

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
                            <input v-model.number="form.Thesis_Group" type="number"
                                class="input input-primary w-full" />
                            <label class=" text-red-500 text-sm" v-if="form.errors.Thesis_Group">
                                {{ form.errors.Thesis_Group }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <!-- <input v-model="form.Academic_Year" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Academic_Year" class="input input-primary w-full">
                                <option value="">Select a Academic Year</option>
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
                            <label class="label text-red-500 text-sm" v-if="form.errors.Academic_Year">
                                {{ form.errors.Academic_Year }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Department</label>
                            <!-- <input v-model="form.Department" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Department" class="input input-primary w-full">
                                <option value="">Select a Department</option>
                                <!-- <option value="Architecture and Urbanism">Architecture and Urbanism</option>
                                <option value="Civil Engineering">Civil Engineering</option>
                                <option value="Computer Studies">Computer Studies</option>
                                <option value="Department of Research and Develop">Department of Research and Develop</option>
                                <option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option> -->
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
                            <label class="label text-red-500 text-sm" v-if="form.errors.Department">
                                {{ form.errors.Department }}
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Major</label>
                            <!-- <input v-model="form.Major" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Major" class="input input-primary w-full">
                                <option value="">Select a Major</option>
                                <!-- ARCHITECTURE -->
                                <option value="Architectural Design">Architectural Design</option>
                                <option value="Architecture and Urbanism">Architecture and Urbanism</option>
                                <option value="Interior Design">Interior Design  </option>  
                                <option value="Landscape Design">Landscape Design  </option>
                                <option value="Urban Planning">Urban Planning</option>
                                <!-- BUSINESS -->
                                <option value="Accounting">Accounting </option> 
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
                                <option value="Banking and Finance">Banking and Finance  </option>
                                <option value="Commercial Property and Real Estate">Commercial Property and Real Estate</option>
                                <option value="Development Economics">Development Economics  </option>
                                <option value="Investment and Risk Management">Investment and Risk Management</option>
                                <!-- ELECTRICAL -->
                                <option value="Automation and Control System">Automation and Control System</option>
                                <option value="Electricity">Electricity </option>
                                <option value="Electronics">Electronics</option>
                                <option value="Telecommunication">Telecommunication </option>
                                <!-- ENGLISH -->
                                <option value="Business English">Business English</option>
                                <option value="Educational Management and Teaching">Educational Management and Teaching</option>
                                <option value="English Communication">English Communication</option>
                                <option value="English for Business Affairs">English for Business Affairs</option>
                                <option value="English for International Relations">English for International Relations</option>
                                <option value="English for International Relations and Diplomacy">English for International Relations and Diplomacy</option>
                                <option value="English Translation">English Translation </option>
                                <!-- HOTEL -->
                                <option value="Hospitality and Tourism Management">Hospitality and Tourism Management</option> 
                                <!-- LAW -->
                                <option value="Commercial Law">Commercial Law</option>
                                <option value="Government and Public Administration">Government and Public Administration </option>
                                <option value="International Relation and Diplomacy">International Relation and Diplomacy</option>
                                <option value="Legal and Justice Studies">Legal and Justice Studies</option>
                            </select>
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
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
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
                            <!-- <input v-model="form.Organization_Type" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Organization_Type" class="input input-primary w-full">
                                <option value="">Select a Organization Type</option>
                                <option value="Government">Government</option>
                                <option value="Private">Private</option>
                                <option value="Non Government(NGO)">Non Government(NGO)</option>
                                <option value="Others">Others</option>
                            </select>

                            <label class="label text-red-500 text-sm" v-if="form.errors.Organization_Type">
                                {{ form.errors.Organization_Type }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Location</label>
                            <!-- <input v-model="form.Location" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Location" class="input input-primary w-full">
                                <option value="">Select a Location</option>
                                <option value="Siem Reap">Siem Reap</option>
                                <option value="Stung Treng">Stung Treng</option>
                                <option value="Prey Veng">Prey Veng</option>
                                <option value="Ratanakiri">Ratanakiri</option>
                                <option value="Pailin">Pailin</option>
                                <option value="Oddar Meanchey">Oddar Meanchey</option>
                                <option value="Kampong Som">Kampong Som</option>
                                <option value="Kampong Speu">Kampong Speu</option>
                                <option value="Kampong Thom">Kampong Thom</option>
                                <option value="Kampong Cham">Kampong Cham</option>
                                <option value="Preah Vihear">Preah Vihear</option>
                                <option value="Pursat">Pursat</option>
                                <option value="Kampot">Kampot</option>
                                <option value="Kandal">Kandal</option>
                                <option value="Koh Kong">Koh Kong</option>
                                <option value="Kep">Kep</option>
                                <option value="Kratie">Kratie</option>
                                <option value="Mondulkiri">Mondulkiri</option>   
                                <option value="Phnom Penh">Phnom Penh</option>
                                <option value="Banteay Meanchey">Banteay Meanchey</option>
                                <option value="Battambang">Battambang</option>
                                <option value="Kampong Chhnang">Kampong Chhnang</option>

                            </select>
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
                            <textarea v-model="form.Objective_Khmer"
                                class="textarea textarea-primary w-full"></textarea>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <textarea v-model="form.Summary" class="textarea textarea-primary w-full"></textarea>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_Date</label>
                            <input v-model="form.Submit_Date" type="date" class="input input-primary w-full" />
                            <label class="label text-red-500 text-sm" v-if="form.errors.Submit_Date">
                                {{ form.errors.Submit_Date }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Teacher_id</label>
                            <!-- <input v-model="form.Teacher_id" type="text" class="input input-primary w-full" /> -->
                            <select v-model="form.Teacher_id" class="select select-primary w-full"
                                :class="{ 'select-error': form.errors.Teacher_id }">
                                <option :value="item.id" v-for="(item, index) in thesisAdvisors">
                                    {{ item.Advisor }}
                                </option>
                            </select>
                            <label class="label text-red-500 text-sm" v-if="form.errors.Teacher_id">
                                {{ form.errors.Teacher_id }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_Date</label>
                            <input v-model="form.Defend_Date" type="date" class="input input-primary w-full" />
                            <label class="label text-red-500 text-sm" v-if="form.errors.Defend_Date">
                                {{ form.errors.Defend_Date }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Book_Score</label>
                            <input v-model.number="form.Book_Score" type="number" class="input input-primary w-full" />
                            <label class="label text-red-500 text-sm" v-if="form.errors.Book_Score">
                                {{ form.errors.Book_Score }}
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_time</label>
                            <input v-model="form.Defend_time" type="time" class="input input-primary w-full" />
                            <label class="label text-red-500 text-sm" v-if="form.errors.Defend_time">
                                {{ form.errors.Defend_time }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_book</label>
                            <input v-model="form.Submit_book" type="date" class="input input-primary w-full" />
                            <label class="label text-red-500 text-sm" v-if="form.errors.Submit_book">
                                {{ form.errors.Submit_book }}
                            </label>
                        </div>

                        <div class="flex flex-col w-full">
                            <label class="label">Building</label>
                            <!-- <input v-model="form.Building" type="text" class="input input-primary w-full" /> -->
                            <select v-model=form.Building class="input input-primary w-full">
                                <option value="">Select a Building</option>
                                <option value="G"> G </option>
                                <option value="G-B"> G-B </option>
                                <option value="H"> H </option>
                                <option value="H-B"> H-B </option>
                                <option value="I"> I </option>
                                <option value="I-G"> I-G </option>
                                <option value="L"> L </option>
                                <option value="L-G"> L-G </option>
                                <option value="N"> N </option>
                            </select>
                            <label class="label text-red-500 text-sm" v-if="form.errors.Building">
                                {{ form.errors.Building }}
                            </label>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Room</label>
                            <!-- <input v-model="form.Room" type="text" class="input input-primary w-full" /> -->

                            <select v-model="form.Room" class="input input-primary w-full">
                                <option value="">Select a Room</option>
                                <option value="G-101"> G-101 </option> 
                                <option value="G-102"> G-102 </option> 
                                <option value="G-104"> G-104 </option> 
                                <option value="G-106"> G-106 </option> 
                                <option value="G-108"> G-108 </option> 
                                <option value="G-109"> G-109 </option> 
                                <option value="G-110"> G-110 </option> 
                                <option value="G-111"> G-111 </option> 
                                <option value="G-112"> G-112 </option> 
                                <option value="G-201"> G-201 </option>
                                <option value="G-202"> G-202 </option>
                                <option value="G-203"> G-203 </option>
                                <option value="G-204"> G-204 </option>
                                <option value="G-205"> G-205 </option>
                                <option value="G-206a"> G-206a</option>
                                <option value="G-206b"> G-206b </option> 
                                <option value="G-207"> G-207 </option>
                                <option value="G-209"> G-209 </option>
                                <option value="G-211"> G-211 </option>
                                <option value="G-212"> G-212 </option>
                                <option value="G-214"> G-214 </option>
                                <option value="G-216"> G-216 </option>
                                <option value="G-301"> G-301 </option>
                                <option value="G-302"> G-302 </option>
                                <option value="G-303"> G-303 </option>
                                <option value="G-304"> G-304 </option>
                                <option value="G-305a"> G-305a</option>
                                <option value="G-305b"> G-305b</option>
                                <option value="G-307a"> G-307a</option>
                                <option value="G-306"> G-306 </option>
                                <option value="G-307b"> G-307b</option>
                                <option value="G-308"> G-308 </option>
                                <option value="G-309"> G-309 </option>
                                <option value="G-310"> G-310 </option>
                                <option value="G-311"> G-311 </option>
                                <option value="G-312"> G-312 </option>
                                <option value="G-314"> G-314 </option>
                                <option value="G-316"> G-316 </option>
                                <option value="G-401"> G-401 </option>
                                <option value="G-402"> G-402 </option>
                                <option value="G-403"> G-403 </option>
                                <option value="G-404"> G-404 </option>
                                <option value="G-405a"> G-405a</option>
                                <option value="G-405b"> G-405b</option>
                                <option value="G-406"> G-406 </option>
                                <option value="G-407a"> G-407a</option>
                                <option value="G-407b"> G-407b</option>
                                <option value="G-408"> G-408 </option>
                                <option value="G-409"> G-409 </option>
                                <option value="G-410"> G-410 </option>
                                <option value="G-411"> G-411 </option>
                                <option value="G-412"> G-412 </option> 
                                <option value="G-414"> G-414 </option> 
                                <option value="G-416"> G-416 </option>
                                <option value="G-501"> G-501 </option>  
                                <option value="G-502"> G-502  </option>
                                <option value="G-503"> G-503 </option>  
                                <option value="G-B01"> G-B01 </option> 
                                <option value="G-B02"> G-B02 </option> 
                                <option value="G-B06"> G-B06 </option> 
                                <option value="G-B08"> G-B08 </option> 
                                <option value="G-B09"> G-B09 </option> 
                                <option value="G-B10"> G-B10 </option> 
                                <option value="G-B12"> G-B12 </option> 
                                <option value="G-B13"> G-B13 </option> 
                                <option value="H-103A"> H-103A </option>
                                <option value="H-105A"> H-105A </option>  
                                <option value="H-106"> H-106 </option> 
                                <option value="H-107"> H-107 </option> 
                                <option value="H-108"> H-108 </option> 
                                <option value="H-201"> H-201 </option> 
                                <option value="H-202"> H-202 </option> 
                                <option value="H-203"> H-203 </option> 
                                <option value="H-204"> H-204 </option> 
                                <option value="H-205"> H-205 </option> 
                                <option value="H-206"> H-206 </option> 
                                <option value="H-207"> H-207 </option> 
                                <option value="H-208"> H-208 </option> 
                                <option value="H-301"> H-301 </option> 
                                <option value="H-302"> H-302 </option> 
                                <option value="H-303"> H-303 </option> 
                                <option value="H-304"> H-304 </option> 
                                <option value="H-B01"> H-B01 </option> 
                                <option value="H-B02"> H-B02 </option> 
                                <option value="H-B03"> H-B03 </option> 
                                <option value="H-B04"> H-B04 </option>
                                <option value="H-B05"> H-B05 </option>  
                                <option value="H-B07"> H-B07 </option> 
                                <option value="I-101"> I-101 </option> 
                                <option value="I-102"> I-102 </option> 
                                <option value="I-103"> I-103 </option> 
                                <option value="I-104"> I-104 </option> 
                                <option value="I-G01"> I-G01 </option> 
                                <option value="I-G02"> I-G02 </option> 
                                <option value="I-G03"> I-G03 </option> 
                                <option value="I-G04"> I-G04 </option> 
                                <option value="L-106"> L-106 </option> 
                                <option value="L-107"> L-107 </option> 
                                <option value="L-108"> L-108 </option> 
                                <option value="L-G01"> L-G01 </option> 
                                <option value="L-G02"> L-G02 </option> 
                                <option value="L-G03"> L-G03 </option> 
                                <option value="L-G04"> L-G04 </option> 
                                <option value="L-G05"> L-G05 </option> 
                                <option value="L-G06"> L-G06  </option> 
                                <option value="N1"> N1  </option>
                                <option value="N2"> N2  </option>
                                <option value="N3"> N3  </option>
                                <option value="N4"> N4  </option>
                                <option value="N5"> N5  </option>
                                <option value="N6"> N6  </option>
                                <option value="N7"> N7  </option>
                                <option value="N8"> N8  </option>
                                <option value="N9"> N9  </option>
                                <option value="N10"> N10 </option>
                                <option value="N11"> N11 </option>
                                <option value="N12"> N12 </option>
                                <option value="N13"> N13 </option>
                                <option value="N14"> N14 </option>
                                <option value="N15"> N15 </option>
                                <option value="N16"> N16 </option>
                                <option value="N17"> N17 </option>
                                <option value="N18"> N18 </option>
                                <option value="N19"> N19 </option>
                                <option value="N20"> N20 </option>
                                <option value="N21"> N21 </option>
                                <option value="N22"> N22 </option>
                                <option value="N23"> N23 </option>
                                <option value="N24"> N24 </option>
                                <option value="N25"> N25 </option>
                                <option value="N26"> N26 </option>
                                <option value="N27"> N27 </option>
                                <option value="N28"> N28 </option>
                                <option value="N29"> N29 </option>
                                <option value="N30"> N30 </option>
                                <option value="N31"> N31 </option>
                                <option value="N32"> N32 </option>
                                <option value="N33"> N33 </option>
                                <option value="N34"> N34 </option>
                                <option value="N35"> N35 </option>
                                <option value="N36"> N36 </option>
                                <option value="N37"> N37 </option>
                                <option value="N38"> N38 </option>
                                <option value="N39"> N39 </option>
                                <option value="N40"> N40 </option>
                                <option value="N41"> N41 </option>
                                <option value="N42"> N42 </option>
                                <option value="N43"> N43 </option>
                                <option value="N44"> N44 </option>
                                <option value="N45"> N45 </option>
                                <option value="N46"> N46</option> 
                                <option value="N47"> N47 </option>
                                <option value="N48"> N48 </option>
                                <option value="N49"> N49 </option>
                                <option value="N50"> N50 </option>                                
                            </select>
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
            <div class="mb-3">
                <h2 class="text-2xl font-bold">ThesisDetail Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <input v-model="filterForm.keyword" type="text" placeholder="Search..."
                            class="input input-info w-full" />
                        <!-- <select v-model="form.Teacher_id" class="select select-info w-full">
                            <option value="">All Lecturers</option>
                            <option :value="item.id" v-for="(item, index) in thesisAdvisors">
                                {{ item.Advisor }}
                            </option>
                        </select> -->

                        <!-- :class="{ 'select-error': form.errors.Teacher_id }"  -->
                        <select v-model="form.Teacher_id" class="select select-info w-full">   
                        <option
                                    v-for="advisors in thesisAdvisors"
                                    :value="advisors"
                                >
                                    {{ advisors }}
                                </option>
                            </select>
                        <button class="btn btn-warning" type="button" @click="onClearFilter">Clear</button>
                    </div>
                </div>
            </div>
            <!-- <div class="mt-4 bg-base-100 p-2 rounded-xl">
                <table class="table-base table-zebra"> -->
            <!-- <div class="bg-base-100 rounded-xl overflow-x-auto">
                    <table class="table-base table-lg"> -->
            <div class="p-2 bg-white rounded-lg dark:bg-gray-800">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Thesis_No</th>
                                <th>Thesis_Group</th> -->
                            <th>Academic_Year</th>
                            <th>Department</th>
                            <th>Major</th>
                            <th>Year</th>
                            <!-- <th>Batch</th> -->
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
                            <!-- <td>{{ item.Thesis_No }}</td>
                                <td>{{ item.Thesis_Group }}</td> -->
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Major }}</td>
                            <td>{{ item.Year }}</td>
                            <!-- <td>{{ item.Batch }}</td> -->
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
                    <Link v-for="link in thesis.links" :href="link.url ?? '#'" class="join-item btn"
                        :class="{ 'btn-info': link.active }">
                    <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
