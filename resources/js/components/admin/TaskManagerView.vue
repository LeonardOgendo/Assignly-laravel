<!-- TaskManagerView.vue -->
<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-2">Manage Tasks</h2>
    <p class="text-gray-700 mb-6">View, Assign and Update Tasks</p>

    <div class="flex space-x-4">
      <router-link
        to="/dashboard/admin/tasks/view"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">View Tasks</h3>
      </router-link>

      <router-link
        to="/dashboard/admin/tasks/create"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Assign Task</h3>
      </router-link>

      <router-link
        to="/dashboard/admin/tasks/update"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Update Tasks</h3>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TaskManagerView',
};
</script>
