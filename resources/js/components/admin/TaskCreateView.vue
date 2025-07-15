<template>
  <div class="max-w-2xl mx-auto p-6 bg-transparent border border-[#777] rounded shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-[#e65100]">Assign New Task</h2>

    <form @submit.prevent="submitTask">
      <!-- Title -->
      <div class="mb-4">
        <label class="block mb-1 font-medium text-white">Title</label>
        <input
          v-model="form.title"
          type="text"
          class="w-full bg-[#2a2a2a] text-white border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
          required
        />
        <p v-if="errors.title" class="text-sm text-red-500">{{ errors.title }}</p>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block mb-1 font-medium text-white">Description</label>
        <textarea
          v-model="form.description"
          class="w-full bg-[#2a2a2a] text-white border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
          required
        ></textarea>
      </div>

      <!-- Deadline -->
      <div class="mb-4">
        <label class="block mb-1 font-medium text-white">Deadline</label>
        <input
          v-model="form.deadline"
          type="datetime-local"
          class="w-full bg-[#2a2a2a] text-white border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
          required
        />
      </div>

      <!-- Assign To -->
      <div class="mb-6">
        <label class="block mb-1 font-medium text-white">Assign To</label>
        <select
          v-model="form.user_id"
          class="w-full bg-[#2a2a2a] text-white border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]"
          required
        >
          <option disabled value="">-- Select User --</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
        <p v-if="errors.user_id" class="text-sm text-red-500">{{ errors.user_id }}</p>
      </div>

      <!-- Submit Button -->
      <button
        class="bg-[#e65100] text-white px-4 py-2 rounded border border-[#e65100] hover:border-white transition"
        :disabled="loading"
      >
        {{ loading ? 'Submitting...' : 'Assign Task' }}
      </button>
    </form>
  </div>
</template>



<script>
export default {
  name: 'TaskCreateView',
  data() {
    return {
      form: {
        title: '',
        description: '',
        deadline: '',
        user_id: '',
      },
      users: [],
      errors: {},
      loading: false,
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await fetch('/dashboard/admin/users/json');
        const data = await response.json();
        console.log('Fetched users:', data)
        this.users = data;
      } catch (error) {
        console.error('Failed to load users:', error);
      }
    },
    async submitTask() {
      this.loading = true;
      this.errors = {};

      try {
        const response = await fetch('/dashboard/admin/tasks', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            Accept: 'application/json',
          },
          body: JSON.stringify(this.form),
        });

        if (!response.ok) {
          const data = await response.json();
          this.errors = data.errors || {};
        } else {
          this.$router.push('/dashboard/admin/tasks');
        }
      } catch (err) {
        console.error('Failed to submit task:', err);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
