<script setup>

import dayjs from "dayjs";
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AliasShow from "@/Components/Funds/Alias.vue";
import CompanyShow from "@/Components/Funds/Company.vue";
import FindManager from "@/Components/Manager/FindComponent.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

import {onMounted, ref} from "vue";
import LoaderComponent from "@/Components/LoaderComponent.vue";
import FindCompanyComponent from "@/Components/Company/FindCompanyComponent.vue";

let props = defineProps({
  fund: Object,
})

let form = useForm({
  name: '',
  manager: '',
  start: '',
  aliases: []
});

let newAlias = ref('');
let addNewAlias = ref(false);
let company = ref(null);
let addNewCompany = ref(false);
let newCompany = ref('');
let edit = ref(false);
let startDate = ref(new Date());
let loadingNewAlias = ref(false);

onMounted( () => {
  form.name = props.fund.name;
  form.manager_uuid = props.fund.manager_uuid;
  form.manager_name = props.fund.manager.name;
  form.start = props.fund.start;
})

// General Functions
const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  return `${year}-${month}-${day}`;
}
const handleDate = (modelData) => {
  startDate.value = modelData;
  form.start = dayjs(modelData).format('YYYY-MM-DD');
}
const submitNewAlias = () => {
  loadingNewAlias.value = true;
  axios
    .post(route('api.funds.new-alias', [props.fund.id]), { name: newAlias.value })
    .then(response => {
      if(response.data === 1) {
        loadingNewAlias.value = false;
        router.visit(route("fund.show", props.fund.uuid));
        return;
      }

      console.log('Something went wrong!!');
    })
}
const update = () => {
  axios.patch(route('api.funds.update', props.fund.uuid), {
    name: form.name,
    start: form.start,
    manager_uuid: form.manager_uuid,
  })
    .then( response => {
      router.visit(route("fund.show", props.fund.uuid));
    })
}
const setManager = (e) => {
  form.manager_uuid = e.uuid;
}
const setCompany = (e) => {
  company.value = e.id;
}
const submitNewCompany = () => {
  axios
    .post(route('api.funds.new-company', [props.fund.id, company.value]))
    .then(response => {
      if(response.data === 1) {
        router.visit(route("fund.show", props.fund.uuid));
        return;
      }

      console.log('Something went wrong!!');
    })
}

</script>

<template>
  <Head>
    <title>Funds Demo App | Ricardo Rojas</title>
  </Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="flex justify-between font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
        Funds Details
        <Link :href="route('dashboard')"
              class="text-sm bg-gray-700 text-white hover:bg-gray-500 dark:bg-white py-1 px-3 dark:text-gray-800 rounded dark:hover:bg-gray-200">
          Funds List
        </Link>
      </h2>
    </template>

    <div class="max-w-3xl mx-auto text-gray-900 dark:text-gray-100 text-lg">
      <div class="flex justify-end py-2">
        <button
          class="text-sm mr-4 bg-blue-800 text-white dark:bg-white py-1 px-3 dark:text-blue-800 rounded dark:hover:bg-blue-200"
          @click="update"
          v-if="edit"
        >
          <span>Update</span>
        </button>
        <button
          class="text-sm bg-gray-800 text-white dark:bg-white py-1 px-3 dark:text-gray-800 rounded dark:hover:bg-gray-200"
          @click="edit = !edit"
        >
          <span v-if="!edit">Edit</span>
          <span v-if="edit">Cancel</span>
        </button>
      </div>
      <div class="border-t border-b border-gray-800 dark:border-gray-100">
        <dl class="divide-y divide-gray-800 dark:divide-gray-100">
          <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="font-medium leading-6">Fund Name</dt>
            <dd class="mt-1 flex leading-6 sm:col-span-2 sm:mt-0">
              <span class="flex-grow text-lg" v-if="!edit">{{ fund.name }}</span>
              <input type="text" v-if="edit" v-model="form.name">
            </dd>
          </div>
          <!-- name -->
          <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="font-medium leading-6">Manager</dt>
            <dd class="mt-1 flex leading-6 sm:col-span-2 sm:mt-0 relative" v-if="fund.manager">
              <span class="flex-grow text-lg" v-if="!edit">{{ fund.manager?.name }}</span>
              <FindManager @set-manager="setManager" v-if="edit" />
            </dd>
          </div>
          <!-- manager -->
          <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="font-medium leading-6">Start Date</dt>
            <dd class="mt-1 flex leading-6 sm:col-span-2 sm:mt-0">
              <span class="flex-grow text-lg" v-if="!edit">{{ fund.start }}</span>
              <div v-if="edit">
                <VueDatePicker v-model="startDate"
                               :format="format"
                               @update:model-value="handleDate"
                ></VueDatePicker>
              </div>
            </dd>
          </div>
          <!-- start date -->
          <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="font-medium leading-6">Aliases</dt>
            <dd class="mt-1 leading-6 sm:col-span-2 sm:mt-0">
              <ul role="list"
                  class="divide-y divide-gray-800 dark:divide-gray-100 rounded-md border border-gray-700 dark:border-gray-200 overflow-hidden">
                <AliasShow :alias="alias"
                           :fund="fund"
                           v-for="(alias, i) in fund.aliases"
                           :key="i" />
                <li class="flex items-center justify-between pr-5 leading-6 min-h-[40px]">

                  <div class="flex items-center">
                    <input type="text"
                           v-model="newAlias"
                           v-if="addNewAlias"
                           class="h-[40px] dark:text-gray-100 dark:bg-gray-800">
                    <LoaderComponent v-if="loadingNewAlias" class="ml-4" />
                  </div>
                  <div class="ml-4 flex flex-shrink-0 space-x-4">
                    <button type="button"
                            v-if="!addNewAlias"
                            @click.prevent="addNewAlias = true"
                            class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                    >New</button>
                    <div v-if="addNewAlias">
                      <button type="button"
                              @click.prevent="submitNewAlias"
                              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                      >Add</button> |
                      <button type="button"
                              @click.prevent="addNewAlias = false"
                              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                      >Cancel</button>
                    </div>
                  </div>
                </li>
              </ul>
            </dd>
          </div>
          <!-- aliases -->
          <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="font-medium leading-6">Investing in the following Companies</dt>
            <dd class="mt-1 leading-6 sm:col-span-2 sm:mt-0">
              <ul role="list"
                  class="divide-y divide-gray-800 dark:divide-gray-100 rounded-md border border-gray-700 dark:border-gray-200">
                <CompanyShow :fund="fund"
                           :company="company"
                           v-for="(company, i) in fund.companies"
                           :key="i" />
                <li class="flex items-center justify-between pr-5 leading-6 min-h-[40px]">

                  <div class="flex items-center relative">
                    <FindCompanyComponent @set-company="setCompany" v-if="addNewCompany" />
                  </div>
                  <div class="ml-4 flex flex-shrink-0 space-x-4">
                    <button type="button"
                            v-if="!addNewCompany"
                            @click.prevent="addNewCompany = true"
                            class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                    >New</button>
                    <div v-if="addNewCompany">
                      <button type="button"
                              @click.prevent="submitNewCompany"
                              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                      >Add</button> |
                      <button type="button"
                              @click.prevent="addNewCompany = false"
                              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
                      >Cancel</button>
                    </div>
                  </div>
                </li>
              </ul>
            </dd>
          </div>
          <!-- Companies -->
        </dl>
      </div>
    </div>

  </AuthenticatedLayout>
</template>

<style scoped>

</style>
