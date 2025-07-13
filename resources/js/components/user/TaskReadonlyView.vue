<!-- resources/js/components/user/TaskReadonlyView.vue -->
<template>
  <div class="p-6 max-w-xl mx-auto space-y-4">
    <div v-if="loading" class="text-gray-500">Loading task...</div>

    <div v-else-if="task">
      <h2 class="text-2xl font-bold">{{ task.title }}</h2>
      <p class="text-gray-700">{{ task.description || 'No description provided.' }}</p>
      <p class="text-sm text-gray-500">Due: {{ formatDate(task.deadline) }}</p>
      <p class="text-sm text-gray-500">Assigned By: {{ task.assigner?.name }}</p>
      <p class="mt-4 text-green-600 font-medium">
        This task was marked as <span class="underline">completed</span>.
      </p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TaskReadonlyView',
  props: ['id'],
  data() {
    return {
      task: null,
      loading: true,
    };
  },
  methods: {
    fetchTask() {
      axios
        .get(`/dashboard/user/tasks/json/${this.id}`)
        .then((res) => {
          this.task = res.data;
        })
        .catch((err) => {
          console.error('Failed to fetch task:', err);
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
    this.fetchTask();
  },
};
</script>
