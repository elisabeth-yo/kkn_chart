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

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/products',
        name: 'Products',
        component: Product
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
