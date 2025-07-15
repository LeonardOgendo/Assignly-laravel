<template>
  <div>
    <h2 class="text-xl text-[#e65100] font-semibold mb-4">Highlights</h2>
    
    <section class="flex flex-col sm:flex-row flex-wrap gap-4">
      <div
        v-for="card in cards"
        :key="card.title"
        @click="handleClick(card.title)"
        class="bg-[#222] w-full sm:min-w-[45%] sm:flex-1 mb-5 shadow border border-[#444] p-6 rounded-lg cursor-pointer hover:opacity-90 transition"
      >
        <h3 class="text-sm mb-1">{{ card.title }}</h3>
        <p class="text-3xl font-bold">{{ card.count }}</p>
      </div>
    </section>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  name: 'DashboardView',
  data() {
    return {
      cards: [],
    };
  },
  async mounted() {
    const res = await axios.get('/dashboard/user/metrics/json');
    this.cards = [
      { title: 'Pending', count: res.data.pending },
      { title: 'In Progress', count: res.data.in_progress },
      { title: 'Completed', count: res.data.completed },
      { title: 'Upcoming Deadline', count: res.data.upcoming_deadline ?? 'N/A' },
    ];
  },
  methods: {
    handleClick(title) {
      if (title === 'Completed') {
        this.$router.push('/dashboard/user/tasks/completed');
      } else {
        this.$router.push('/dashboard/user/tasks');
      }
    },
  },
};
</script>
