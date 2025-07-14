<template>
  <div>
    <h2 class="text-xl font-semibold mb-4 text-[#e65100]">Analytics</h2>

    <div class="flex flex-wrap">
      <!-- Total Users -->
      <div
        class="md:min-w-[45%] flex-1 px-2 mb-6 cursor-pointer"
        @click="$router.push('/dashboard/admin/users/list')"
      >
        <div class="p-4 bg-[#222] shadow border border-[#444] text-white shadow-sm rounded-lg hover:bg-[#2a2a2a]">
          <h3 class="text-lg font-semibold">Total Users</h3>
          <p class="text-3xl font-bold">{{ metrics.totalUsers ?? '–' }}</p>
        </div>
      </div>

      <!-- Total Tasks -->
      <div
        class="md:min-w-[45%] flex-1 px-2 mb-6 cursor-pointer"
        @click="$router.push('/dashboard/admin/tasks/view')"
      >
        <div class="p-4 bg-[#222] shadow border border-[#444] text-white shadow-sm rounded-lg hover:bg-[#2a2a2a]">
          <h3 class="text-lg font-semibold">Total Tasks</h3>
          <p class="text-3xl font-bold">{{ metrics.totalTasks ?? '–' }}</p>
        </div>
      </div>

      <!-- Pending Reviews (non-clickable) -->
      <div class="md:min-w-[45%] flex-1 px-2 mb-6">
        <div class="p-4 bg-[#222] shadow border border-[#444] text-white shadow-sm rounded-lg">
          <h3 class="text-lg font-semibold">Pending Reviews</h3>
          <p class="text-3xl font-bold">{{ metrics.pendingReviews ?? '–' }}</p>
        </div>
      </div>

      <!-- Completed Tasks -->
      <div
        class="md:min-w-[45%] flex-1 px-2 mb-6 cursor-pointer"
        @click="$router.push({ path: '/dashboard/admin/tasks/view', query: { filter: 'completed' } })"
      >
        <div class="p-4 bg-[#222] shadow border border-[#444] text-white shadow-sm rounded-lg hover:bg-[#2a2a2a]">
          <h3 class="text-lg font-semibold">Completed Tasks</h3>
          <p class="text-3xl font-bold">{{ metrics.completedTasks ?? '–' }}</p>
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
