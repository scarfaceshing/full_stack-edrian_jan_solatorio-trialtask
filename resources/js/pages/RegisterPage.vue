<template>
 <div class="md:container">
  <section class="bg-zinc-900 flex flex-col items-center justify-center mx-auto h-full">
   <h1 class="text-7xl text-zinc-100 mb-5 font-black">Register</h1>
   <form
    @submit.prevent="register"
    class="bg-gray-300 rounded-lg grid grid-cols-1 sm:w-96 px-10 py-10 space-y-5 xs:w-full"
   >
    <div>
     <label for="email" class="block text-lg mb-2 font-medium text-zinc-900">Email</label>
     <input
      type="text"
      name="email"
      v-model="email"
      class="w-full rounded-lg text-lg border border-gray-100"
     />
     <p class="text-red-500" v-for="(error, index) in validate['email']" v-bind:key="index">
      {{ error }}
     </p>
    </div>
    <div>
     <label for="phone_number" class="block text-lg mb-2 font-medium text-zinc-900"
      >Phone Number</label
     >
     <input
      type="tel"
      name="phone_number"
      v-model="phoneNumber"
      class="w-full rounded-lg text-lg border border-gray-100"
     />
     <p class="text-red-500" v-for="(error, index) in validate['phone_number']" v-bind:key="index">
      {{ error }}
     </p>
    </div>
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
    <div>
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
    <div class="mb-3">
     <label for="password" class="block text-lg mb-2 font-medium text-zinc-900"
      >Confirm Password</label
     >
     <input
      type="password"
      name="confirm_password"
      v-model="confirmPassword"
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
    <div class="">
     <Button :is-loading="isSubmiting" title="Sign up" />
    </div>
    <div>
     <p class="font-sm text-gray-500">
      Login to your account?&nbsp;
      <a
       href="javascript:void(0)"
       @click.prevent="$router.push('/login')"
       class="font-sm text-blue-700"
       >Sign in</a
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

const SUCCESS_STATUS = 200;
const URL = 'api/register';

export default {
 components: {
  Button,
 },
 data() {
  return {
   email: '',
   username: '',
   password: '',
   phoneNumber: '',
   confirmPassword: '',
   validate: [],
   isSubmiting: false,
  };
 },

 methods: {
  register() {
   this.isSubmiting = true;

   const data = {
    username: this.username,
    email: this.email,
    password: this.password,
    phone_number: this.phoneNumber,
    password_confirmation: this.confirmPassword,
   };

   const http = HTTP.post(URL, data, null);

   http
    .then((response) => {
     if (response.status === SUCCESS_STATUS) {
      this.$router.push({ name: 'login' });
      this.isSubmiting = false;
     }
    })
    .catch((error) => {
     if (error.response) {
      this.validate = error.response.data.errors;
      this.isSubmiting = false;
     }
    });
  },
 },
};
</script>
