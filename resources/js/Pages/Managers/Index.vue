<script setup>

import {Head, Link} from "@inertiajs/vue3";
import LoaderComponent from "@/Components/LoaderComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";

defineProps({
  managers: Array
})

// General Functions
const getFunds = (funds) => {
  let tempAlias = funds.map( fund => fund.name);
  return tempAlias.join(' | ');
}
</script>

<template>
  <Head>
    <title>Funds Demo App | Ricardo Rojas</title>
  </Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="flex justify-between font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Managers List
      </h2>
    </template>

    <div class="px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto mt-4">
      <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300 bg-white rounded-lg mb-6">
              <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Manager
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Funds</th>
              </tr>
              </thead>
              <tbody class="bg-white">
              <tr v-for="manager in managers" :key="manager.id" class="even:bg-gray-50">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                  {{ manager.name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  {{ getFunds(manager.funds) }}
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>
