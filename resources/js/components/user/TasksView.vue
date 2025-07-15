<template>
  <div>
    <h2 class="text-xl text-[#e65100] font-bold mb-1">My Tasks</h2>
    <p class="text-gray-300 text-sm mb-6">
      View your active and completed tasks assigned by admins.
    </p>

    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
      <router-link
        to="/dashboard/user/tasks/active"
        class="w-full sm:flex-1 bg-[#222] border border-gray-200 min-h-[130px] shadow rounded-lg p-6 hover:bg-[#2e2e2e] transition flex items-center justify-center text-center"
      >
        <h3 class="text-md font-semibold">Active Tasks</h3>
      </router-link>

      <router-link
        to="/dashboard/user/tasks/completed"
        class="w-full sm:flex-1 bg-[#222] border border-gray-200 min-h-[130px] shadow rounded-lg p-6 hover:bg-[#2e2e2e] transition flex items-center justify-center text-center"
      >
        <h3 class="text-md font-semibold">Completed Tasks</h3>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TasksView',
};
</script>
