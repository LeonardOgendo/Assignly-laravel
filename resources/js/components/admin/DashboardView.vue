<template>
  <div>
    <h2 class="text-xl font-semibold mb-4 text-[#e65100]">Analytics</h2>

    <!-- Cards container -->
    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
      
      <!-- Total Users -->
      <div
        class="w-full sm:w-[45%] cursor-pointer"
        @click="$router.push('/dashboard/admin/users/list')"
      >
        <div class="p-4 bg-[#222] shadow border border-[#777] text-white rounded-lg hover:bg-[#2a2a2a] transition">
          <h3 class="text-md font-semibold">Total Users</h3>
          <p class="text-xl font-bold">{{ metrics.totalUsers ?? '–' }}</p>
        </div>
      </div>

      <!-- Total Tasks -->
      <div class="w-full sm:w-[45%] cursor-pointer"
        @click="$router.push('/dashboard/admin/tasks/view')"
      >
        <div class="p-4 bg-[#222] shadow border border-[#777] text-white rounded-lg hover:bg-[#2a2a2a] transition">
          <h3 class="text-md font-semibold">Total Tasks</h3>
          <p class="text-xl font-bold">{{ metrics.totalTasks ?? '–' }}</p>
        </div>
      </div>

      <!-- Pending Reviews -->
      <div class="w-full sm:w-[45%]">
        <div class="p-4 bg-[#222] shadow border border-[#777] text-white rounded-lg">
          <h3 class="text-md font-semibold">Pending Reviews</h3>
          <p class="text-xl font-bold">{{ metrics.pendingReviews ?? '–' }}</p>
        </div>
      </div>

      <!-- Completed Tasks -->
      <div
        class="w-full sm:w-[45%] cursor-pointer"
        @click="$router.push({ path: '/dashboard/admin/tasks/view', query: { filter: 'completed' } })"
      >
        <div class="p-4 bg-[#222] shadow border border-[#777] text-white rounded-lg hover:bg-[#2a2a2a] transition">
          <h3 class="text-md font-semibold">Completed Tasks</h3>
          <p class="text-xl font-bold">{{ metrics.completedTasks ?? '–' }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminMetrics',
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
