<!-- resources/js/components/admin/UserManagerView.vue -->
<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-2">Manage Users</h2>
    <p class="text-gray-700 mb-6">View and Create platform users</p>

    <div class="flex space-x-4">
      <router-link
        to="/dashboard/admin/users/list"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">View Users</h3>
      </router-link>

      <router-link
        to="/dashboard/admin/users/create"
        class="flex-1 bg-white shadow rounded-lg p-6 text-center hover:bg-gray-100 transition"
      >
        <h3 class="text-lg font-semibold">Create User</h3>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserManagerView',
};
</script>
