<template>
  <div>
    <h2 class="text-2xl font-semibold mb-4">User Manager</h2>
    <p class="mb-4 text-sm text-gray-600">Manage platform users.</p>

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="w-full table-auto">
        <thead class="bg-gray-100 text-gray-700 text-left">
          <tr>
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Role</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t">
            <td class="p-3">System Admin</td>
            <td class="p-3">admin@cytonn.com</td>
            <td class="p-3"><span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">admin</span></td>
            <td class="p-3">
              <button class="text-sm text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
          <!-- Add more users dynamically -->
        </tbody>
      </table>
    </div>
  </div>
</template>
