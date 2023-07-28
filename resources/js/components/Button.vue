<template>
 <button :class="className">
  <div v-if="isLoading" class="flex">
   <SpinnerIcon />
   <span class="pl-2">Processing...</span>
  </div>
  <div v-else>
   <span>{{ this.title }}</span>
  </div>
 </button>
</template>

<script>
import SpinnerIcon from '../icons/Spinner.vue';

export default {
 components: {
  SpinnerIcon,
 },
 props: {
  isLoading: {
   type: Boolean,
   default: false,
  },
  title: {
   type: String,
   default: 'button',
  },
  className: {
   type: String,
   default: 'w-full bg-zinc-900 py-2 rounded-lg text-white flex items-center justify-center',
  },
 },
};
</script>

<style></style>
