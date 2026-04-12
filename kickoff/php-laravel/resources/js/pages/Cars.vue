<script setup lang="ts">

import axios from 'axios'
import { ref, computed } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, usePage, router} from '@inertiajs/vue3'

const { props } = usePage()
const cars = ref(props.cars as Array<any>)


const search = ref('');
const filteredCars = computed(() => {
    if (!search.value) return cars.value;
    return cars.value.filter(car =>
        (car.name + " " + car.registration_number + (car.is_registered ? "Yes" : "No")).toLowerCase().includes(search.value.toLowerCase())
    );
});

function editCar(id: number) {
    router.get(`/car/${id}`)
}

async function deleteCar(carId: number) {
  if (!confirm('Are you sure you want to delete this car?')) return
  try {
    await axios.delete(`/car/${carId}`)
        cars.value = cars.value.filter((c: any) => c.id !== carId)
  } catch (error: any) {
    console.error('Failed to delete car:', error.response?.data || error.message)
  }
}

</script>

<template>
<AppLayout>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cars</h2>
        <div class="d-flex align-items-center gap-2">
        <Link href="/car" class="btn btn-primary">+ Add New Car</Link>
        <div class="input-group w-auto">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" v-model="search" id="partsSearch" class="form-control form-control-sm" placeholder="Search parts...">
        </div>
        </div>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Is Registered</th>
                <th scope="col">Parts</th>
                <th scope="col" class="text-center" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            <tr v-for="car in filteredCars" :key="car.id">
                <td>{{ car.id }}</td>
                <td>{{ car.name }}</td>
                <td>{{ car.registration_number }}</td>
                <td>
                      <span v-if="car.is_registered" class="badge bg-success">Yes</span>
                      <span v-else class="badge bg-secondary">No</span>
                </td>
                <td>{{ car.parts.length }}</td>
                <td class="text-center">
                    <button type="submit" class="btn btn-sm btn-warning me-1"
                            @click="editCar(car.id)">
                            Edit
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger"
                             @click="deleteCar(car.id)">
                            Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
      </AppLayout>
</template>
