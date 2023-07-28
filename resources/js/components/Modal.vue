<template>
 <div>
  <div
   v-if="show"
   tabindex="-1"
   aria-hidden="true"
   class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
   <div class="relative mx-auto w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-gray-200 rounded-lg shadow dark:bg-gray-700">
     <!-- Modal header -->
     <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
       <slot name="header"></slot>
      </h3>
      <button
       @click="close"
       type="button"
       class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
      >
       <CancelIcon />
       <span class="sr-only">Close modal</span>
      </button>
     </div>
     <!-- Modal body -->
     <div class="p-6 space-y-6">
      <slot></slot>
     </div>
     <!-- Modal footer -->
     <div
      class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
     >
      <slot name="footer"></slot>
     </div>
    </div>
   </div>
  </div>
 </div>
</template>

<script>
import CancelIcon from '../icons/CancelIcon';

export default {
 props: {
  show: {
   type: Boolean,
   default: false,
  },
 },
 methods: {
  close() {
   this.$emit('close');
  },
 },
 mounted() {},
 components: {
  CancelIcon,
 },
};
</script>

<style></style>
