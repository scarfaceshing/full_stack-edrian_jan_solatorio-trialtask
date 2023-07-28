<template>
 <div>
  <button
   data-drawer-target="default-sidebar"
   data-drawer-toggle="default-sidebar"
   aria-controls="default-sidebar"
   type="button"
   class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
  >
   <span class="sr-only">Open sidebar</span>
   <HamburgerIcon />
  </button>

  <Sidebar />

  <div class="p-4 sm:ml-64">
   <div class="p-4 rounded-lg">
    <router-view></router-view>
   </div>
  </div>
 </div>
</template>

<script>
import Sidebar from '../components/Sidebar.vue';
import HamburgerIcon from '../icons/HamburgerIcon.vue';

export default {
 components: {
  Sidebar,
  HamburgerIcon,
 },
 data() {
  return {
   username: '',
  };
 },

 methods: {},

 created() {},
};
</script>
