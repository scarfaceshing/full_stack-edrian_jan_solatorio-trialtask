<template>
 <div class="md:container">
  <section class="bg-zinc-900 flex flex-col items-center justify-center mx-auto h-full">
   <h1 class="text-7xl mb-5 font-black text-zinc-100">Login</h1>
   <form
    @submit.prevent="login"
    class="bg-gray-300 rounded-lg grid grid-cols-1 sm:w-96 px-10 py-10 space-y-5 xs:w-full"
   >
    <p class="text-red-500">
     {{ message }}
    </p>
    <div>
     <label for="username" class="block text-lg mb-2 font-medium text-zinc-900">Username</label>
     <input
      type="text"
      name="username"
      v-model="username"
      class="w-full rounded-lg text-lg border border-gray-100"
     />
     <p class="text-red-500" v-for="(error, index) in validate['username']" v-bind:key="index">
      {{ error }}
     </p>
    </div>
    <div class="mb-3">
     <label for="password" class="block text-lg mb-2 font-medium text-zinc-900">Password</label>
     <input
      type="password"
      name="password"
      v-model="password"
      class="w-full rounded-lg text-lg border border-gray-100"
     />
     <p class="text-red-500" v-for="(error, index) in validate['password']" v-bind:key="index">
      {{ error }}
     </p>
    </div>
    <div>
     <Button :is-loading="isSubmiting" title="Sign in" />
    </div>
    <div>
     <p class="font-sm text-gray-500">
      Don’t have an account yet?&nbsp;
      <a
       href="javascript:void(0)"
       @click.prevent="$router.push('/register')"
       class="font-sm text-blue-700"
       >Sign up</a
      >
     </p>
    </div>
   </form>
  </section>
 </div>
</template>

<script>
import HTTP from '../http';
import Button from '../components/Button.vue';
import { mapActions } from 'vuex';
import {
 LOGIN_URL,
 HTTP_SUCCESS_STATUS,
 HTTP_UNPROCESSABLE_CONTENT_STATUS,
 HTTP_UNAUTHORIZED_STATUS,
} from '../constants';
import Modal from '../components/Modal';

export default {
 name: 'login',
 components: {
  Button,
  Modal,
 },
 data() {
  return {
   username: '',
   password: '',
   validate: [],
   message: '',
   isSubmiting: false,
  };
 },

 computed: {},

 methods: {
  ...mapActions({
   signIn: 'auth/storeSession',
  }),
  async login() {
   this.validate = [];
   this.message = '';
   this.isSubmiting = true;

   const data = {
    username: this.username,
    password: this.password,
   };

   await HTTP.post(LOGIN_URL, data)
    .then((response) => {
     const { status, data } = response;
     if (status === HTTP_SUCCESS_STATUS) {
      this.signIn({
       user: data.user,
       token: data.token,
       isAuth: true,
      });
     }
    })
    .catch((error) => {
     // Unprocessable content
     if (error.response.status === HTTP_UNPROCESSABLE_CONTENT_STATUS) {
      const errors = error.response.data;
      this.validate = errors.errors;
      // Unauthorized
     } else if (error.response.status === HTTP_UNAUTHORIZED_STATUS) {
      this.message = 'Authentication failed';
     }
    })
    .finally(() => {
     this.isSubmiting = false;
    });
  },
 },
};
</script>
