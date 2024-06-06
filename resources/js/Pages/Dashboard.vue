<script setup>
  import { defineProps } from "vue";
  import { Link, Head, router } from "@inertiajs/vue3";

  const props = defineProps({
    tasks: {
      type: Object,
      required: true,
    },
  });

  const deleteTask = (task) => {
    if (confirm("Are you sure you want to delete this task?")) {
      router.delete(`/task/${task}`);
    }
  };

  const headers = [
    "Title",
    "Created by",
    "Description",
    "Status",
    "Due Date",
    "Actions",
  ];

</script>

<template>
  <Head title="Dashboard" />

  <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="container mx-auto p-4">
          <Link
            href="/dashboard"
            class="text-2xl font-bold mb-4 block"
            >Dashboard</Link
          >
          <Link
            href="task/create"
            class="text-2xl font-bold mb-4 block"
            >Create new Task</Link
          >
          <h2 class="text-2xl font-bold mb-4">All Tasks</h2>

          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead>
                <tr>
                  <th
                    v-for="header in headers"
                    :key="header"
                    class="px-4 py-2 text-left border-b border-gray-200 bg-gray-100 font-semibold text-sm text-gray-700 uppercase"
                  >
                    {{ header }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="task in tasks.data"
                  :key="task.id"
                  class="border-b border-gray-200"
                >
                  <td class="px-4 py-2">
                    <Link
                      :href="`/task/show/${task.id}`"
                      class="text-blue-500"
                      >{{ task.title }}</Link
                    >
                  </td>
                  <td class="px-4 py-2">{{ task.created_by.name }}</td>
                  <td class="px-4 py-2">{{ task.description }}</td>
                  <td class="px-4 py-2">{{ task.status }}</td>
                  <td class="px-4 py-2">{{ task.due_date }}</td>
                  <td class="px-4 py-2">
                    <Link :href="`/task/edit/${task.id}`">
                      <span class="text-blue-500 hover:underline cursor-pointer"
                        >Edit</span
                      >
                    </Link>
                    <button
                      @click="deleteTask(task.id)"
                      class="text-red-500 hover:underline cursor-pointer ml-2"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
