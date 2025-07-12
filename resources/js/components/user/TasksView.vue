<template>
  <div class="space-y-8">
    <!-- Active tasks -->
    <section>
      <h2 class="text-lg font-semibold mb-4">Active Tasks</h2>
      <ul class="space-y-2">
        <li
          v-for="task in activeTasks"
          :key="task.id"
          class="bg-white p-4 rounded-md shadow-sm flex justify-between items-center"
        >
          <div>
            <p class="font-medium">{{ task.title }}</p>
            <p class="text-xs text-gray-500">Due: {{ task.deadline }}</p>
          </div>

          <!-- Status dropdown -->
          <select
            v-model="task.status"
            class="border-gray-300 text-sm rounded"
            @change="updateStatus(task)"
          >
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </li>
      </ul>
    </section>

    <!-- Completed tasks -->
    <section>
      <h2 class="text-lg font-semibold mb-4">Completed Tasks</h2>
      <ul class="space-y-2">
        <li
          v-for="task in completedTasks"
          :key="task.id"
          class="bg-green-50 p-4 rounded-md shadow-sm flex justify-between items-center"
        >
          <p>{{ task.title }}</p>
          <span class="text-xs text-green-700">Completed</span>
        </li>
      </ul>
    </section>
  </div>
</template>

<script>
export default {
  name: 'TasksView',
  data() {
    return {
      tasks: [
        { id: 1, title: 'Finish report', deadline: '2025‑07‑15', status: 'pending' },
        { id: 2, title: 'Update website', deadline: '2025‑07‑18', status: 'in_progress' },
        { id: 3, title: 'Team meeting notes', deadline: '2025‑07‑10', status: 'completed' },
      ],
    };
  },
  computed: {
    activeTasks() {
      return this.tasks.filter(t => t.status !== 'completed');
    },
    completedTasks() {
      return this.tasks.filter(t => t.status === 'completed');
    },
  },
  methods: {
    updateStatus(task) {
      // TODO: call API → update status → move task automatically
    },
  },
};
</script>
