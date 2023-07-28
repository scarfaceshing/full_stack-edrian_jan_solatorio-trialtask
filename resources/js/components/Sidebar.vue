<template>
 <aside
  id="default-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidebar"
 >
  <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
   <ul class="space-y-2 font-medium">
    <li>
     <a
      href="javascript:void(0)"
      @click="$router.push({ name: 'welcome' })"
      class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
     >
      <HomeIcon />
      <span class="ml-3">Home</span>
     </a>
    </li>
    <li v-if="user.is_admin === adminRole">
     <a
      href="javascript:void(0)"
      @click="$router.push({ name: 'view_records' })"
      class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
     >
      <UserplusIcon />
      <span class="ml-3">View records</span>
     </a>
    </li>
    <li v-if="user.is_admin === userRole">
     <a
      href="javascript:void(0)"
      @click="$router.push({ name: 'subscribe' })"
      class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
     >
      <BellSlashIcon />
      <span class="ml-3">Unsubscribe</span>
     </a>
    </li>
    <li>
     <button
      @click="logout"
      class="flex items-center p-2 text-gray-900 w-full rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
     >
      <LogoutIcon />
      <span class="ml-3">Logout</span>
     </button>
    </li>
   </ul>
  </div>
 </aside>
</template>

<script>
import HTTP from '../http';
import HomeIcon from '../icons/HomeIcon.vue';
import LogoutIcon from '../icons/LogoutIcon.vue';
import UserplusIcon from '../icons/UserplusIcon.vue';
import BellSlashIcon from '../icons/BellSlashIcon.vue';
import { mapActions, mapGetters } from 'vuex';
import { HTTP_SUCCESS_STATUS, LOGOUT_URL } from '../constants';

const ADMIN = 'ADMIN';
const USER = 'USER';

export default {
 components: {
  HomeIcon,
  LogoutIcon,
  UserplusIcon,
  BellSlashIcon,
 },
 computed: {
  ...mapGetters({
   user: 'auth/getUser',
  }),
 },
 created() {
  this.adminRole = ADMIN;
  this.userRole = USER;
 },
 methods: {
  ...mapActions({
   signOut: 'auth/removeSession',
  }),
  async logout() {
   const data = {};

   await HTTP.post(LOGOUT_URL, data, null)
    .then((response) => {
     if (response.status === HTTP_SUCCESS_STATUS) {
      this.isSubmiting = false;
      this.signOut();
     }
    })
    .catch((error) => {
     if (error.response) {
      this.validate = error.response.data;
      this.isSubmiting = false;
     }
    });
  },
 },
};
</script>

<style></style>
