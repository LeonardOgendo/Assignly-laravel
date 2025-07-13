<!-- resources/js/components/user/TasksActiveView.vue -->
<template>
  <div class="p-6 space-y-4">
    <h2 class="text-2xl font-bold">Active Tasks</h2>

    <div v-if="loading" class="text-gray-500">Loading tasks...</div>
    <div v-else-if="tasks.length === 0" class="text-gray-500">No active tasks found.</div>

    <ul v-else class="space-y-2">
      <li
        v-for="task in tasks"
        :key="task.id"
      >
        <router-link
          :to="`/dashboard/user/tasks/${task.id}`"
          class="block bg-white p-4 rounded-md shadow hover:bg-gray-100 transition"
        >
          <div class="flex justify-between items-center">
            <div>
              <p class="font-medium">{{ task.title }}</p>
              <p class="text-xs text-gray-500">Due by {{ formatDate(task.deadline) }}</p>
            </div>
            <span
              class="text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-800 uppercase tracking-wide"
            >
              {{ task.status.replace('_', ' ') }}
            </span>
          </div>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TasksActive',
  data() {
    return {
      loading: true,
      tasks: [],
    };
  },
  methods: {
    fetchTasks() {
      axios
        .get('/dashboard/user/tasks/json')
        .then((res) => {
          this.tasks = res.data;
        })
        .catch((err) => {
          console.error('Failed to fetch tasks:', err);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    formatDate(dateStr) {
      if (!dateStr) return '—';
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      return new Date(dateStr).toLocaleDateString(undefined, options);
    },
  },
  created() {
    this.fetchTasks();
  },
};
</script>
