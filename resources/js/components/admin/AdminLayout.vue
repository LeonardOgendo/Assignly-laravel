<template>
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white">
      <div class="p-4 text-lg font-semibold border-b border-gray-700">
        Admin Panel
      </div>
      <nav class="p-4 space-y-2">
        <router-link
          to="/dashboard/admin"
          class="block px-3 py-2 rounded hover:bg-gray-800"
          exact
        >Dashboard</router-link>
        <router-link
          to="/dashboard/admin/tasks"
          class="block px-3 py-2 rounded hover:bg-gray-800"
        >Task Manager</router-link>
        <router-link
          to="/dashboard/admin/users"
          class="block px-3 py-2 rounded hover:bg-gray-800"
        >User Manager</router-link>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 bg-gray-50 p-6 overflow-y-auto">
      <router-view />
    </main>
  </div>
</template>
