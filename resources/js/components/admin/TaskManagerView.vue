<template>
  <div>
    <h2 class="text-2xl font-semibold mb-4">Task Manager</h2>
    <p class="mb-4 text-sm text-gray-600">Assign, review, and update tasks.</p>

    <!-- Placeholder Task Table -->
    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="w-full table-auto">
        <thead class="bg-gray-100 text-gray-700 text-left">
          <tr>
            <th class="p-3">Task</th>
            <th class="p-3">Assigned To</th>
            <th class="p-3">Status</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t">
            <td class="p-3">Review documentation</td>
            <td class="p-3">Alice</td>
            <td class="p-3">In Progress</td>
            <td class="p-3">
              <button class="text-sm text-blue-600 hover:underline">Edit</button>
              <button class="ml-2 text-sm text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
          <!-- Add more rows dynamically -->
        </tbody>
      </table>
    </div>
  </div>
</template>
