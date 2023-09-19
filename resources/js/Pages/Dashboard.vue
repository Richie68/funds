<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import {ref, watch} from "vue";
import { debounce } from "lodash";
import LoaderComponent from "@/Components/LoaderComponent.vue";

let funds = ref(null);
let search = ref(null);
let loading = ref(false);

let props = defineProps({
  funds: Array,
});


// General Functions
const getNameList = (theNames) => {
  if(theNames.length > 0) {
    let tempNames = theNames.map( theName => theName.name);
    return tempNames.join(' | ');
  }

  return 0;
}
const searchFunds = (value) => {
  loading.value = true;
  router.get(
    route("dashboard"),
    { search: value },
    {
      preserveState: true,
      replace: true,
      onSuccess: () => {
        loading.value = false;
      },
    }
  );

}

// Watchers
watch(
  search,
  debounce(function (value) {
    searchFunds(value)
  }, 500)
);
</script>

<template>
  <Head>
    <title>Funds Demo App | Ricardo Rojas</title>
  </Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="flex justify-between font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Funds List
        <Link :href="route('fund.create')"
              class="text-sm bg-gray-700 text-white hover:bg-gray-500 dark:bg-white py-1 px-3 dark:text-gray-800 rounded dark:hover:bg-gray-200">
          New Fund
        </Link>
      </h2>
    </template>

    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
      <div class="relative flex items-center mb-2">
        <input
          v-model="search"
          class="border-wine rounded-sm px-2 outline-none focus:border-main-dark focus:ring-main-dark"
          placeholder="Search..."
          type="search"
        />
        <div class="text-gray-800 dark:text-white ml-4">
          Total Records: <span class="font-semibold">{{ props.funds.length }}</span>
        </div>
        <LoaderComponent
          v-if="loading"
          class="absolute right-0 ml-5 text-gray-800 dark:text-white"
        />
      </div>
      <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300 bg-white">
              <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Name</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fund Manager</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Investing in</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Aliases</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Start Date</th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                  Edit
                </th>
              </tr>
              </thead>
              <tbody class="bg-white">
              <tr v-for="fund in props.funds" :key="fund.id" class="even:bg-gray-50">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                  {{ fund.name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ fund.manager.name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  {{ getNameList(fund.companies) }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ getNameList(fund.aliases) }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ fund.start }}</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                  <Link :href="route('fund.show', fund.uuid)" class="text-gray-600 hover:text-gray-900"
                  >Edit</Link>
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
