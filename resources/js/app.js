import './bootstrap';
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { VueRecaptchaPlugin } from 'vue-recaptcha'
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';


import Vue, { createApp } from 'vue';
// import Vue from 'vue/dist/vue.esm-bundler.js';
import App from './App.vue';
import router from './router';

window.baseURL = import.meta.env.VITE_APP_URL

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
// Vue.use(VueRecaptchaPlugin, {
//     siteKey: '6LduPIYnAAAAANcU27vpGFmy3G3DgRsgkea0TCNV',
// });
Vue.component('font-awesome-icon', FontAwesomeIcon);

createApp(App)
  .use(router)
  .mount('#app');
