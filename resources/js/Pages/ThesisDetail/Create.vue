<script setup>
import { ref } from 'vue';
// const thesisDetailName = ref()
</script>

<template>
    <div class="container p-4 px-8 mx-auto mt-6 border rounded-xl  bg-gray-200">
        <!-- md:text-sm -->
        <h2 class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600 xl:text-teal-600">Create ThesisDetail</h2>

        <div class="flex flex-col gap-4 mt-4">
            <!-- {{ thesisDetailName }} -->
            <!-- form in here -->
            <div class="flex flex-col gap-2 lg:flex-row">                    
                <div class="flex flex-col w-full">
                    <label>Thesis_No</label>
                    <input v-model="Thesis_No" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Student_ID</label>
                    <input v-model="Student_ID" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Phone</label>
                    <input v-model="Phone" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Defend</label>
                    <input v-model="Defend" type="text" class="p-2 rounded-md">
                </div>
            </div>
            <div class="flex flex-col gap-2 lg:flex-row">                        
                <div class="flex flex-col w-full">
                    <label>Pass_State</label>
                    <input v-model="Pass_State" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Issue_Tem_Certificate</label>
                    <input v-model="Issue_Tem_Certificate" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Other</label>
                    <input v-model="Other" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Hardwork</label>
                    <input v-model="Hardwork" type="text" class="p-2 rounded-md">
                </div>
            </div>
            <div class="flex flex-col gap-2 lg:flex-row">                    
                <div class="flex flex-col w-full">
                    <label>Charateristic</label>
                    <input v-model="Charateristic" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Remark</label>
                    <input v-model="Remark" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Result</label>
                    <input v-model="Result" type="text" class="p-2 rounded-md">
                </div>
            </div>
            <div class="mt-2 flex justify-end">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <div class="flex justify-end">
                <button class="p-2 text-white bg-blue-600 rounded-lg active:bg-blue-800" type="submit">CREATE</button>
            </div>
        </div>
    </div>  
</template>