<script setup lang="ts">

import axios from 'axios'
import { ref, computed } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue';

const { props } = usePage()
const parts = ref(props.parts as Array<any>)

const search = ref('');
const filteredParts = computed(() => {
    if (!search.value) return parts.value;
    return parts.value.filter(part =>
        (part.name+" "+part.serialnumber+ " "+part.car.name + part.car.registration_number).toLowerCase().includes(search.value.toLowerCase())
    );
});

function editCar(id: number) {
    router.get(`/car/${id}`)
}

function editPart(id: number) {
    router.get(`/part/${id}`)
}

async function deletePart(partId: number) {
  if (!confirm('Are you sure you want to delete this part?')) return
  try {
    await axios.delete(`/part/${partId}`)
    parts.value = parts.value.filter((c: any) => c.id !== partId)
  } catch (error: any) {
    console.error('Failed to delete part:', error.response?.data || error.message)
  }
}
</script>

<template>
      <AppLayout>
        
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Parts</h2>

        <div class="input-group w-auto">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" v-model="search" id="partsSearch" class="form-control form-control-sm" placeholder="Search parts...">
        </div>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Car</th>
                <th scope="col">Car regNum</th>
                <th scope="col" class="text-center" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="part in filteredParts" :key="part.id">
                <td>{{ part.id }}</td>
                <td>{{ part.name }}</td>
                <td>{{ part.serialnumber }}</td>
                <td>{{ part.car.name }}</td>
                <td>{{ part.car.registration_number }}</td>
                <td class="text-center">
                    <button type="submit" class="btn btn-sm btn-warning me-1"
                            @click="editPart(part.id)">
                            Edit
                    </button>
                    <button @click="deletePart(part.id)" type="submit" class="btn btn-sm btn-danger">
                            Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


      </AppLayout>
</template>
