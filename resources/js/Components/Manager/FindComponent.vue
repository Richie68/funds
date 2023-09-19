<script setup>

import { debounce } from "lodash";
import {ref, watch} from "vue";

let emits = defineEmits(['set-manager']);

let manager = ref('');
let newManager = ref(null);
let managers = ref(null);

// General Functions
const findManagers = (val) => {
  axios.post(route('api.manager.search'), { search: val})
    .then( response => {
      managers.value = response.data;
    })
}
const setManager = (man) => {
  manager.value = '';
  managers.value = null;
  newManager.value = man;
  emits('set-manager', man)
}

// Watch
watch(
  manager,
  debounce(function (value) {
    findManagers(value)
  }, 500)
);

</script>

<template>
<div class="relative flex w-full">
  <div class="relative flex w-full" v-if="!newManager">
    <input class="w-full"
           type="text"
           v-model="manager"
           placeholder="Search ...">
    <ul class="absolute border top-10 text-sm max-h-[300px] z-20 bg-white overflow-y-scroll w-full"
        v-if="manager.length > 0">
      <li v-for="(man, i) in managers"
          :key="i"
          class="hover:bg-gray-500 hover:text-white cursor-pointer px-2 text-sm"
          @click="setManager(man)"
      >
        {{ man.name }}
      </li>
    </ul>
  </div>
  <div class="flex justify-between w-full" v-else>
    <p>{{ newManager.name }}</p>
    <button class="text-sm" @click.prevent="newManager = null">Change</button>
  </div>
</div>
</template>

<style scoped>

</style>
