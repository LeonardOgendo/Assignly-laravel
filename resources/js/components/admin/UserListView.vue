<template>
  <div>
    <h2 class="text-xl font-bold mb-4 text-[#e65100]">All Users</h2>

    <!-- User Table -->
    <div class="overflow-x-auto border border-[#3f3f3f] rounded-md shadow">
      <table class="w-full bg-transparent table-auto text-xs md:text-sm text-white">
        <thead class="bg-[#e65100] text-white uppercase text-[0.65rem] md:text-[0.75rem]">
          <tr>
            <th class="p-2 md:p-3 text-left">#</th>
            <th class="p-2 md:p-3 text-left">Name</th>
            <th class="p-2 md:p-3 text-left">Email</th>
            <th class="p-2 md:p-3 text-left">Role</th>
            <th class="p-2 md:p-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(user, index) in users"
            :key="user.id"
            class="border-t border-[#444] hover:bg-[#2f2f2f] transition"
          >
            <td class="p-2 md:p-3 text-gray-400">{{ index + 1 }}</td>
            <td class="p-2 md:p-3">{{ user.name }}</td>
            <td class="p-2 md:p-3">{{ user.email }}</td>
            <td class="p-2 md:p-3">
              <span
                :class="[
                  'text-[0.65rem] md:text-xs px-2 py-1 rounded font-medium',
                  user.role === 'admin'
                    ? 'bg-green-600/20 text-green-400 border border-green-400'
                    : 'bg-blue-600/20 text-blue-400 border border-blue-400',
                ]"
              >
                {{ user.role }}
              </span>
            </td>
            <td class="p-2 md:p-3 text-right space-x-2 md:space-x-4">
              <button
                @click="openEdit(user)"
                class="text-blue-500 hover:underline hover:text-indigo-300 transition"
              >
                Edit
              </button>
              <button
                @click="handleDelete(user.id)"
                class="text-[#fd4236] hover:underline transition"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  <!-- Edit Modal -->
<div
  v-if="editingUser"
  class="fixed inset-0 z-50 flex items-center justify-center px-4 py-8 bg-black/40 backdrop-blur-sm"
>
  <!-- Opaque modal card (only around content) -->
  <div class="bg-[#1f1f1f]/90 backdrop-blur-md text-white border border-[#555] shadow-lg rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
    <h3 class="text-lg text-[#e65100] font-semibold mb-4">Edit User</h3>

    <div class="space-y-4">
      <div>
        <label class="block text-sm text-gray-300 mb-1">Name</label>
        <input
          v-model="editForm.name"
          type="text"
          class="w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded text-sm"
        />
      </div>

      <div>
        <label class="block text-sm text-gray-300 mb-1">Email</label>
        <input
          v-model="editForm.email"
          type="email"
          class="w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded text-sm"
        />
      </div>

      <div>
        <label class="block text-sm text-gray-300 mb-1">Role</label>
        <select
          v-model="editForm.role"
          class="w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded text-sm"
        >
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
      <button
        @click="editingUser = null"
        class="px-4 py-2 rounded bg-[#444] text-gray-200 hover:bg-[#555] transition"
      >
        Cancel
      </button>
      <button
        @click="submitEdit"
        class="px-4 py-2 rounded bg-[#e65100] text-white hover:bg-[#2e2e2e] transition"
      >
        Save
      </button>
    </div>
  </div>
</div>


  </div>
</template>


<script>
export default {
  name: 'UserListView',
  data() {
    return {
      users: [],
      editingUser: null,
      editForm: {
        name: '',
        email: '',
        role: 'user',
      },
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
      } catch (error) {
        console.error('DELETE /admin/users:', error.response || error);
        alert('Error deleting user.');
      }
    },
    openEdit(user) {
      this.editingUser = user;
      this.editForm = { ...user };
    },
    async submitEdit() {
      try {
        await axios.put(`/admin/users/${this.editingUser.id}`, this.editForm);
        await this.fetchUsers(); // refresh table
        this.editingUser = null;
      } catch (error) {
        console.error('PUT /admin/users:', error.response || error);
        alert('Error updating user.');
      }
    },
  },
};
</script>
