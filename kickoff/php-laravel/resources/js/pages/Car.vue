<script setup lang="ts">

import axios from 'axios'
import { ref, watch } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue';

const { props } = usePage()
const car = ref(props.car || {name:"", registration_number:"", is_registered:false, parts:[]})

const errorMessage = ref(false)

const isEdit = ref(!!(car?.value?.id) || false)
const currentCarId = ref(car?.value?.id || null)

const addingNewPart = ref(false)
const editingPart = ref(false)
const selectedPart = ref(null)

const form = useForm({
  name: car?.value?.name || '',
  registration_number: car?.value?.registration_number || '',
  is_registered: car?.value?.is_registered == 1 || false,
})

const formPart = useForm({
  name: '',
  serialnumber: '',
  car_id: 0,
})

async function submit() {
    if (isEdit.value && currentCarId.value) {
        try {
            errorMessage.value = "";

            const payload = {
              name: form.name,
              registration_number: form.registration_number,
              is_registered: form.is_registered,
            }

            await axios.put(`/car/${currentCarId.value}`, payload)

        } catch (error: any) {
            errorMessage.value = ('Failed to update car:', error.response?.data?.message || error.message);
        }

    } else {
        try {
            errorMessage.value = "";
            const payload = {
              name: form.name,
              registration_number: form.registration_number,
              is_registered: form.is_registered,
            }

            const response =  await axios.post(`/car`, payload)
            isEdit.value = true
            currentCarId.value = response.data.car_id

        } catch (error: any) {
            errorMessage.value = ('Failed to add new car:', error.response?.data?.message || error.message)
        }


    }
}

function toggleNewPart() {
  formPart.car_id = currentCarId.value
  formPart.name = ""
  formPart.serialnumber = ""
  selectedPart.value = null
  editingPart.value = false;
  addingNewPart.value = true;
}

function editPart(part) {
    selectedPart.value = part
    addingNewPart.value = false;
    editingPart.value = true;
    formPart.car_id = currentCarId.value
    formPart.name = part.name
    formPart.serialnumber = part.serialnumber
}

async function submitPart() {
    if (addingNewPart.value) {
        try {
            errorMessage.value = "";
            const payload = {
              name: formPart.name,
              serialnumber: formPart.serialnumber,
              car_id: currentCarId.value,
            }

            const response = await axios.post(`/part`, payload)
            car.value.parts.push({
                id: response.data.part_id,
                name: formPart.name,
                serialnumber: formPart.serialnumber,
                car_id: currentCarId.value,
            })

            addingNewPart.value = false
            editingPart.value = false
            formPart.name = "";
            formPart.serialnumber = "";

        } catch (error: any) {
            errorMessage.value = ('Failed to add new part:', error.response?.data?.message || error.message)
        }
      } 

  if (editingPart.value) {
     try {
        errorMessage.value = "";
        const part_id = selectedPart.value.id
        const payload = {
          name: formPart.name,
          serialnumber: formPart.serialnumber,
          car_id: currentCarId.value,
        }

        await axios.put(`/part/${part_id}`, payload)

        selectedPart.value.name = formPart.name
        selectedPart.value.serialnumber = formPart.serialnumber
        addingNewPart.value = false
        editingPart.value = false
        formPart.name = "";
        formPart.serialnumber = "";

      } catch (error: any) {
        errorMessage.value = ('Failed to update part:', error.response?.data?.message || error.message)
      }
  }
}

async function deletePart(partId: number) {
  if (!confirm('Are you sure you want to delete this part?')) return

  try {
    errorMessage.value = "";
    await axios.delete(`/part/${partId}`)
    car.value.parts = car.value.parts.filter((p: any) => p.id !== partId)
  } catch (error: any) {
    errorMessage.value = ('Failed to delete part:', error.response?.data?.message || error.message)
  }
}

</script>

<template>
      <AppLayout>
        <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ isEdit ? 'Edit car' : 'Add new car' }}</h2>
        </div>

        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>

        <form @submit.prevent="submit" class="p-4 border rounded bg-light">
            <input v-if="isEdit" id="id" name="id" v-model="form.id" type="hidden" :value="currentCarId" />

            <div class="mb-3">
                <label for="name" class="form-label">Car name</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="e.g. Toyota Corolla"
                  required
                />
            </div>

            <div class="mb-3">
                <label for="registration_number" class="form-label">Registration number</label>
                <input
                  v-model="form.registration_number"
                  type="text"
                  class="form-control"
                  id="registration_number"
                  placeholder="e.g. TOY-123"
                  :required="form.is_registered"
                />
            </div>

            <div class="form-check mb-3">
                <input
                  v-model="form.is_registered"
                  class="form-check-input"
                  type="checkbox"
                  id="is_registered"
                />
                <label class="form-check-label" for="is_registered">
                    Is registered
                </label>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="form.processing">
              {{ isEdit ? 'Update Car' : 'Add Car' }}
            </button>
        </form>
        </div>
        <div v-if="isEdit" class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Parts</h2>
                <button @click="toggleNewPart" class="btn btn-success">+ Add New Part</button>
            </div>

            <div v-if="addingNewPart || editingPart" class="pb-4">
                <form @submit.prevent="submitPart" class="p-4 border rounded bg-light mt-4">
                    <input id="car_id" name="car_id" v-model="formPart.car_id" type="hidden" :value="currentCarId" />
                    <div class="mb-3">
                        <label for="name" class="form-label">Part name</label>
                        <input
                          v-model="formPart.name"
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="e.g. Brake Disc"
                          required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="serialnumber" class="form-label">Serial number</label>
                        <input
                          v-model="formPart.serialnumber"
                          type="text"
                          class="form-control"
                          id="serialnumber"
                          name="serialnumber"
                          placeholder="e.g. BD-12345"
                          required
                        />
                    </div>

                    <button v-if="addingNewPart" type="submit" class="btn btn-success">Add Part</button>
                    <button v-if="editingPart" type="submit" class="btn btn-success">Update Part</button>
                </form>
            </div>

            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Serial Number</th>
                        <th scope="col" class="text-center" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="part in car?.parts ?? []" :key="part.id">
                        <td>{{ part.id }}</td>
                        <td>{{ part.name }}</td>
                        <td>{{ part.serialnumber }}</td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-sm btn-warning me-1"
                                    @click="editPart(part)">
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
