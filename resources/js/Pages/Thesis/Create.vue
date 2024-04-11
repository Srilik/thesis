<script setup>
import { ref } from 'vue';
</script>
<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a Thesis</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesis.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />Back</Link>
                </div>
            </div>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="number">Thesis_No</label>
                            <input v-model.number="form.Thesis_No" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Thesis_No }" />
                            <div v-if="form.errors.Thesis_No" class="text-error">
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="number">Thesis_Group</label>
                            <input v-model.number="form.Thesis_Group" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Thesis_Group }" />
                            <div v-if="form.errors.Thesis_Group" class="text-error">
                                {{ form.errors.Thesis_Group }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <input v-model="form.Academic_Year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" />
                            <div v-if="form.errors.Academic_Year" class="text-error">
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Department</label>
                            <input v-model="form.Department" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Department }" />
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
                            </div>
                        </div>    
                        <div class="flex flex-col w-full">
                            <label class="label">Major</label>
                            <input v-model="form.Major" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Major }" />
                            <div v-if="form.errors.Major" class="text-error">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
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
                            <!-- <input v-model="form.Year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Year }" /> -->
                            <div v-if="form.errors.Year" class="text-error">
                                {{ form.errors.Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="number">Batch</label>
                            <input v-model.number="form.Batch" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Batch }" />
                            <div v-if="form.errors.Batch" class="text-error">
                                {{ form.errors.Batch }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Session</label>
                            <select v-model="form.Session" class="input input-primary w-full">
                                <option value="">Select a Session</option>
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="evening">Evening</option>
                            </select>
                            <!-- <input v-model="form.Session" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Session }" /> -->
                            <div v-if="form.errors.Session" class="text-error">
                                {{ form.errors.Session }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organizaition</label>
                            <input v-model="form.Organizaition" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Organizaition }" />
                            <div v-if="form.errors.Organizaition" class="text-error">
                                {{ form.errors.Organizaition }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Type</label>
                            <input v-model="form.Organization_Type" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Organization_Type }" />
                            <div v-if="form.errors.Organization_Type" class="text-error">
                                {{ form.errors.Organization_Type }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Location</label>
                            <input v-model="form.Location" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Location }" />
                            <div v-if="form.errors.Location" class="text-error">
                                {{ form.errors.Location }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Phone</label>
                            <input v-model="form.Organization_Phone" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Organization_Phone }" />
                            <div v-if="form.errors.Organization_Phone" class="text-error">
                                {{ form.errors.Organization_Phone }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title</label>
                            <input v-model="form.Title" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Title }" />
                            <div v-if="form.errors.Title" class="text-error">
                                {{ form.errors.Title }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title_Khmer</label>
                            <input v-model="form.Title_Khmer" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Title_Khmer }" />
                            <div v-if="form.errors.Title_Khmer" class="text-error">
                                {{ form.errors.Title_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective</label>
                            <input v-model="form.Objective" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Objective }" />
                            <div v-if="form.errors.Objective" class="text-error">
                                {{ form.errors.Objective }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Objective_Khmer</label>
                            <input v-model="form.Objective_Khmer" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Objective_Khmer }" />
                            <div v-if="form.errors.Objective_Khmer" class="text-error">
                                {{ form.errors.Objective_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <input v-model="form.Summary" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Summary }" />
                            <div v-if="form.errors.Summary" class="text-error">
                                {{ form.errors.Summary }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label class="label">Submit_Date</label>
                            <input v-model="form.Submit_Date" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Submit_Date }" />
                            <div v-if="form.errors.Submit_Date" class="text-error">
                                {{ form.errors.Submit_Date }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Teacher Id</label>
                            <input v-model="form.Teacher_id" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Teacher_id }" />
                            <!-- <select 
                                v-model="form.Teacher_id" class="select select-primary w-full"
                                :class="{ 'select-error': form.errors.Teacher_id }" >
                                <option
                                    :value="item.id"
                                    v-for="(item, index) in thesisAdvisors">
                                    {{ item.Advisor }}
                                </option>
                            </select> -->

                            <div v-if="form.errors.Teacher_id" class="text-error">
                                {{ form.errors.Teacher_id }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_Date</label>
                            <input v-model="form.Defend_Date" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Defend_Date }" />
                            <div v-if="form.errors.Defend_Date" class="text-error">
                                {{ form.errors.Defend_Date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Book_Score</label>
                            <input v-model="form.Book_Score" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Book_Score }" />
                            <div v-if="form.errors.Book_Score" class="text-error">
                                {{ form.errors.Book_Score }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_time</label>
                            <input v-model="form.Defend_time" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Defend_time }" />
                            <div v-if="form.errors.Defend_time" class="text-error">
                                {{ form.errors.Defend_time }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_book</label>
                            <input v-model="form.Submit_book" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Submit_book }" />
                            <div v-if="form.errors.Submit_book" class="text-error">
                                {{ form.errors.Submit_book }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Building</label>
                            <input v-model="form.Building" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Building }" />
                            <div v-if="form.errors.Building" class="text-error">
                                {{ form.errors.Building }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Room</label>
                            <input v-model="form.Room" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Room }" />
                            <div v-if="form.errors.Room" class="text-error">
                                {{ form.errors.Room }}
                            </div>
                        </div>
                    </div>   
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </App>

</template>