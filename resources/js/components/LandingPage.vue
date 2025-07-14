<template>
  <div
    class="h-screen text-white flex flex-col w-full bg-[#0f172a]"
    :style="responsiveWidth"
  >
    <!-- Top Navbar -->
    <header class="w-full mt-5">
      <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">
          A<span style="letter-spacing: -0.15em">ssig</span><span class="text-[#e65100]">nly</span>
        </h1>
        <div>
          <button
            @click="goToLogin"
            class="px-5 py-1 text-md bg-[#e65100] text-white rounded hover:bg-orange-600 transition"
          >
            Login
          </button>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="flex-1 flex flex-col justify-center mt-12 items-center text-center px-4">
      <h2 class="md:text-[1.3rem] font-bold text-white">
        Stay On Top of Tasks. Focus on What Matters
      </h2>
      <p class="mt-4 max-w-xl text-gray-300 text-md">
        A minimalist task manager for teams and admins — assign, track, and complete with clarity.
      </p>

      <!-- Feature Cards -->
      <div class="mt-12 flex md:flex-row gap-6 justify-center items-center w-full max-w-5xl">
        
        <div class="bg-[#2a2a2a] rounded-lg min-h-[150px] p-6 w-72 shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-2 text-[#e65100]">Tasks Assignment</h3>
          <p class="text-sm text-gray-300">
            Admins assign tasks with deadlines — users get clarity, fast.
          </p>
        </div>

        <div class="bg-[#2a2a2a] rounded-lg min-h-[150px] p-6 w-72 shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-2 text-[#e65100]">Email Notifications</h3>
          <p class="text-sm text-gray-300">
            Get notified instantly when a new task is assigned to you.
          </p>
        </div>

        <div class="bg-[#2a2a2a] rounded-lg min-h-[150px] p-6 w-72 shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-2 text-[#e65100]">Status Updates</h3>
          <p class="text-sm text-gray-300">
            Update task progress from Pending to Completed in one click.
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'LandingPage',
  data() {
    return {
      responsiveWidth: {
        width: '85%',
        margin: '0 auto',
        maxWidth: '100%',
      },
    };
  },
  methods: {
    goToLogin() {
      window.location.href = '/login';
    },
  },
};
</script>
