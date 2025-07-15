<template>
  <div class="max-w-xl w-full px-4 sm:px-0">
    <div v-if="loading" class="text-gray-500 text-sm sm:text-base">Loading task...</div>

    <div
      v-else-if="task"
      class="space-y-4 border border-[#3f3f3f] p-4 sm:p-6 rounded-md bg-[#1e1e1e] shadow"
    >

      <h2 class="text-lg sm:text-xl text-[#e65100] font-bold mb-2 sm:mb-3">{{ task.title }}</h2>

      <!-- Description -->
      <p class="text-white text-sm sm:text-base mb-2">
        {{ task.description || 'No description provided.' }}
      </p>

      <p class="text-xs sm:text-sm text-[#8b8b8b]">Due: {{ formatDate(task.deadline) }}</p>
      <p class="text-xs sm:text-sm text-[#8b8b8b] mb-3">Assigned By: {{ task.assigner?.name }}</p>

      <!-- Feedback -->
      <p v-if="successMessage" class="text-green-600 font-medium text-sm sm:text-base">
        ✅ {{ successMessage }}
      </p>
      <p v-if="errorMessage" class="text-red-600 font-medium text-sm sm:text-base">
        ⚠️ {{ errorMessage }}
      </p>

      <!-- Status Update Form -->
      <form @submit.prevent="updateStatus" class="space-y-3">
        <div>
          <label class="block text-sm font-medium mb-1">Update Status:</label>
          <select
            v-model="task.status"
            class="border rounded px-3 py-2 w-full bg-[#1f1f1f] text-sm text-gray-300 focus:outline-none"
          >
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>


        <button
          type="submit"
          :disabled="updating"
          class="bg-[#e65100] hover:bg-[#2e2e2e] text-white text-sm px-4 py-2 mt-3 rounded shadow disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="updating">Updating...</span>
          <span v-else>Save Changes</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TaskDetailView',
  props: ['id'],
  data() {
    return {
      task: null,
      loading: true,
      updating: false,
      successMessage: '',
      errorMessage: '',
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
          this.errorMessage = 'Failed to load task. Please try again later.';
        })
        .finally(() => {
          this.loading = false;
        });
    },
    updateStatus() {
      this.updating = true;
      this.successMessage = '';
      this.errorMessage = '';

      axios
        .put(`/dashboard/user/tasks/json/${this.id}`, {
          status: this.task.status,
        })
        .then(() => {
          this.successMessage = 'Task status updated successfully.';
          setTimeout(() => {
            this.$router.push('/dashboard/user/tasks');
          }, 1500);
        })
        .catch((err) => {
          console.error('Failed to update task status:', err);
          this.errorMessage = 'Failed to update. Please try again.';
        })
        .finally(() => {
          this.updating = false;
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
