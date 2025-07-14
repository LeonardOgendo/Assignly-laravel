<!-- resources/js/components/user/TasksView.vue -->
<template>
  <div>
    <h2 class="text-xl text-[#e65100] font-bold mb-1">My Tasks</h2>
    <p class="text-gray-300 text-sm mb-6">
      View your active and completed tasks assigned by admins.
    </p>

    <div class="flex flex-wrap gap-4">
      <router-link
        to="/dashboard/user/tasks/active"
        class="flex-1 min-w-[200px] bg-[#222] border border-gray-200 min-h-[130px] shadow rounded-lg p-6 hover:bg-[#2e2e2e] transition flex items-center justify-center text-center"
      >
        <h3 class="text-lg font-semibold">Active Tasks</h3>
      </router-link>

      <router-link
        to="/dashboard/user/tasks/completed"
        class="flex-1 min-w-[200px] border bg-[#222] border-gray-200 min-h-[130px] shadow rounded-lg p-6 hover:bg-[#2e2e2e] transition flex items-center justify-center text-center"
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
