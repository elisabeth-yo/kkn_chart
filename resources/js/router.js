import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/Home/Index.vue';
import NotFound from './pages/NotFound.vue';
import Product from './pages/Product/Index.vue';
import Inquiry from './pages/Inquiry/Index.vue';
import InquiryShow from './pages/Inquiry/Show/Index.vue';
import BecomeCustomer from './pages/Customer/Index.vue';
import BecomeSupplier from './pages/Supplier/Index.vue';
import ContactUs from './pages/ContactUs/Index.vue';
import Induestires from './pages/Industries/Index.vue';
import Supplies from './pages/Supplies/Index.vue';
import SejarahGereja from './pages/SejarahGereja/Index.vue';
// import BeritaKegiatan from './pages/BeritaKegiatan/Index.vue';
// import BeritaKegiatanShow from './pages/BeritaKegiatan/Show/Index.vue';
import Administrasi from './pages/Administrasi/Index.vue';
import DataJemaat from './pages/Home/DataJemaat.vue';
import DataJemaatLogin from './pages/Home/DataJemaatLogin.vue';
import DetailJemaat from './pages/Home/DetailJemaat.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/sejarah-gereja',
        name: 'SejarahGereja',
        component: SejarahGereja
    },
    // {
    //     path: '/beritakegiatan',
    //     name: 'BeritaKegiatan',
    //     component: BeritaKegiatan
    // },
    {
        path: '/administrasi',
        name: 'Administrasi',
        component: Administrasi
    },
    // {
    //     path: '/beritakegiatan/show',
    //     name: 'BeritaKegiatanShow',
    //     component: BeritaKegiatanShow
    // },
    {
        path: '/data_jemaat',
        name: 'Data Jemaat',
        component: DataJemaat
    },
    {
        path: '/data_jemaat_login',
        name: 'Data Jemaat Login',
        component: DataJemaatLogin
    },
    {
        path: '/detail_jemaat',
        name: 'Detail Jemaat',
        component: DetailJemaat
    },
    {
        path: '/industries/:industry',
        name: 'Industry',
        component: Induestires
    },
    {
        path: '/supplies/:supplies',
        name: 'Supplies',
        component: Supplies
    },
    {
        path: '/inquiry',
        name: 'Inquiry',
        component: Inquiry
    },
    {
        path: '/contact-us',
        name: 'ContactUs',
        component: ContactUs
    },
    {
        path: '/inquiry/show',
        name: 'InquiryShow',
        component: InquiryShow
    },
    {
        path: '/become-a-customer',
        name: 'BecomeCustomer',
        component: BecomeCustomer
    },
    {
        path: '/become-a-supplier',
        name: 'BecomeSupplier',
        component: BecomeSupplier
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;