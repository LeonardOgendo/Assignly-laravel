<!-- resources/js/components/user/TaskReadonlyView.vue -->
<template>
  <div class="max-w-xl space-y-4 border border-[#3f3f3f] p-4 rounded-md">
    <div v-if="loading" class="text-gray-500">Loading task...</div>

    <div v-else-if="task">
      <h2 class="text-xl text-[#e65100] mb-1 font-semibold">{{ task.title }}</h2>
      <p class="text-white text-sm mb-3">{{ task.description || 'No description provided.' }}</p>
      <p class="text-sm text-[#8b8b8b]">Due: {{ formatDate(task.deadline) }}</p>
      <p class="text-sm text-[#8b8b8b]">Assigned By: {{ task.assigner?.name }}</p>
      <p class="mt-4 text-[#e65100] font-medium">
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
