require("./bootstrap");
import Vue from "vue";
import AppPage from "./pages/AppPage";
import router from "./router";
import "../css/app.css";
import store from "../js/store";

const app = new Vue({
 el: "#app",
 components: { AppPage },
 store,
 router,
});
