<template>
  <section class="space-y-4">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-semibold mb-4">Notifications</h2>
      <button
        class="text-sm text-[#e65100] hover:underline"
        @click="markAll"
        v-if="notifications.length"
      >
        Mark all as read
      </button>
    </div>

    <!-- Notification list -->
    <div
      v-for="note in notifications"
      :key="note.id"
      class="p-4 border border-[#3f3f3f] rounded-md shadow-sm flex justify-between"
    >
      <div>
        <p class="text-[0.9rem] mb-1">{{ note.data.title }}</p>
        <p class="text-xs text-[#8b8b8b]">Assigned by: {{ note.data.assigned_by }}</p>
        <p class="text-xs text-[#8b8b8b]">Received: {{ timeAgo(note.created_at) }}</p>
      </div>
      <button
        class="text-xs text-[#e65100] hover:underline"
        @click="markRead(note.id)"
      >
        Mark read
      </button>
    </div>

    <!-- No notifications fallback -->
    <p v-if="!notifications.length" class="text-sm text-gray-500 text-center mt-10">
      You're all caught up ✨
    </p>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: 'NotificationsView',
  data() {
    return {
      notifications: [],
    };
  },
  async mounted() {
    this.notifications = await this.fetchNotifications();
  },
  methods: {
    async fetchNotifications() {
      const res = await axios.get('/dashboard/user/notifications/json');
      return res.data;
    },
    async markRead(id) {
      await axios.post(`/dashboard/user/notifications/${id}/read`);
      this.notifications = this.notifications.filter(n => n.id !== id);
      this.$emit('refresh-badge');
    },
    async markAll() {
      await axios.post('/dashboard/user/notifications/read-all');
      this.notifications = [];
      this.$emit('refresh-badge');
    },
    timeAgo(date) {
      return new Date(date).toLocaleString();
    },
  },
};
</script>
