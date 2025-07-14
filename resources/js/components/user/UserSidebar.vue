<template>
  <aside class="w-60 bg-white shadow-md">
    <nav class="mt-8 flex flex-col space-y-1">
      <router-link
        v-for="item in menu"
        :key="item.to"
        :to="item.to"
        class="px-6 py-2 text-sm font-medium rounded-r-full"
        :class="isActive(item.to) ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50'"
      >
        {{ item.label }}
        <span v-if="item.badge > 0" class="ml-2 bg-gray-800 text-white text-xs rounded-full px-2">
          {{ item.badge }}
        </span>
      </router-link>
    </nav>
  </aside>
</template>

<script>
export default {
  name: 'UserSidebar',
  data() {
    return {
      menu: [
        { to: '/dashboard/user', label: 'Dashboard', badge: 0 },
        { to: '/dashboard/user/tasks', label: 'My Tasks', badge: 0 },
        { to: '/dashboard/user/notifications', label: 'Notifications', badge: 0 },
      ],
    };
  },
  mounted() {
    this.updateNotificationBadge();
  },
  watch: {
    '$route.path'() {
      this.updateNotificationBadge();
    },
  },
  methods: {
    isActive(path) {
      return this.$route.path === path;
    },
    async updateNotificationBadge() {
      try {
        const res = await axios.get('/dashboard/user/notifications/json');
        const noteCount = res.data.length;
        this.menu = this.menu.map(item => {
          if (item.label === 'Notifications') item.badge = noteCount;
          return item;
        });
      } catch (err) {
        console.error('Badge fetch failed:', err);
      }
    },
  },
};
</script>

