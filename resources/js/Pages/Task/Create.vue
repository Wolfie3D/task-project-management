<script setup>
  import { reactive } from "vue";
  import { router, Head } from "@inertiajs/vue3";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  const form = reactive({
    title: "",
    assigned_to: "",
    description: "",
    status: "pending",
    due_date: "",
  });

  const props = defineProps({
    users: {
      type: Object,
    },
  });

  const submit = () => {
    router.post("/task/store", form);
  };
</script>

<template>
  <Head title="Create Project" />

  <AuthenticatedLayout>
    <div class="container mx-auto p-4">
      <h2 class="text-2xl font-bold mb-4">Create A New Task</h2>
      <form
        @submit.prevent="submit"
        class="max-w-md mx-auto"
      >
        <div class="mb-4">
          <label
            for="title"
            class="block text-sm font-medium text-gray-700"
            >Title</label
          >
          <input
            type="text"
            id="title"
            v-model="form.title"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
        </div>

        <div class="mb-4">
          <label
            for="assigned_to"
            class="block text-sm font-medium text-gray-700"
            >Assigned To</label
          >
          <select
            id="assigned_to"
            v-model="form.assigned_to"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          >
            <option
              value=""
              disabled
            >
              Select a user
            </option>
            <option
              v-for="user in users"
              :key="user.id"
              :value="user.id"
            >
              {{ user.name }}
            </option>
          </select>
        </div>

        <div class="mb-4">
          <label
            for="description"
            class="block text-sm font-medium text-gray-700"
            >Description</label
          >
          <textarea
            id="description"
            v-model="form.description"
            rows="3"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          ></textarea>
        </div>

        <div class="mb-4">
          <label
            for="status"
            class="block text-sm font-medium text-gray-700"
            >Status</label
          >
          <select
            id="status"
            v-model="form.status"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
          >
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <div class="mb-4">
          <label
            for="due_date"
            class="block text-sm font-medium text-gray-700"
            >Due Date</label
          >
          <input
            type="date"
            id="due_date"
            v-model="form.due_date"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
        </div>

        <button
          type="submit"
          class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
