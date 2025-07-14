<template>
  <section class="space-y-4">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-semibold">Notifications</h2>
      <button
        class="text-sm text-blue-600 hover:underline"
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
      class="bg-white p-4 rounded-md shadow-sm flex justify-between"
    >
      <div>
        <p class="font-medium">{{ note.data.title }}</p>
        <p class="text-xs text-gray-500">Assigned by: {{ note.data.assigned_by }}</p>
        <p class="text-xs text-gray-400">Received: {{ timeAgo(note.created_at) }}</p>
      </div>
      <button
        class="text-xs text-blue-500 hover:underline"
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
