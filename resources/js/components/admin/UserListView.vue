<template>
  <div class="p-6">
    <h2 class="text-2xl font-bold mb-4">All Users</h2>

    <!-- Table -->
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
            <td class="py-2 px-4 border-b space-x-3">
              <button
                @click="openEdit(user)"
                class="text-sm text-indigo-600 hover:underline"
              >
                Edit
              </button>
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

    <!-- Edit Modal -->
    <div
      v-if="editingUser"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Edit User</h3>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input
              v-model="editForm.name"
              type="text"
              class="mt-1 w-full border p-2 rounded"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input
              v-model="editForm.email"
              type="email"
              class="mt-1 w-full border p-2 rounded"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select
              v-model="editForm.role"
              class="mt-1 w-full border p-2 rounded"
            >
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
          <button
            @click="editingUser = null"
            class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200"
          >
            Cancel
          </button>
          <button
            @click="submitEdit"
            class="px-4 py-2 rounded bg-indigo-600 text-gray-800 hover:bg-indigo-700"
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
