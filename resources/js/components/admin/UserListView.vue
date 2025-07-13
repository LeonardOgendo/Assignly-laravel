<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-4">All Users</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border">
        <thead>
          <tr class="bg-gray-100 text-left">
            <th class="py-2 px-4 border-b">#</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Role</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(user, index) in users"
            :key="user.id"
            class="hover:bg-gray-50"
          >
            <td class="py-2 px-4 border-b">{{ index + 1 }}</td>
            <td class="py-2 px-4 border-b">{{ user.name }}</td>
            <td class="py-2 px-4 border-b">{{ user.email }}</td>
            <td class="py-2 px-4 border-b">
              <span
                :class="[
                  'text-xs px-2 py-1 rounded',
                  user.role === 'admin'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-blue-100 text-blue-700',
                ]"
              >
                {{ user.role }}
              </span>
            </td>
            <td class="py-2 px-4 border-b">
              <button
                @click="handleDelete(user.id)"
                class="text-sm text-red-600 hover:underline"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserListView',
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/admin/users/list');
        this.users = response.data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async handleDelete(userId) {
      const confirmed = confirm('Are you sure you want to delete this user?');
      if (!confirmed) return;

      try {
        await axios.delete(`/admin/users/${userId}`);
        this.users = this.users.filter((user) => user.id !== userId);
        console.log(`User ${userId} deleted successfully.`);
      } catch (error) {
         console.error('DELETE /admin/users:', {
          status:  error.response?.status,
          data:    error.response?.data,
          headers: error.response?.headers,
        });
        alert('An error occurred while deleting the user.');
      }
    },
  }
};
</script>
