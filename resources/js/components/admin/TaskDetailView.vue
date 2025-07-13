<template>
  <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-2">{{ task.title }}</h2>
    <p class="text-sm text-gray-600 mb-4">
      Assigned by: <strong>{{ task.assigner?.name || '—' }}</strong>
    </p>

    <p class="mb-4">
      <strong>Description:</strong><br />
      {{ task.description || 'No description' }}
    </p>

    <p class="mb-4">
      <strong>Deadline:</strong> {{ formatDate(task.deadline) }}
    </p>

    <p class="mb-4">
      <strong>Status:</strong>
      <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded">
        {{ task.status.replace('_', ' ') }}
      </span>
    </p>

    <div v-if="canUpdateStatus" class="mt-6">
      <form @submit.prevent="updateStatus">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Update Status</label>
          <select v-model="status" class="w-full border px-3 py-2 rounded">
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <button
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
          :disabled="loading"
        >
          {{ loading ? 'Saving...' : 'Update Status' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TaskDetailView',
  data() {
    return {
      task: {},
      status: '',
      loading: false,
      canUpdateStatus: false,
    };
  },
  mounted() {
    this.fetchTask();
  },
  methods: {
    async fetchTask() {
      const taskId = this.$route.params.id;
      try {
        const res = await fetch(`/dashboard/admin/tasks/${taskId}`, {
          headers: { Accept: 'application/json' },
        });
        const data = await res.json();
        this.task = data;
        this.status = data.status;
        this.canUpdateStatus = data.can_update_status;
      } catch (err) {
        console.error('Failed to fetch task:', err);
      }
    },
    formatDate(datetime) {
      if (!datetime) return '—';
      return new Date(datetime).toLocaleString('en-KE', {
        dateStyle: 'medium',
        timeStyle: 'short',
      });
    },
    async updateStatus() {
      this.loading = true;
      try {
        const res = await fetch(`/dashboard/admin/tasks/${this.task.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            Accept: 'application/json',
          },
          body: JSON.stringify({ status: this.status }),
        });
        if (!res.ok) throw new Error('Update failed');
        this.task.status = this.status;
      } catch (err) {
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
