<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisType } from "@/types/thesisType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { useForm } from "@inertiajs/vue3";
import { MoveLeft } from "lucide-vue-next";
import Swal from "sweetalert2";

import Button from 'primevue/button'
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-blue/theme.css';

const props = defineProps<{
    thesisAdvisors: ThesisAdvisorType[];
    // thesisAdvisors:{
    //     id: number;
    //     Advisor: string;
    // }[];
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
            <!-- <h2 class="text-2xl font-bold">Create a Thesis</h2> -->
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl flex justify-between">
                    <Link :href="route('thesis.index')" class="btn btn-info flex items-center">
                        <MoveLeft class="w-5 h-5 mr-1" />
                        Back
                    </Link>
                    <h2 class="p-2 flex justify-between text-2xl font-bold uppercase">Create a Thesis</h2>  
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
                            <input v-model.number="form.Thesis_No" type="number" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Thesis_No }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Thesis_No">
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_Group</label>
                            <input v-model.number="form.Thesis_Group" type="number" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Thesis_Group }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Thesis_Group">
                                {{ form.errors.Thesis_Group }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <!-- <input v-model="form.Academic_Year" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" /> -->
                            <select v-model="form.Academic_Year" class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Academic_Year">
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Department</label>
                            <!-- <input v-model="form.Department" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Department }" /> -->
                            <select v-model="form.Department" class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Department">
                                {{ form.errors.Department }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Major</label>
                            <!-- <input v-model="form.Major" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Major }" /> -->
                            <select v-model="form.Major" class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Major">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Year</label>
                            <!-- <input v-model="form.Year" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Year }" /> -->
                            <select v-model="form.Year" class="input input-info w-full">
                                <option value="">Select a Year</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            <div class="text-red-500 text-sm" v-if="form.errors.Year">
                                {{ form.errors.Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Batch</label>
                            <input v-model.number="form.Batch" type="number" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Batch }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Batch">
                                {{ form.errors.Batch }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Session</label>
                            <!-- <input v-model="form.Session" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Session }" /> -->
                            <select v-model="form.Session" class="input input-info w-full">
                                <option value="">Select a Session</option>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
                            </select>
                            <div class="text-red-500 text-sm" v-if="form.errors.Session">
                                {{ form.errors.Session }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organizaition</label>
                            <input v-model="form.Organizaition" type="text" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organizaition }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Organizaition">
                                {{ form.errors.Organizaition }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Type</label>
                            <!-- <input v-model="form.Organization_Type" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organization_Type }" /> -->
                            <select v-model="form.Organization_Type" class="input input-info w-full">
                                <option value="">Select a Organization Type</option>
                                <option value="Government">Government</option>
                                <option value="Private">Private</option>
                                <option value="Non Government(NGO)">Non Government(NGO)</option>
                                <option value="Others">Others</option>
                            </select>
                            <div class="text-red-500 text-sm" v-if="form.errors.Organization_Type">
                                {{ form.errors.Organization_Type }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Title</label>
                            <textarea 
                                v-model="form.Title" class="input input-info w-full h-full"
                                :class="{ 'input-error': form.errors.Title }">
                            </textarea>
                            <div class="text-red-500 text-sm" v-if="form.errors.Title">
                                {{ form.errors.Title }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title_Khmer</label>
                            <textarea 
                                v-model="form.Title_Khmer" class="input input-info w-full h-full"
                                :class="{ 'input-error': form.errors.Title_Khmer }">
                            </textarea>
                            <div class="text-red-500 text-sm" v-if="form.errors.Title_Khmer">
                                {{ form.errors.Title_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective</label>
                            <textarea 
                                v-model="form.Objective" class="input input-info w-full h-full"
                                :class="{ 'input-error': form.errors.Objective }">
                            </textarea>
                            <div class="text-red-500 text-sm" v-if="form.errors.Objective">
                                {{ form.errors.Objective }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective_Khmer</label>
                            <textarea 
                                v-model="form.Objective_Khmer" class="input input-info w-full h-full"
                                :class="{ 'input-error': form.errors.Objective_Khmer }">
                            </textarea>
                            <div class="text-red-500 text-sm" v-if="form.errors.Objective_Khmer">
                                {{ form.errors.Objective_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <textarea 
                                v-model="form.Summary" class="input input-info w-full h-full"
                                :class="{ 'input-error': form.errors.Summary }">
                            </textarea>
                            <div class="text-red-500 text-sm" v-if="form.errors.Summary">
                                {{ form.errors.Summary }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Location</label>
                            <!-- <input v-model="form.Location" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Location }" /> -->
                            <select v-model="form.Location" class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Location">
                                {{ form.errors.Location }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Phone</label>
                            <input v-model.number="form.Organization_Phone" type="number" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Organization_Phone }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Organization_Phone">
                                {{ form.errors.Organization_Phone }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_Date</label>
                            <input v-model="form.Submit_Date" type="datetime-local" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_Date }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Submit_Date">
                                {{ form.errors.Submit_Date }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Teacher_id</label>
                            <!-- <input v-model="form.Teacher_id" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Teacher_id }" /> -->
                            <select v-model="form.Teacher_id" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Teacher_id }">
                                <option value="">Select a Advisor</option>
                                <option v-for="(item, index) in thesisAdvisors" :value="item.id">
                                    {{ item.Advisor }}
                                </option>
                            </select>
                            <div class="text-red-500 text-sm" v-if="form.errors.Teacher_id">
                                {{ form.errors.Teacher_id }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_Date</label>
                            <input v-model="form.Defend_Date" type="date" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_Date }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Defend_Date">
                                {{ form.errors.Defend_Date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row mt-4">
                        <div class="flex flex-col w-full">
                            <label class="label">Book_Score</label>
                            <input v-model.number="form.Book_Score" type="number" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Book_Score }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Book_Score">
                                {{ form.errors.Book_Score }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_time</label>
                            <input v-model="form.Defend_time" type="time" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_time }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Defend_time">
                                {{ form.errors.Defend_time }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_book</label>
                            <input v-model="form.Submit_book" type="datetime-local" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_book }" />
                            <div class="text-red-500 text-sm" v-if="form.errors.Submit_book">
                                {{ form.errors.Submit_book }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Building</label>
                            <!-- <input v-model="form.Building" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Building }" /> -->
                            <select v-model=form.Building class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Building">
                                {{ form.errors.Building }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Room</label>
                            <!-- <input v-model="form.Room" class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Room }" /> -->
                            <select v-model="form.Room" class="input input-info w-full">
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
                            <div class="text-red-500 text-sm" v-if="form.errors.Room">
                                {{ form.errors.Room }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                    <Button class="btn btn-info" @click="onSave">
                        <i class="pi pi-save"></i> Save
                    </Button>
                    </div>
                </form>
            </div>
        </div>
    </App>
</template>