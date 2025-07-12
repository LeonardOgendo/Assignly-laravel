<template>
  <section class="space-y-2">
    <div
      v-for="note in notifications"
      :key="note.id"
      class="bg-white p-4 rounded-md shadow-sm flex justify-between"
    >
      <p>
        <span class="font-medium">{{ note.title }}</span>
        <span class="text-xs text-gray-500">· {{ note.time }}</span>
      </p>
      <button class="text-xs text-blue-500" @click="markRead(note.id)">Mark read</button>
    </div>
  </section>
</template>

<script>
export default {
  name: 'NotificationsView',
  data() {
    return {
      notifications: [
        { id: 1, title: 'New task assigned: Update docs', time: '2 h ago' },
        { id: 2, title: 'Deadline in 1 day: Finish report', time: '6 h ago' },
      ],
    };
  },
  methods: {
    markRead(id) {
      this.notifications = this.notifications.filter(n => n.id !== id);
    },
  },
};
</script>
