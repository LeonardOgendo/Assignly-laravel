<template>
  <div>
    <h2 class="text-xl font-bold mb-2">Manage Users</h2>
    <p class="text-sm text-gray-300 mb-6">View and Create platform users</p>

    <div class="flex flex-wrap gap-4">
      <router-link
        to="/dashboard/admin/users/list"
        class="w-full sm:flex-1 bg-[#222] shadow border border-gray-200 rounded-md p-6 min-h-[130px] hover:bg-[#2e2e2e] transition
               flex items-center justify-center text-center"
      >
        <h3 class="text-lg font-semibold">View Users</h3>
      </router-link>

      <router-link
        to="/dashboard/admin/users/create"
        class="w-full sm:flex-1 bg-[#222] shadow border border-gray-200 rounded-md p-6 min-h-[130px] hover:bg-[#2e2e2e] transition
               flex items-center justify-center text-center"
      >
        <h3 class="text-lg font-semibold">Create User</h3>
      </router-link>
    </div>
  </div>
</template>
