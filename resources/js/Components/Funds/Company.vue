<script setup>
import {onMounted, ref} from "vue";

let props = defineProps({
  company: Object,
  fund: Object,
})

let edit = ref(false);
let removed = ref(false);
let newCompany = ref('');
let cloned = ref(props.company);

onMounted(() => {
  newCompany.value = props.company.name;
})

// General Scripts
const updateCompany = () => {
  axios
    .patch(route('api.company-update', [props.company.id]), {
      name: newCompany.value
    })
    .then( response => {
      cloned.value = response.data;
      edit.value = false;
    })
}
const deleteCompany = () => {
  axios
    .delete(route('api.company-destroy', [props.company.id, props.fund.id]))
    .then( response => {
      if(response.data === 1) {
        removed.value = true;
        return;
      }

      console.log('We were unable to detach the Company');
    })
}
const resetEdit = () => {
  edit.value = false;
  newCompany.value = props.company.name;
}
</script>

<template>
  <li class="flex items-center justify-between pr-5 leading-6" :class="[edit ? 'py-0' : 'py-2']" v-if="!removed">
    <div class="flex w-0 flex-1 items-center pl-4" v-if="!edit">
      {{ cloned.name }}
    </div>
    <div v-if="edit">
      <input type="text"
             v-model="newCompany"
             class="h-[40px] dark:text-gray-100 dark:bg-gray-800">
    </div>
    <div class="ml-4 flex flex-shrink-0 space-x-4">
      <button type="button"
              v-if="edit"
              @click="updateCompany"
              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
      >Update</button>
      <button type="button"
              v-if="!edit"
              @click="edit = !edit"
              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
      >Edit</button>
      <span class="text-gray-700 dark:text-gray-200" aria-hidden="true">|</span>
      <button type="button"
              v-if="!edit"
              @click.prevent="deleteCompany"
              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
      >Remove</button>
      <button type="button"
              v-if="edit"
              @click.prevent="resetEdit"
              class="bg-transparent hover:text-gray-800 dark:hover:text-gray-400"
      >Cancel</button>
    </div>
  </li>
</template>

<style scoped>

</style>
