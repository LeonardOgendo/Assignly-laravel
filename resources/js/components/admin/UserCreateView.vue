
<template>
  <div class="p-6 max-w-xl mx-auto bg-trasparent border border-[#777] rounded shadow">
    <h2 class="text-2xl text-[#e65100] font-bold mb-4">Create New User</h2>

    
    <div class="mb-4">
      <span class="inline-block border border-[#3f3f3f] bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">
        🔐 Password Autogenerated
      </span>
    </div>

    <!-- User Creation Form -->
    <form @submit.prevent="handleSubmit" novalidate>
  
      <div class="mb-4">
        <label class="block text-sm font-medium text-white mb-1">Name</label>
        <input
          v-model="form.name"
          type="text"
          placeholder="Leon Devolapa"
          class="w-full border bg-[#2a2a2a] text-white rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
        />
        <p v-if="errors.name" class="text-sm text-red-600 mt-1">{{ errors.name }}</p>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-white mb-1">Email</label>
        <input
          v-model="form.email"
          type="email"
          placeholder="Enter valid email"
          class="w-full border bg-[#2a2a2a] text-white rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
        />
        <p v-if="errors.email" class="text-sm text-red-600 mt-1">{{ errors.email }}</p>
      </div>

      <button
        type="submit"
        :disabled="loading"
        class="w-full bg-[#e65100] text-white py-2 px-4 rounded border border-[#e65100] hover:border-white transition"
      >
        {{ loading ? 'Creating...' : 'Create User' }}
      </button>
    </form>

    <div
      v-if="successMessage"
      class="mt-4 p-3 bg-green-100 text-green-800 rounded text-sm"
    >
      {{ successMessage }}
    </div>
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
      },
      errors: {},
      loading: false,
      successMessage: '',
    };
  },
  methods: {
    async handleSubmit() {
      this.loading = true;
      this.errors = {};
      this.successMessage = '';

      try {
        const res = await axios.post('/admin/users', this.form);
        this.successMessage = '✅ Login details sent to email.';
        this.form.name = '';
        this.form.email = '';
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
