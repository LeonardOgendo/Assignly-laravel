<!-- resources/js/components/user/TasksView.vue -->
<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-2">My Tasks</h2>
    <p class="text-gray-700 mb-6">View your active and completed tasks assigned by admins.</p>

    <div class="flex flex-wrap gap-4">
      <router-link
        to="/dashboard/user/tasks/active"
        class="flex-1 min-w-[200px] bg-white border border-gray-200 shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Active Tasks</h3>
      </router-link>

      <router-link
        to="/dashboard/user/tasks/completed"
        class="flex-1 min-w-[200px] bg-white border border-gray-200 shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Completed Tasks</h3>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TasksView',
};
</script>
