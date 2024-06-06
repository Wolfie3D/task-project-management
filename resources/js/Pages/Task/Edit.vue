<script setup>
import { defineProps, reactive } from 'vue';
import { Head, router, Link} from '@inertiajs/vue3';

const props = defineProps({
  task: {
    type: Object,
    required: true,
  },
  users: {
    type: Object,
    required: true,
  },
});

const form = reactive({
  title: props.task.title,
  created_by: props.task.created_by,
  description: props.task.description,
  status: props.task.status,
  due_date: props.task.due_date,
});

const submit = () => {
  router.put(`/task/${props.task.id}`, form)
};

</script>

<template>
    <div class="container mx-auto p-4">
        <Head :title="task.title" />
      <h2 class="text-2xl font-bold mb-4">Editing: "{{form.title}}"</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input
            type="text"
            id="title"
            v-model="form.title"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
        </div>

        <div class="mb-4">
          <label for="created_by" class="block text-sm font-medium text-gray-700">Created by</label>
          <select
            id="created_by"
            v-model="form.created_by"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          >
            <option value="" disabled>Select a user</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea
            id="description"
            v-model="form.description"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select
            id="status"
            v-model="form.status"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          >
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
          <input
            type="date"
            id="due_date"
            v-model="form.due_date"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
        </div>

        <Link href="/task">
            <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</span>
          </Link>

    <button
    type="submit"
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
  >
    Update Task
  </button>

      </form>
    </div>
  </template>


