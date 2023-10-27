import { createRouter, createWebHistory } from 'vue-router';
import Login from '../pages/auth/Login.vue';
import Dashboard from '../pages/dashboard/Dashboard.vue';
import IndustryList from '../pages/industries/IndustryList.vue';
import IndustryDetail from '../pages/industries/IndustryDetail.vue';
import SupplierList from '../pages/suppliers/SupplierList.vue';
import SupplierDetail from '../pages/suppliers/SupplierDetail.vue';
import BenefitList from '../pages/benefits/BenefitList.vue';
import PartnerList from '../pages/partners/PartnerList.vue';
import HomeSettingList from '../pages/home_settings/HomeSettingList.vue';
import ClientList from '../pages/clients/ClientList.vue';
import QrCode from '../pages/qr-code/QrCode.vue'
import useAuthStore from '../stores/auth';

const routeForAdmin = [
    {
        path: '/login',
        name: 'admin.login',
        component: Login,
        meta: {
            title: 'Admin | Login'
        }
    },
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
        meta: {
            title: 'Admin | Dashboard'
        }
    },
    {
        path: '/admin/industries',
        name: 'admin.industries',
        component: IndustryList,
        meta: {
            title: 'Admin | Industries'
        }
    },
    {
        path: '/admin/qr-code',
        name: 'admin.qr-code',
        component: QrCode,
        meta: {
            title: 'Admin | Qr-Code Scanner'
        }
    },
    {
        path: '/admin/industries/:id',
        name: 'admin.industries.detail',
        component: IndustryDetail,
        meta: {
            title: 'Admin | Industries Detail'
        }
    },
    {
        path: '/admin/suppliers',
        name: 'admin.suppliers',
        component: SupplierList,
        meta: {
            title: 'Admin | Suppliers'
        }
    },
    {
        path: '/admin/suppliers/:id',
        name: 'admin.suppliers.detail',
        component: SupplierDetail,
        meta: {
            title: 'Admin | Supplier Detail'
        }
    },
    {
        path: '/admin/benefits',
        name: 'admin.benefits',
        component: BenefitList,
        meta: {
            title: 'Admin | Benefit'
        }
    },
    {
        path: '/admin/partners',
        name: 'admin.partners',
        component: PartnerList,
        meta: {
            title: 'Admin | Partner'
        }
    },    
    {
        path: '/admin/clients',
        name: 'admin.clients',
        component: ClientList,
        meta: {
            title: 'Admin | Client'
        }
    },
    {
        path: '/admin/home-setting',
        name: 'admin.home_setting',
        component: HomeSettingList,
        meta: {
            title: 'Admin | Home Settings'
        }
    },
];

const routeAdmin = createRouter({
    history: createWebHistory(),
    routes: routeForAdmin,
});

routeAdmin.beforeEach(async (to, from) => {
    const authStore = useAuthStore();
    if (authStore.userIsAuth === null && to.name !== 'admin.login') {
        return { name: 'admin.login' };        
    }

    if (authStore.userIsAuth !== null && to.name === 'admin.login') {
        return { name: 'admin.dashboard' };
    }

    const title = to.meta.title;
    if (title) {
        document.title = title;
    }
});

export default routeAdmin;