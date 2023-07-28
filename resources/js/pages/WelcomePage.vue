<template>
 <div>
  <h1 class="text-2xl">Welcome: {{ user.username }}</h1>
 </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
 data() {
  return {};
 },
 computed: {
  ...mapGetters({
   user: "auth/getUser",
  }),
 },
 mounted() {},
};
</script>

<style></style>
