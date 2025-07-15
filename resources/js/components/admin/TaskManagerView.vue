<template>
  <div>
    <h2 class="text-xl text-[#e65100] font-semibold mb-1">Manage Tasks</h2>
    <p class="text-sm text-gray-300 mb-6">View, Assign and Update Tasks</p>

    <div class="flex flex-col md:flex-row gap-4">
      <!-- View Tasks -->
      <router-link
        to="/dashboard/admin/tasks/view"
        class="w-full md:flex-1 bg-[#222] shadow border border-gray-200 rounded-md p-6 min-h-[130px] hover:bg-[#2e2e2e] transition
               flex items-center justify-center text-center"
      >
        <h3 class="text-lg font-semibold">View Tasks</h3>
      </router-link>

      <!-- Assign Task -->
      <router-link
        to="/dashboard/admin/tasks/create"
        class="w-full md:flex-1 bg-[#222] shadow border border-gray-200 rounded-md p-6 min-h-[130px] hover:bg-[#2e2e2e] transition
               flex items-center justify-center text-center"
      >
        <h3 class="text-lg font-semibold">Assign Task</h3>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TaskManagerView',
};
</script>
