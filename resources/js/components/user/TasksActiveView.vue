<!-- resources/js/components/user/TasksActiveView.vue -->
<template>
  <div class="space-y-4">
    <h2 class="text-xl font-bold text-[#e65100] mb-4">Active Tasks</h2>

    <div v-if="loading" class="text-gray-400">Loading tasks...</div>
    <div v-else-if="tasks.length === 0" class="text-gray-400">No active tasks found.</div>

    <ul v-else class="space-y-3">
      <li
        v-for="task in tasks"
        :key="task.id"
      >
        <router-link
          :to="`/dashboard/user/tasks/${task.id}`"
          class="block border border-[#3f3f3f] bg-[#1e1e1e] mb-3 p-4 rounded-md shadow-sm hover:bg-[#2a2a2a] transition"
        >
          <div class="flex justify-between items-start flex-wrap gap-2">
            <div>
              <p class="font-semibold text-white text-[0.9rem] leading-snug">{{ task.title }}</p>
              <p class="text-xs text-gray-400 mt-1">
                Due by: {{ formatDate(task.deadline) }}
              </p>
            </div>
            <div class="flex flex-col">
              <span
                class="text-xs px-2 py-1 rounded text-[#e65100] uppercase tracking-wide font-semibold"
              >
                {{ task.status.replace('_', ' ') }}
          
              </span>
              <span class="text-xs text-[#8b8b8b] mt-1">Click to Update</span>
            </div>
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
