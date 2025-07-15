<template>
  <div class="max-w-2xl mx-auto px-6 py-2 border border-[#3f3f3f] shadow rounded-md">
    <h2 class="text-xl text-[#e65100] font-semibold mb-4">Edit Task</h2>

    <form @submit.prevent="updateTask">
      <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input v-model="form.title" type="text" class="w-full border bg-[#2a2a2a] text-white px-3 py-1 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]" required />
        <p v-if="errors.title" class="text-sm text-red-600">{{ errors.title }}</p>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full border bg-[#2a2a2a] text-white px-3 py-1 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]" required></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Deadline</label>
        <input v-model="form.deadline" type="datetime-local" class="w-full border bg-[#2a2a2a] text-white px-3 py-1 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]" required />
      </div>

      <div class="mb-6">
        <label class="block mb-1">Assign To</label>
        <select v-model="form.user_id" class="w-full border bg-[#2a2a2a] text-white px-3 py-1 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]" required>
          <option disabled value="">-- Select User --</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
        <p v-if="errors.user_id" class="text-sm text-red-600">{{ errors.user_id }}</p>
      </div>

      <div class="mb-6">
        <label class="block mb-1">Status</label>
        <select v-model="form.status" class="w-full border bg-[#2a2a2a] text-white px-3 py-1 rounded focus:outline-none focus:ring-1 focus:ring-[#e65100] focus:border-[#e65100]">
          <option value="pending">Pending</option>
          <option value="in_progress">In Progress</option>
          <option value="completed">Completed</option>
        </select>
      </div>

      <button class="bg-[#e65100] text-white px-4 py-1 rounded border border-[#e65100] hover:border-white transition" :disabled="loading">
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
