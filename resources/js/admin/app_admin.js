import '../bootstrap';

// import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';


import Vue, { createApp } from 'vue';
import AppAdmin from './AppAdmin.vue';
import routeAdmin from './router/index';
import { createPinia } from 'pinia';

Vue.configureCompat({ INSTANCE_ATTRS_CLASS_STYLE: false });

const pinia = createPinia();
const app = createApp(AppAdmin);
app.use(pinia);
app.use(routeAdmin);
app.mount('#app-admin');