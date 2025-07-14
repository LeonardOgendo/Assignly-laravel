<template>
  <div
    class="min-h-screen text-white flex flex-col w-full"
    :style="responsiveWidth"
  >
    <!-- Top Nav -->
    <header class="bg-[#1e1e1e] py-4 px-6 flex justify-between items-center shadow-sm mb-3">
      <div class="flex">
        <h1 class="text-xl font-bold">A<span style="letter-spacing: -0.15em">ssig</span><span class="text-[#e65100]">nly</span></h1>
        <span class="ml-[6.8rem] border-b-2 border-[#e65100] pb-3 font-bold mt-1">Admin <span class="text-[#e65100]">Dashboard</span></span>
      </div>
      <!-- User profile area-->
      <div class="relative" @click="toggleDropdown">
        <div class="flex items-center space-x-2 cursor-pointer">
  
          <svg class="w-5 h-5 text-white bg-[#e65100] p-1 rounded" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM2 18a8 8 0 1116 0H2z" />
          </svg>

          <span class="text-white ml-2">{{ user.first_name }}</span>

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

        <!-- Dropdown Menu -->
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

    <!-- Main Area -->
    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-64 bg-[#1b1b1b] flex flex-col py-6 px-4">
        <nav class="space-y-[1rem]">
          <router-link
            to="/dashboard/admin"
            exact
            class="flex items-center space-x-3 px-3 py-2 rounded hover:bg-gray-800"
          >
            <HomeIcon class="w-5 h-5 text-[#e65100]" />
            <span class="ml-3">Dashboard</span>
          </router-link>

          <router-link
            to="/dashboard/admin/tasks"
            class="flex items-center space-x-3 px-3 py-2 rounded hover:bg-gray-800"
          >
            <ClipboardListIcon class="w-5 h-5 text-[#e65100]" />
            <span class="ml-3">Manage Tasks</span>
          </router-link>

          <router-link
            to="/dashboard/admin/users"
            class="flex items-center space-x-3 px-3 py-2 rounded hover:bg-gray-800"
          >
            <UsersIcon class="w-5 h-5 text-[#e65100]" />
            <span class="ml-3">Manage Users</span>
          </router-link>
        </nav>
      </aside>

      <!-- Main Content -->
      <main
        class="flex-1 p-6 h-[85vh] overflow-y-auto bg-[#2a2a2a] rounded-lg shadow-lg"
      >
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { HomeIcon, ClipboardListIcon, UsersIcon } from '@vue-hero-icons/outline'

export default {
  name: 'AdminLayout',
  components: { HomeIcon, ClipboardListIcon, UsersIcon },
  
  data() {
    return {
      responsiveWidth: {
        width: '95%',
        margin: '0 auto',
        maxWidth: '100%',
      },
      dropdownOpen: false,
      user: {
        first_name: window.Laravel?.user?.name || 'Admin',
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
