<script setup>
import { ref } from 'vue';
</script>

<template>
    <div class="container p-4 px-8 mx-auto mt-6 border rounded-xl  bg-gray-200">
        <!-- md:text-sm -->
        <h2 class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600 xl:text-teal-600">Create ThesisCommittee</h2>

        <div class="flex flex-col gap-4 mt-4">
            <!-- form in here -->
            <div class="flex flex-col gap-2 lg:flex-row">                    
                <div class="flex flex-col w-full">
                    <label>Academic_Year</label>
                    <input v-model="Academic_Year" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Major</label>
                    <input v-model="Major" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Committee</label>
                    <input v-model="Committee" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Department</label>
                    <input v-model="Department" type="text" class="p-2 rounded-md">
                </div>
                <div class="flex flex-col w-full">
                    <label>Subject</label>
                    <input v-model="Subject" type="text" class="p-2 rounded-md">
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