<script setup lang="ts">
import axios from 'axios'
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, watch } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'

const { props } = usePage()
const part = ref(props.part)
const errorMessage = ref(false)

const formPart = useForm({
  name: part?.value?.name || '',
  serialnumber: part?.value?.serialnumber || '',
  car_id: part?.value?.car_id || ''
})

async function submitPart() {
 try {
    errorMessage.value = "";
    const part_id = part.value.id
    const payload = {
      name: formPart.name,
      serialnumber: formPart.serialnumber,
      car_id: part.value.car_id,
    }

    await axios.put(`/part/${part_id}`, payload)

  } catch (error: any) {
    errorMessage.value = ('Failed to update part:', error.response?.data?.message || error.message)
  }
}

</script>

<template>
      <AppLayout>
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Edit Part</h2>
            </div>

            <div class="pb-4">
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

                    <button type="submit" class="btn btn-success">Update Part</button>
                </form>
            </div>
        </div>

      </AppLayout>
</template>
