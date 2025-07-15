<template>
  <div>
    <h1 class="text-xl md:text-2xl text-[#e65100] font-semibold mb-4">Tasks</h1>

    <div v-if="successMessage" class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm md:text-base">
      {{ successMessage }}
    </div>

    <div class="overflow-x-auto border border-[#3f3f3f] rounded shadow">
      <table class="w-full bg-transparent table-auto text-xs md:text-sm text-white">
        <thead class="bg-[#e65100] text-white uppercase text-[0.65rem] md:text-sm">
          <tr>
            <th class="p-2 md:p-3 text-left">#</th>
            <th class="p-2 md:p-3 text-left">Title</th>
            <th class="p-2 md:p-3 text-left">Assignee</th>
            <th class="p-2 md:p-3 text-left">Deadline</th>
            <th class="p-2 md:p-3 text-left">Status</th>
            <th class="p-2 md:p-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(task, index) in tasks"
            :key="task.id"
            class="border-t border-[#444] hover:bg-[#2f2f2f] transition"
          >
            <td class="p-2 md:p-3 text-gray-400">{{ index + 1 }}</td>
            <td class="p-2 md:p-3">{{ task.title }}</td>
            <td class="p-2 md:p-3">{{ task.assignee?.name || '—' }}</td>
            <td class="p-2 md:p-3">{{ formatDate(task.deadline) }}</td>
            <td class="p-2 md:p-3 capitalize">{{ task.status.replace('_', ' ') }}</td>
            <td class="p-2 md:p-3 text-right space-x-2 md:space-x-4">
              <router-link
                :to="`/dashboard/admin/tasks/${task.id}/edit`"
                class="text-blue-500 hover:underline hover:text-indigo-300 transition"
              >
                Edit
              </router-link>
              <button
                @click="deleteTask(task.id)"
                class="text-red-500 hover:underline transition"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TaskListView',
  data() {
    return {
      tasks: [],
      successMessage: '',
    };
  },
  mounted() {
    this.fetchTasks();

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
