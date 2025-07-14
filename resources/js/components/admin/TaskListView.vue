<template>
  <div>
    <h1 class="text-xl font-semibold mb-4">Tasks</h1>

    <div v-if="successMessage" class="mb-4 p-3 bg-green-100 text-green-800 rounded">
      {{ successMessage }}
    </div>

    <table class="w-full border-[#777] text-left bg-transparent shadow rounded overflow-hidden">
      <thead class="bg-gray-100 text-sm uppercase text-gray-600">
        <tr>
          <th class="p-3">Title</th>
          <th class="p-3">Assignee</th>
          <th class="p-3">Deadline</th>
          <th class="p-3">Status</th>
          <th class="p-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id" class="border-t">
          <td class="p-3">{{ task.title }}</td>
          <td class="p-3">{{ task.assignee?.name || '—' }}</td>
          <td class="p-3">{{ formatDate(task.deadline) }}</td>
          <td class="p-3 capitalize">{{ task.status.replace('_', ' ') }}</td>
          <td class="p-3 text-right space-x-2">
            <router-link
              :to="`/dashboard/admin/tasks/${task.id}/edit`"
              class="text-blue-600 hover:underline"
            >
              Edit
            </router-link>
            <button
              @click="deleteTask(task.id)"
              class="text-red-600 hover:underline"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'TasListView',
  data() {
    return {
      tasks: [],
      successMessage: '',
    };
  },
  mounted() {
    this.fetchTasks();

    // Handle success message from redirected route
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    if (success) this.successMessage = success;
  },
  methods: {
    async fetchTasks() {
      try {
        const res = await fetch('/dashboard/admin/tasks/list', {
          headers: { Accept: 'application/json' },
        });
        const data = await res.json();
        this.tasks = data.data;
      } catch (err) {
        console.error('Failed to fetch tasks:', err);
      }
    },
    formatDate(dateString) {
      if (!dateString) return '—';
      return new Date(dateString).toLocaleString('en-KE', {
        dateStyle: 'medium',
        timeStyle: 'short',
      });
    },
    async deleteTask(id) {
      if (!confirm('Delete this task?')) return;

      try {
        const res = await fetch(`/dashboard/admin/tasks/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            Accept: 'application/json',
          },
        });

        if (res.ok) {
          this.tasks = this.tasks.filter(t => t.id !== id);
          this.successMessage = 'Task deleted.';
        }
      } catch (err) {
        console.error('Delete failed:', err);
      }
    },
  },
};
</script>
