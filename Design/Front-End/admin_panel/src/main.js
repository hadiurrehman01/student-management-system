import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import "./assets/css/style.min.css"
import "./assets/css/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
import "./assets/css/libs/bootstrap/dist/css/bootstrap.min.css"
import "./assets/css/icons/font-awesome/css/fontawesome.min.css"
import "./assets/css/icons/material-design-iconic-font/css/materialdesignicons.min.css"
import "./assets/css/libs/chartist/dist/chartist.min.css"

import "./assets/css/libs/jquery/dist/jquery.min.js";
import "./assets/css/libs/popper.js/dist/popper.min.js"


import BootstrapVue from "bootstrap-vue"
Vue.use(BootstrapVue)

import "./assets/js/app-style-switcher.js"
import "./assets/js/waves.js"
import "./assets/js/sidebarmenu.js"
import "./assets/js/custom.js"
// import "./assets/css/libs/chartist/dist/chartist.min.js"
// import "./assets/css/libs/chartist-plugin-tooltips/dist/tooltip.min.js"
// import "./assets/js/pages/dashboards/dashboard1.js"

import "bootstrap/dist/css/bootstrap.css"
import "bootstrap-vue/dist/bootstrap-vue.css"

import Baselayout from "./components/Common/Baselayout";
import Loginlayout from "./components/Common/LoginLayout";

Vue.component("base-layout", Baselayout);
Vue.component("login-layout", Loginlayout);


Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
