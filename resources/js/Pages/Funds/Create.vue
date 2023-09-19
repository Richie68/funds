<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FindManager from "@/Components/Manager/FindComponent.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import dayjs from "dayjs";

const form = useForm({
  name: '',
  start: null,
  manager_uuid: null,
});

let success = ref(false);
let startDate = ref(null);

// General Functions
const setManager = (e) => {
  form.manager_uuid = e.uuid;
  form.errors.manager_uuid = null;
}
const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  return `${year}-${month}-${day}`;
}
const handleDate = (modelData) => {
  startDate.value = modelData;
  form.start = dayjs(modelData).format('YYYY-MM-DD');
  form.errors.start = null;
}
const submit = () => {
  form.clearErrors();

  if(!form.name || form.name === '') {
    form.errors.name = 'Please provide the name of the Fund';
  }
  if(!form.start || form.start === '') {
    form.errors.start = 'Please provide the start date';
  }
  if(!form.manager_uuid || form.manager_uuid === '') {
    form.errors.manager_uuid = 'Please select a Manager';
  }

  if(Object.keys(form.errors).length > 0) {
    return;
  }

  form.post(route('api.funds.store'), {
    onSuccess: () => {
      form.defaults();
    }
  });
};

</script>

<template>
  <Head>
    <title>Funds Demo App | Ricardo Rojas</title>
  </Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="flex justify-between font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
        Register New Fund
        <Link :href="route('dashboard')"
              class="text-sm bg-gray-700 text-white hover:bg-gray-500 dark:bg-white py-1 px-3 dark:text-gray-800 rounded dark:hover:bg-gray-200">
          Funds List
        </Link>
      </h2>
    </template>

    <div class="max-w-xl mx-auto text-gray-900 dark:text-gray-100 text-xl mt-6">
      <form @submit.prevent="submit" v-if="!success">
        <div>
          <InputLabel for="name" value="Fund Name:" />

          <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            @focusin="form.errors.name = null"
            autofocus
          />

          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <!-- name -->

        <div class="mt-4">
          <InputLabel for="start" value="Start Date:" />

          <VueDatePicker v-model="startDate"
                         :format="format"
                         @update:model-value="handleDate"
          ></VueDatePicker>

          <InputError class="mt-2" :message="form.errors.start" />
        </div>
        <!-- start -->

        <div class="mt-4">
          <InputLabel for="manager_uuid" value="Select Manager:" />

          <FindManager @set-manager="setManager" />

          <InputError class="mt-2" :message="form.errors.manager_uuid" />
        </div>
        <!-- manager -->

        <div class="flex items-center justify-end mt-4">

          <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Register Fund
          </PrimaryButton>
        </div>
        <!-- submit button -->
        <div class="text-sm text-center mt-4">
          * To register Aliases, first you need to Register the Fund
        </div>
      </form>
      <div v-if="success"></div>
    </div>

  </AuthenticatedLayout>
</template>

<style scoped>

</style>
