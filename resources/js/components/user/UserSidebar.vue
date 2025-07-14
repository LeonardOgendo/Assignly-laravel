<template>
  <aside class="w-60">
    <nav class="flex flex-col space-y-[1rem]">
      <router-link
        v-for="item in menu"
        :key="item.to"
        :to="item.to"
        class="px-4 py-2 text-sm font-medium rounded-r-full flex items-center space-x-3 transition"
        :class="isActive(item.to)
          ? 'bg-[#2a2a2a] text-white'
          : 'text-gray-400 hover:bg-[#1f1f1f] hover:text-white'"
      >
        <component :is="item.icon" class="w-5 h-5 mr-2 text-[#e65100]" />
        <span class="text-[0.9rem]">{{ item.label }}</span>

        <span
          v-if="item.badge > 0"
          class="ml-auto bg-[#e65100] ml-2 text-white text-xs rounded-full px-2 py-[2px]"
        >
          {{ item.badge }}
        </span>
      </router-link>
    </nav>
  </aside>
</template>

<script>
import { HomeIcon, ClipboardListIcon, BellIcon } from '@vue-hero-icons/outline'

export default {
  name: 'UserSidebar',
  components: { HomeIcon, ClipboardListIcon, BellIcon },

  data() {
    return {
      menu: [
        { to: '/dashboard/user', label: 'Dashboard', icon: 'HomeIcon', badge: 0 },
        { to: '/dashboard/user/tasks', label: 'My Tasks', icon: 'ClipboardListIcon', badge: 0 },
        { to: '/dashboard/user/notifications', label: 'Notifications', icon: 'BellIcon', badge: 0 },
      ],
    }
  },

  mounted() {
    this.updateNotificationBadge()
  },

  watch: {
    '$route.path'() {
      this.updateNotificationBadge()
    },
  },

  methods: {
    isActive(path) {
      return this.$route.path === path
    },

    async updateNotificationBadge() {
      try {
        const res = await axios.get('/dashboard/user/notifications/json')
        const noteCount = res.data.length
        this.menu = this.menu.map(item => {
          if (item.label === 'Notifications') item.badge = noteCount
          return item
        })
      } catch (err) {
        console.error('Badge fetch failed:', err)
      }
    },
  },
}
</script>
