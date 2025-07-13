<!-- resources/js/components/admin/UserCreateView.vue -->
<template>
  <div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Create New User</h2>

    <form @submit.prevent="handleSubmit" novalidate>
      <!-- Name -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input
          v-model="form.name"
          type="text"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
        />
        <p v-if="errors.name" class="text-sm text-red-600 mt-1">{{ errors.name }}</p>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input
          v-model="form.email"
          type="email"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
        />
        <p v-if="errors.email" class="text-sm text-red-600 mt-1">{{ errors.email }}</p>
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input
          v-model="form.password"
          type="password"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
        />
        <p v-if="errors.password" class="text-sm text-red-600 mt-1">{{ errors.password }}</p>
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input
          v-model="form.password_confirmation"
          type="password"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
        />
        <p
          v-if="errors.password_confirmation"
          class="text-sm text-red-600 mt-1"
        >
          {{ errors.password_confirmation }}
        </p>
      </div>

      <!-- Submit -->
      <button
        type="submit"
        :disabled="loading"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition"
      >
        {{ loading ? 'Creating...' : 'Create User' }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UserCreateView',
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      errors: {},
      loading: false,
    };
  },
  methods: {
    async handleSubmit() {
      this.loading = true;
      this.errors = {};

      try {
        await axios.post('/admin/users', this.form);
        alert('User created successfully!');
        this.$router.push('/dashboard/admin/users/list');
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        } else {
          console.error(error);
          alert('An error occurred while creating the user.');
        }
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
