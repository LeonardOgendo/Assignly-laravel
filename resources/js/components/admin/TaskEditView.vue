<template>
  <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Edit Task</h2>

    <form @submit.prevent="updateTask">
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

      <div class="mb-6">
        <label class="block mb-1 font-medium">Status</label>
        <select v-model="form.status" class="w-full border px-3 py-2 rounded">
          <option value="pending">Pending</option>
          <option value="in_progress">In Progress</option>
          <option value="completed">Completed</option>
        </select>
      </div>

      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" :disabled="loading">
        {{ loading ? 'Updating...' : 'Update Task' }}
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'TaskEditView',
  data() {
    return {
      form: {
        title: '',
        description: '',
        deadline: '',
        user_id: '',
        status: '',
      },
      users: [],
      errors: {},
      loading: false,
    };
  },
  mounted() {
    this.fetchTask();
    this.fetchUsers();
  },
  methods: {
    async fetchTask() {
      const taskId = this.$route.params.id;
      try {
        const res = await fetch(`/dashboard/admin/tasks/${taskId}`, {
          headers: { Accept: 'application/json' },
        });
        const data = await res.json();

        this.form = {
          title: data.title,
          description: data.description,
          deadline: data.deadline?.slice(0, 16) ?? '',
          user_id: data.user_id,
          status: data.status,
        };
      } catch (err) {
        console.error('Failed to load task:', err);
      }
    },

    async fetchUsers() {
      try {
        const res = await fetch('/dashboard/admin/users/json');
        const data = await res.json();
        this.users = data;
      } catch (err) {
        console.error('Failed to load users:', err);
      }
    },

    async updateTask() {
      this.loading = true;
      this.errors = {};
      const taskId = this.$route.params.id;

      try {
        const res = await fetch(`/dashboard/admin/tasks/${taskId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            Accept: 'application/json',
          },
          body: JSON.stringify(this.form),
        });

        if (!res.ok) {
          const data = await res.json();
          this.errors = data.errors || {};
        } else {
          this.$router.push('/dashboard/admin/tasks');
        }
      } catch (err) {
        console.error('Update failed:', err);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
