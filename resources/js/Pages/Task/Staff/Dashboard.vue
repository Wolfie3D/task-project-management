<script setup>
  import { Link, Head } from "@inertiajs/vue3";
  import { defineProps } from "vue";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  const props = defineProps({
    myTasks: Object,
  });

  const headers = [
    "Title",
    "Description",
    "Status",
    "Due Date",
    "Actions",
  ];

</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">My Tasks</h2>

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
                    v-for="task in props.myTasks"
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
                    <td class="px-4 py-2">{{ task.description }}</td>
                    <td class="px-4 py-2">{{ task.status }}</td>
                    <td class="px-4 py-2">{{ task.due_date }}</td>
                    <td class="px-4 py-2">
                      <Link :href="`/task/edit/${task.id}`">
                        <span
                          class="text-blue-500 hover:underline cursor-pointer"
                          >Edit</span
                        >
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
