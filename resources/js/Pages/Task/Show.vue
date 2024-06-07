<script setup>
  import { defineProps } from "vue";
  import { Head } from "@inertiajs/vue3";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  const props = defineProps({
    task: {
      type: Object,
      required: true,
    },
  });
</script>

<template>
  <Head :title="task.title" />
  <AuthenticatedLayout>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Task Details</h1>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="mb-2">
          <strong class="font-semibold">Title:</strong> {{ task.title }}
        </p>
        <p class="mb-2">
          <strong class="font-semibold">Assigned To:</strong>
          {{ task.assigned_to.name }}
        </p>
        <p class="mb-2">
          <strong class="font-semibold">Description:</strong>
          {{ task.description }}
        </p>
        <p class="mb-2">
          <strong class="font-semibold">Status:</strong> {{ task.status }}
        </p>
        <p class="mb-2">
          <strong class="font-semibold">Due Date:</strong> {{ task.due_date }}
        </p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
