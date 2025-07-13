<template>
  <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Assign New Task</h2>

    <form @submit.prevent="submitTask">
      <div class="mb-4">
        <label class="block mb-1 font-medium">Title</label>
        <input v-model="form.title" type="text" class="w-full border px-3 py-2 rounded" required />
        <p v-if="errors.title" class="text-sm text-red-600">{{ errors.title }}</p>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-medium">Description</label>
        <textarea v-model="form.description" class="w-full border px-3 py-2 rounded"></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-medium">Deadline</label>
        <input v-model="form.deadline" type="datetime-local" class="w-full border px-3 py-2 rounded" />
      </div>

      <div class="mb-6">
        <label class="block mb-1 font-medium">Assign To</label>
        <select v-model="form.user_id" class="w-full border px-3 py-2 rounded" required>
          <option disabled value="">-- Select User --</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
        <p v-if="errors.user_id" class="text-sm text-red-600">{{ errors.user_id }}</p>
      </div>

      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" :disabled="loading">
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
