<!-- resources/js/components/user/TasksCompletedView.vue -->
<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Completed Tasks</h2>

    <div v-if="loading" class="text-gray-500">Loading completed tasks...</div>
    <div v-else-if="tasks.length === 0" class="text-gray-600">
      You haven’t completed any tasks yet.
    </div>

    <div v-else class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
      <router-link
        v-for="task in tasks"
        :key="task.id"
        :to="`/dashboard/user/tasks/completed/${task.id}`"
        class="block border border-green-300 bg-green-50 rounded-lg p-4 hover:bg-green-100 transition shadow-sm"
      >
        <h3 class="text-md font-semibold mb-1 text-green-900 truncate">
          {{ task.title }}
        </h3>
        <p class="text-xs text-green-700">
          Completed: {{ formatDate(task.updated_at || task.completed_at) }}
        </p>
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TasksCompletedView',
  data() {
    return {
      loading: true,
      tasks: [],
    };
  },
  methods: {
    fetchCompletedTasks() {
      axios
        .get('/dashboard/user/tasks/completed/json')
        .then((res) => {
          this.tasks = res.data;
        })
        .catch((err) => {
          console.error('Error fetching completed tasks:', err);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    formatDate(dateStr) {
      if (!dateStr) return '—';
      return new Date(dateStr).toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
      });
    },
  },
  created() {
    this.fetchCompletedTasks();
  },
};
</script>

