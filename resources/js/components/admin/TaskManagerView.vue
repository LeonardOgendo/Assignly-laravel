<!-- TaskManagerView.vue -->
<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-2">Manage Tasks</h2>
    <p class="text-gray-700 mb-6">View, Assign and Update Tasks</p>

    <div class="flex space-x-4">
      <a
        href="/dashboard/admin/tasks"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">View Tasks</h3>
      </a>

      <a
        href="/dashboard/admin/tasks/create"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Assign Task</h3>
      </a>

      <a
        href="/dashboard/admin/tasks"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Update Tasks</h3>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TaskManagerView',
};
</script>
