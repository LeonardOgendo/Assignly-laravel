<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <user-sidebar />

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
      <!-- Top bar -->
      <header class="w-full bg-white shadow-sm px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-indigo-600">User Dashboard</h1>

        <!-- Logout -->
        <form method="POST" action="/logout" class="inline">
          <input type="hidden" name="_token" :value="csrf" />
          <button
            type="submit"
            class="bg-red-500 hover:bg-red-600 text-black text-sm px-3 py-1 rounded"
          >
            Logout
          </button>
        </form>
      </header>

      <!-- Router outlet -->
      <main class="flex-1 p-6">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import UserSidebar from './UserSidebar.vue';

export default {
  name: 'UserLayout',
  components: { UserSidebar },
  computed: {
    csrf() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
  },
};
</script>
