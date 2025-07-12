<template>
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div v-for="card in cards" :key="card.title" class="bg-white shadow-sm p-6 rounded-lg">
      <h3 class="text-sm text-gray-500 mb-1">{{ card.title }}</h3>
      <p class="text-3xl font-bold">{{ card.count }}</p>
    </div>
  </section>
</template>

<script>
export default {
  name: 'DashboardView',
  data() {
    return {
      cards: [
        { title: 'Pending', count: 2 },
        { title: 'In Progress', count: 5 },
        { title: 'Completed', count: 8 },
        { title: 'Upcoming Deadline', count: '2 days' },
      ],
    };
  },
};
</script>
