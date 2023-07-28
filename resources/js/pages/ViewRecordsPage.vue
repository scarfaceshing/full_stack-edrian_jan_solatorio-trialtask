<template>
 <div>
  <div>
   <button
    @click="create"
    type="button"
    class="text-white w-40 bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
   >
    Add user
   </button>
  </div>
  <div>
   <Modal :show="showModal" @close="showModal = false">
    <template v-slot:header>{{ actionTitle }} user</template>
    <template v-slot:default>
     <form
      @submit.prevent="register"
      class="bg-transparent rounded-lg grid grid-cols-1 w-full space-y-5"
     >
      <div>
       <label for="email" class="block text-lg mb-2 font-medium text-gray-500">Email</label>
       <input
        type="text"
        name="email"
        v-model="form.email"
        class="w-full rounded-lg text-lg border border-gray-100"
       />
       <p class="text-red-500" v-for="(error, index) in validate['email']" v-bind:key="index">
        {{ error }}
       </p>
      </div>
      <div>
       <label for="phone_number" class="block text-lg mb-2 font-medium text-gray-500"
        >Phone Number</label
       >
       <input
        type="tel"
        name="phone_number"
        v-model="form.phoneNumber"
        class="w-full rounded-lg text-lg border border-gray-100"
       />
       <p
        class="text-red-500"
        v-for="(error, index) in validate['phone_number']"
        v-bind:key="index"
       >
        {{ error }}
       </p>
      </div>
      <div>
       <label for="username" class="block text-lg mb-2 font-medium text-gray-500">Username</label>
       <input
        type="text"
        name="username"
        v-model="form.username"
        class="w-full rounded-lg text-lg border border-gray-100"
       />
       <p class="text-red-500" v-for="(error, index) in validate['username']" v-bind:key="index">
        {{ error }}
       </p>
      </div>
      <div>
       <label for="password" class="block text-lg mb-2 font-medium text-gray-500">Password</label>
       <input
        type="password"
        name="password"
        v-model="form.password"
        class="w-full rounded-lg text-lg border border-gray-100"
       />
       <p class="text-red-500" v-for="(error, index) in validate['password']" v-bind:key="index">
        {{ error }}
       </p>
      </div>
      <div class="mb-3">
       <label for="password" class="block text-lg mb-2 font-medium text-gray-500"
        >Confirm Password</label
       >
       <input
        type="password"
        name="confirm_password"
        v-model="form.confirmPassword"
        class="w-full rounded-lg text-lg border border-gray-100"
       />
       <p
        class="text-red-500"
        v-for="(error, index) in validate['confirm_password']"
        v-bind:key="index"
       >
        {{ error }}
       </p>
      </div>
      <div class="mb-3">
       <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        >Role</label
       >
       <select
        ref="role"
        v-model="form.role"
        id="role"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
       >
        <option value="" selected class="bg-white">Choose a role</option>
        <option value="ADMIN">Admin</option>
        <option value="USER">User</option>
       </select>
       <p
        class="text-red-500"
        v-for="(error, index) in validate['confirm_password']"
        v-bind:key="index"
       >
        {{ error }}
       </p>
      </div>
     </form>
    </template>
    <template v-slot:footer>
     <button
      @click="submit"
      type="button"
      class="text-white bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
     >
      Save
     </button>
     <button
      @click="showModal = false"
      type="button"
      class="text-black bg-white rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5"
     >
      Cancel
     </button>
    </template>
   </Modal>
   <Modal :show="showDialog" @close="showDialog = false">
    <template v-slot:header>{{ actionTitle }} user</template>
    <template v-slot:default>
     <p class="text-white">Are you sure to delete ? {{ form.username }}</p>
    </template>
    <template v-slot:footer>
     <button
      @click="submit"
      type="button"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
     >
      Save
     </button>
     <button
      @click="showDialog = false"
      type="button"
      class="text-gray-200 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
     >
      Cancel
     </button>
    </template>
   </Modal>
   <Table :data="usersData" @edit="edit" @remove="remove" />
  </div>
 </div>
</template>

<script>
import Button from '../components/Button';
import HTTP from '../http';
import Table from '../components/Table';
import Modal from '../components/Modal';
import {
 HTTP_SUCCESS_STATUS,
 USER_URL,
 CREATE_ACTION,
 UPDATE_ACTION,
 DELETE_ACTION,
} from '../constants';

const FORM = {
 email: '',
 username: '',
 password: '',
 phoneNumber: '',
 confirmPassword: '',
};

export default {
 components: {
  Button,
  Table,
  Modal,
 },
 data() {
  return {
   actionType: '',
   form: FORM,
   usersData: [],
   validate: [],
   showModal: false,
   showDialog: false,
  };
 },
 computed: {
  actionTitle() {
   const capitalized = this.actionType.charAt(0) + this.actionType.slice(1).toLowerCase();
   return capitalized;
  },
 },
 methods: {
  create() {
   this.validate = [];
   this.showModal = true;
   this.actionType = CREATE_ACTION;
   this.form = FORM;
   this.form.role = '';
  },
  edit(data) {
   this.validate = [];
   this.showModal = true;
   this.actionType = UPDATE_ACTION;

   this.form = {
    id: data.id,
    username: data.username,
    email: data.email,
    phoneNumber: data.phone_number,
    role: data.is_admin,
   };
  },
  remove(data) {
   this.showDialog = true;
   this.actionType = DELETE_ACTION;
   this.form = {
    id: data.id,
    username: data.username,
   };
  },
  submit() {
   const data = {
    username: this.form.username,
    email: this.form.email,
    password: this.form.password,
    phone_number: this.form.phoneNumber,
    password_confirmation: this.form.confirmPassword,
    role: this.form.role,
   };

   if (this.actionType === CREATE_ACTION) {
    HTTP.post(USER_URL, data)
     .then(({ status, data }) => {
      if (status === HTTP_SUCCESS_STATUS) {
       this.form = FORM;
       this.showModal = false;
       this.loadUser();
      }
     })
     .catch((error) => {
      if (error.response) {
       this.validate = error.response.data.errors;
      }
     });
   } else if (this.actionType === UPDATE_ACTION) {
    HTTP.put(`${USER_URL}/${this.form.id}`, data)
     .then(({ status, data }) => {
      if (status === HTTP_SUCCESS_STATUS) {
       this.form = FORM;
       this.showModal = false;
       this.loadUser();
      }
     })
     .catch((error) => {
      if (error.response) {
       this.validate = error.response.data.errors;
      }
     });
   } else if (this.actionType === DELETE_ACTION) {
    HTTP.delete(`${USER_URL}/${this.form.id}`)
     .then(({ status, data }) => {
      if (status === HTTP_SUCCESS_STATUS) {
       this.form = FORM;
       this.showDialog = false;
       this.loadUser();
      }
     })
     .catch((error) => {
      if (error.response) {
       this.validate = error.response.data.errors;
      }
     });
   }
  },

  loadUser() {
   HTTP.get(USER_URL)
    .then(({ status, data }) => {
     if (status === HTTP_SUCCESS_STATUS) {
      this.usersData = data;
     }
    })
    .catch((error) => {
     console.log(error);
    });
  },
 },
 mounted() {
  this.loadUser();
 },
};
</script>

<style></style>
