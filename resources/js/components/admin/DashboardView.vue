<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Analytics</h2>

    <div class="flex flex-wrap -mx-2">
      <!-- Total Users -->
      <div class="w-full sm:w-1/2 px-2 mb-4">
        <div class="p-4 bg-[#222] shadow rounded border-l-4 border-blue-500 text-white">
          <h3 class="text-lg font-semibold">Total Users</h3>
          <p class="text-3xl font-bold">{{ metrics.totalUsers ?? '–' }}</p>
        </div>
      </div>

      <!-- Total Tasks -->
      <div class="w-full sm:w-1/2 px-2 mb-4">
        <div class="p-4 bg-[#222] shadow rounded border-l-4 border-green-500 text-white">
          <h3 class="text-lg font-semibold">Total Tasks</h3>
          <p class="text-3xl font-bold">{{ metrics.totalTasks ?? '–' }}</p>
        </div>
      </div>

      <!-- Pending Reviews (placeholder) -->
      <div class="w-full sm:w-1/2 px-2 mb-4">
        <div class="p-4 bg-[#222] shadow rounded border-l-4 border-red-500 text-white">
          <h3 class="text-lg font-semibold">Pending Reviews</h3>
          <p class="text-3xl font-bold">{{ metrics.pendingReviews ?? '–' }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'DashboardView',
  data() {
    return {
      metrics: {},
    };
  },
  async mounted() {
    try {
      const res = await axios.get('/dashboard/admin/metrics/json');
      this.metrics = res.data;
    } catch (err) {
      console.error('Failed to load metrics:', err);
    }
  },
};
</script>
