<template>
  <div>
    <h2 class="text-xl font-bold mb-4 text-white">All Users</h2>

    <!-- Table -->
    <div class="overflow-x-auto border border-[#777] rounded-md">
      <table class="min-w-full text-sm bg-transparent text-white table-fixed">
        <thead>
          <tr class="bg-[#333] text-gray-200">
            <th class="py-3 px-4 border-b border-[#555] text-left w-12">#</th>
            <th class="py-3 px-4 border-b border-[#555] text-left">Name</th>
            <th class="py-3 px-4 border-b border-[#555] text-left">Email</th>
            <th class="py-3 px-4 border-b border-[#555] text-left w-32">Role</th>
            <th class="py-3 px-4 border-b border-[#555] text-left w-36">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(user, index) in users"
            :key="user.id"
            class="hover:bg-[#2f2f2f] transition"
          >
            <td class="py-3 px-4 border-b border-[#444]">{{ index + 1 }}</td>
            <td class="py-3 px-4 border-b border-[#444]">{{ user.name }}</td>
            <td class="py-3 px-4 border-b border-[#444]">{{ user.email }}</td>
            <td class="py-3 px-4 border-b border-[#444]">
              <span
                :class="[
                  'text-xs px-2 py-1 rounded font-medium',
                  user.role === 'admin'
                    ? 'bg-green-600/20 text-green-400 border border-green-400'
                    : 'bg-blue-600/20 text-blue-400 border border-blue-400',
                ]"
              >
                {{ user.role }}
              </span>
            </td>
            <td class="py-3 px-4 border-b border-[#444]">
              <div class="flex gap-4">
                <button
                  @click="openEdit(user)"
                  class="text-indigo-400 hover:underline hover:text-indigo-300 transition"
                >
                  Edit
                </button>
                <button
                  @click="handleDelete(user.id)"
                  class="text-red-400 hover:underline hover:text-red-300 transition"
                >
                  Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Edit Modal -->
    <div
      v-if="editingUser"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-[#1f1f1f] text-white rounded-lg p-6 w-full max-w-md border border-[#555] shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Edit User</h3>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-300">Name</label>
            <input
              v-model="editForm.name"
              type="text"
              class="mt-1 w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-300">Email</label>
            <input
              v-model="editForm.email"
              type="email"
              class="mt-1 w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-300">Role</label>
            <select
              v-model="editForm.role"
              class="mt-1 w-full bg-[#c2c2c2] text-black border border-gray-400 px-3 py-2 rounded"
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
            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition"
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
