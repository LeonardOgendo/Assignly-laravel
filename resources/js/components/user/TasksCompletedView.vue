<!-- resources/js/components/user/TasksCompleted.vue -->
<template>
  <div class="p-6 space-y-4">
    <h2 class="text-2xl font-bold">Completed Tasks</h2>
    <ul class="space-y-2">
      <li
        v-for="task in tasks"
        :key="task.id"
        class="bg-green-50 p-4 rounded-md shadow flex justify-between items-center"
      >
        <p class="font-medium">{{ task.title }}</p>
        <span class="text-xs text-green-700">Completed {{ task.completedAt }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'TasksCompletedView',
  data() {
    return {
      tasks: [
        { id: 3, title: 'Team meeting notes', completedAt: '2025‑07‑10' },
        { id: 4, title: 'Security audit report', completedAt: '2025‑07‑08' },
      ],
    };
  },
};
</script>
