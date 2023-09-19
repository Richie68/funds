<script setup>

import { debounce } from "lodash";
import {ref, watch} from "vue";

let emits = defineEmits(['set-company']);

let company = ref('');
let newCompany = ref(null);
let companies = ref(null);

// General Functions
const findCompanies = (val) => {
  axios.post(route('api.company.search'), { search: val})
    .then( response => {
      companies.value = response.data;
    })
}
const setCompany = (comp) => {
  company.value = '';
  companies.value = null;
  newCompany.value = comp;
  emits('set-company', comp)
}

// Watch
watch(
  company,
  debounce(function (value) {
    findCompanies(value)
  }, 500)
);

</script>

<template>
<div class="relative flex w-full">
  <div class="relative flex w-full" v-if="!newCompany">
    <input class="w-full"
           type="text"
           v-model="company"
           placeholder="Search ...">
    <ul class="absolute border top-10 text-sm max-h-[300px] z-20 bg-white overflow-y-scroll w-full"
        v-if="companies?.length > 0">
      <li v-for="(comp, i) in companies"
          :key="i"
          class="hover:bg-gray-500 hover:text-white cursor-pointer px-2 text-sm"
          @click="setCompany(comp)"
      >
        {{ comp.name }}
      </li>
    </ul>
  </div>
  <div class="flex justify-between w-full" v-else>
    <p>{{ newCompany.name }}</p>
    <button class="text-sm ml-3 border border-gray-600 px-2 bg-gray-700 text-white rounded-lg"
            @click.prevent="newCompany = null">Change
    </button>
  </div>
</div>
</template>

<style scoped>

</style>
