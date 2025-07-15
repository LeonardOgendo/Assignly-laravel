<template>
  <div class="min-h-screen text-white flex flex-col w-full" :style="responsiveWidth">
    
    <!-- Top Bar -->
    <header class="mb-4 py-4 px-4 md:px-6 flex justify-between items-center shadow-sm relative">
      
    <!-- Brand -->
      <div class="flex items-center space-x-4 min-w-0 flex-shrink-0">
        <div>
        <h1 class="text-lg md:text-xl font-bold whitespace-nowrap truncate">
          A<span style="letter-spacing: -0.15em">ssig</span><span class="text-[#e65100]">nly</span>
        </h1>
        
        <div class="hidden md:block ml-[15rem] items-end space-x-2 h-[3px] min-w-[100px] bg-[#e65100]"></div>

        </div>

        <!-- Hamburger -->
        <button @click="toggleMobileSidebar" class="md:hidden focus:outline-none">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- User profile area -->
      <div class="relative flex-shrink-0" @click="toggleDropdown">
        <div class="flex items-center space-x-1 md:space-x-2 cursor-pointer">
          <svg class="w-6 h-6 text-white bg-[#e65100] p-1 rounded" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM2 18a8 8 0 1116 0H2z" />
          </svg>
          <span class="text-white text-sm truncate ml-1 max-w-[6rem] md:max-w-none">{{ user.name }}</span>
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
          <button @click="logout" class="w-full text-left px-4 py-1 text-sm hover:bg-red-600 rounded">
            Logout
          </button>
        </div>
      </div>
    </header>

    <!-- Layout Body -->
    <div class="flex flex-1 relative">
      <!-- Sidebar (Desktop) -->
      <aside class="hidden md:flex w-50 flex-col py-6 px-2">
        <user-sidebar />
      </aside>

      <!-- Backdrop (Mobile only) -->
      <div
        v-if="mobileSidebarOpen"
        class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"
        @click="toggleMobileSidebar"
      />

      <!-- Sidebar (Mobile Drawer) -->
      <transition name="slide">
        <aside
          v-if="mobileSidebarOpen"
          class="fixed z-50 top-16 left-0 w-64 h-full bg-[#1b1b1bcc] p-4 shadow-lg md:hidden"
        >
          <user-sidebar />
        </aside>
      </transition>

      <!-- Main Content -->
      <main class="flex-1 p-4 md:p-6 h-[85vh] overflow-y-auto bg-[#2a2a2a] rounded-lg shadow-lg">
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
      dropdownOpen: false,
      mobileSidebarOpen: false,
      user: {
        name: window.Laravel?.user?.name || 'User',
      },
      responsiveWidth: {
        width: '95%',
        margin: '0 auto',
        maxWidth: '100%',
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
    toggleDropdown() {
      this.dropdownOpen = !this.dropdownOpen
    },
    toggleMobileSidebar() {
      this.mobileSidebarOpen = !this.mobileSidebarOpen
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
    updateMaxWidth() {
      const screenWidth = window.innerWidth
      this.responsiveWidth.maxWidth = screenWidth >= 768 ? '90%' : '95%'
    },
  },
}
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-enter,
.slide-leave-to {
  transform: translateX(-100%);
}
</style>
