<template>
  <div class="min-h-screen bg-gray-50 text-gray-800 flex flex-col">

    <!-- Top Navbar -->
    <header class="w-full bg-white shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-indigo-600">TaskFlow</h1>
        <div>
          <button @click="goToLogin" class="px-4 py-2 text-sm bg-indigo-600 text-black rounded hover:bg-indigo-700">
            Login
          </button>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="flex-1 flex flex-col justify-center items-center text-center px-4 py-12">
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Manage Tasks Smarter. Stay Focused.</h2>
      <p class="mt-4 max-w-xl text-gray-600 text-lg">
        A minimalist task manager for teams and admins — assign, track, and complete with clarity.
      </p>
    </section>

    <!-- Feature Cards -->
    <section class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Centralized Task Assignment</h3>
        <p class="text-sm text-gray-600">Admins assign tasks with deadlines — users get clarity, fast.</p>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Email Notifications</h3>
        <p class="text-sm text-gray-600">Get notified instantly when a new task is assigned to you.</p>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Easy Status Updates</h3>
        <p class="text-sm text-gray-600">Update task progress from Pending to Completed in one click.</p>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Admin Oversight</h3>
        <p class="text-sm text-gray-600">Admins manage users, monitor task flow, and track productivity.</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'LandingPage',
  methods: {
    goToLogin() {
      window.location.href = '/login';
    },
    goToRegister() {
      window.location.href = '/register';
    }
  }
}
</script>
