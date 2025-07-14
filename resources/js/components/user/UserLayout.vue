<template>
  <div class="min-h-screen text-white flex flex-col w-full" :style="responsiveWidth">
    <!-- Top Bar -->
    <header class="bg-[#1e1e1e] py-4 px-6 flex justify-between items-center mb-3 shadow-sm">
      <h1 class="text-xl font-bold">A<span style="letter-spacing: -0.15em">ssig</span><span class="text-[#e65100]">nly</span></h1>

      <!-- User Profile Area -->
      <div class="relative" @click="toggleDropdown">
        <div class="flex items-center space-x-2 cursor-pointer">
          <svg class="w-5 h-5 text-white bg-[#e65100] p-1 rounded" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM2 18a8 8 0 1116 0H2z" />
          </svg>

          <span class="text-white ml-2">{{ user.name }}</span>

          <svg
            class="w-4 h-4 text-white transform transition-transform duration-200"
            :class="dropdownOpen ? 'rotate-90' : 'rotate-0'"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z"
              clip-rule="evenodd"
            />
          </svg>
        </div>

        <!-- Dropdown -->
        <div
          v-if="dropdownOpen"
          class="absolute right-0 mt-2 w-32 bg-[#2a2a2a] border border-gray-700 rounded shadow-lg z-50"
        >
          <button
            @click="logout"
            class="w-full text-left px-4 py-2 text-sm hover:bg-red-600 rounded"
          >
            Logout
          </button>
        </div>
      </div>
    </header>

    <!-- Layout Body -->
    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-64 bg-[#1b1b1b] flex flex-col py-6 px-4">
        <user-sidebar />
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6 h-[85vh] overflow-y-auto bg-[#2a2a2a] rounded-lg shadow-lg">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import UserSidebar from './UserSidebar.vue'

export default {
  name: 'UserLayout',
  components: { UserSidebar },

  data() {
    return {
      responsiveWidth: {
        width: '95%',
        margin: '0 auto',
        maxWidth: '100%',
      },
      dropdownOpen: false,
      user: {
        name: window.Laravel?.user?.name || 'User',
      },
    }
  },

  mounted() {
    this.updateMaxWidth()
    window.addEventListener('resize', this.updateMaxWidth)
  },

  beforeDestroy() {
    window.removeEventListener('resize', this.updateMaxWidth)
  },

  methods: {
    updateMaxWidth() {
      const screenWidth = window.innerWidth
      this.responsiveWidth.maxWidth = screenWidth >= 768 ? '90%' : '95%'
    },

    toggleDropdown() {
      this.dropdownOpen = !this.dropdownOpen
    },

    async logout() {
      try {
        await axios.post('/logout')
        window.location.href = '/'
      } catch (error) {
        console.error('Logout failed:', error)
        alert('Logout failed. Please try again.')
      }
    },
  },
}
</script>
