<template>
 <div>
  <table class="table table-auto border-collapse border border-slate-500">
   <thead>
    <tr>
     <th class="border border-slate-600">#</th>
     <th class="border border-slate-600">Username</th>
     <th class="border border-slate-600">Email</th>
     <th class="border border-slate-600">Phone number</th>
     <th class="border border-slate-600">Role</th>
     <th class="border border-slate-600">Action</th>
    </tr>
   </thead>
   <tbody>
    <tr v-for="(item, index) in data" :key="index">
     <td class="border border-slate-600">
      <p>{{ index + 1 }}</p>
     </td>
     <td class="border border-slate-600">
      <p>{{ item.username }}</p>
     </td>
     <td class="border border-slate-600">
      <p>{{ item.email }}</p>
     </td>
     <td class="border border-slate-600">
      <p>{{ item.phone_number }}</p>
     </td>
     <td class="border border-slate-600">
      <p>{{ item.is_admin }}</p>
     </td>
     <td class="border border-slate-600">
      <div class="lg:w-24 grid grid-cols-2">
       <button type="button" @click="$emit('edit', item)" class="text-blue-900">
        <PenIcon />
       </button>
       <button type="button" @click="$emit('remove', item)" class="text-red-900">
        <TrashIcon />
       </button>
      </div>
     </td>
    </tr>
   </tbody>
  </table>
 </div>
</template>

<script>
import PenIcon from '../icons/PenIcon';
import CheckIcon from '../icons/CheckIcon';
import CancelIcon from '../icons/CancelIcon';
import TrashIcon from '../icons/TrashIcon';

export default {
 components: {
  PenIcon,
  CheckIcon,
  CancelIcon,
  TrashIcon,
 },
 props: {
  data: {
   type: Array,
   default: '',
  },
 },
 mounted() {},
};
</script>

<style></style>
