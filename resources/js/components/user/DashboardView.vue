<template>
  <div>
    <h2 class="text-xl text-[#e65100] font-semibold mb-4">Highlights</h2>
    <section class="flex flex-wrap gap-4">
      <div v-for="card in cards" :key="card.title" class="bg-[#222] flex-1 mb-6 shadow border border-[#444] min-w-[45%] shadow-sm p-6 rounded-lg">
        <h3 class="text-sm mb-1">{{ card.title }}</h3>
        <p class="text-3xl font-bold">{{ card.count }}</p>
      </div>
    </section>
  </div>
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
