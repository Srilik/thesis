<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

// Define the Group type
interface Group {
    group_id: number;
    group_name: string;
}

const groups = ref<Group[]>([]);
const newGroupName = ref<string>("");
const editingGroup = ref<Group | null>(null);
const editingGroupName = ref<string>("");

const fetchGroups = async () => {
    try {
        const response = await axios.get("/groupThesis");
        groups.value = response.data;
    } catch (error) {
        console.error("Error fetching groups:", error);
    }
};

const createGroup = async () => {
    if (!newGroupName.value.trim()) return alert("Group name is required.");
    try {
        await axios.post("/groupThesis", { group_name: newGroupName.value });
        newGroupName.value = "";
        fetchGroups();
    } catch (error) {
        console.error("Error creating group:", error);
    }
};

const editGroup = (group: Group) => {
    editingGroup.value = group;
    editingGroupName.value = group.group_name;
};

const updateGroup = async () => {
    if (!editingGroup.value) return;
    if (!editingGroupName.value.trim()) return alert("Group name is required.");
    try {
        await axios.put(`/groupThesis/${editingGroup.value.group_id}`, {
            group_name: editingGroupName.value,
        });
        editingGroup.value = null;
        editingGroupName.value = "";
        fetchGroups();
    } catch (error) {
        console.error("Error updating group:", error);
    }
};

const deleteGroup = async (id: number) => {
    if (!confirm("Are you sure you want to delete this group?")) return;
    try {
        await axios.delete(`/groupThesis/${id}`);
        fetchGroups();
    } catch (error) {
        console.error("Error deleting group:", error);
    }
};

const cancelEdit = () => {
    editingGroup.value = null;
    editingGroupName.value = "";
};

onMounted(fetchGroups);
</script>

<template>
    <App>
        <div class="group-theses-container">
            <h1 class="text-2xl font-bold mb-4">Group Theses</h1>
            <div class="mb-4">
                <input
                    v-model="newGroupName"
                    placeholder="Enter group name"
                    class="border px-3 py-2 rounded"
                    type="text"
                />
                <button
                    @click="createGroup"
                    class="bg-blue-500 text-white px-4 py-2 rounded ml-2"
                >
                    Add Group
                </button>
            </div>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">
                            Group Name
                        </th>
                        <th class="border border-gray-300 px-4 py-2">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="group in groups" :key="group.group_id">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ group.group_id }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ group.group_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <button
                                @click="editGroup(group)"
                                class="text-yellow-500 mr-2"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteGroup(group.group_id)"
                                class="text-red-500"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Modal for Editing -->
            <div
                v-if="editingGroup"
                class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white p-6 rounded">
                    <h2 class="text-xl mb-4">Edit Group</h2>
                    <input
                        v-model="editingGroupName"
                        placeholder="Group Name"
                        class="border px-3 py-2 rounded mb-4"
                        type="text"
                    />
                    <div>
                        <button
                            @click="updateGroup"
                            class="bg-blue-500 text-white px-4 py-2 rounded mr-2"
                        >
                            Save
                        </button>
                        <button
                            @click="cancelEdit"
                            class="bg-gray-500 text-white px-4 py-2 rounded"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<style scoped>
.modal {
    z-index: 1000;
}
</style>
