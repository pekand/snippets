<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

/*const form = reactive({
  email: '',
  password: '',
  remember: false,
})*/

function submit() {
  router.post('/login', form)
}

</script>

<template>
  <Head title="Login" />

  <main class="form-signin w-100 m-auto">
    <form @submit.prevent="submit" >
      <img class="mb-4" src="/assets/img/engine.png" alt="" width="72" />
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating mb-2">
        <input
          v-model="form.email"
          id="email"
          type="email"
          name="email"
          class="form-control"
          :class="{ 'is-invalid': form.errors.email }"          
          :tabindex="1"
          required
          autofocus
          placeholder="email@example.com"
          autocomplete="email"
        />
        <label for="floatingInput">Email address</label>
        <div v-if="form.errors.email" class="invalid-feedback d-block">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="form-floating mb-2">
        <input
          id="password"
          type="password"
          name="password"
          v-model="form.password"
          class="form-control"
          :class="{ 'is-invalid': form.errors.password }"
          required
          :tabindex="2"
          autocomplete="current-password"
          placeholder="Password"
        />
        <label for="floatingPassword">Password</label>
        <div v-if="form.errors.password" class="invalid-feedback d-block">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="form-check text-start my-3">
        <input
          id="remember" 
          name="remember" 
          :tabindex="3"
          class="form-check-input"
          type="checkbox"
          v-model="form.remember"
        />
        <label class="form-check-label" for="checkDefault"> Remember me </label>
      </div>

      <button
        class="btn btn-primary w-100 py-2"
        type="submit"
      >
      Log in
      </button>

      <p class="mt-5 mb-3 text-body-secondary">&copy; 2025</p>
    </form>
  </main>
</template>
