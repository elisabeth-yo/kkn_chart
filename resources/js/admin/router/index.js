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
import QrCode from '../pages/qr-code/QrCode.vue';
import Users from '../pages/users/UserList.vue';
import useAuthStore from '../stores/auth';
import pengguna from '../pages/pengguna/pengguna.vue';
import wilayah from '../pages/wilayah/wilayah.vue';
import kategoripengguna from '../pages/kategoripengguna/kategoripengguna.vue';
import beritakegiatan from '../pages/beritakegiatan/beritakegiatan.vue';
import jadwalibadah from '../pages/jadwalibadah/jadwalibadah.vue';
import wartajemaat from '../pages/wartajemaat/wartajemaat.vue';
import persembahan from '../pages/persembahan/persembahan.vue';
import jenisibadah from '../pages/jenisibadah/jenisibadah.vue';
import publikasirenungan from '../pages/publikasirenungan/publikasirenungan.vue';
import presensijemaat from '../pages/presensijemaat/presensijemaat.vue';
import renunganharian from '../pages/renunganharian/renunganharian.vue';

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
        path: '/admin/users',
        name: 'admin.users',
        component: Users,
        meta: {
            title: 'Admin | Users'
        }
    },
    {
        path: '/admin/pengguna',
        name: 'admin.pengguna',
        component: pengguna,
        meta: {
            title: 'Admin | Pengguna'
        }
    },
    {
        path: '/admin/wilayah',
        name: 'admin.wilayah',
        component: wilayah,
        meta: {
            title: 'Admin | Wilayah'
        }
    },
    {
        path: '/admin/kategoripengguna',
        name: 'admin.kategoripengguna',
        component: kategoripengguna,
        meta: {
            title: 'Admin | Kategori Pengguna'
        }
    },
    {
        path: '/admin/beritakegiatan',
        name: 'admin.beritakegiatan',
        component: beritakegiatan,
        meta: {
            title: 'Admin | Berita Kegiatan'
        }
    },
    {
        path: '/admin/jadwalibadah',
        name: 'admin.jadwalibadah',
        component: jadwalibadah,
        meta: {
            title: 'Admin | Jadwal Ibadah'
        }
    },
    {
        path: '/admin/wartajemaat',
        name: 'admin.wartajemaat',
        component: wartajemaat,
        meta: {
            title: 'Admin | Warta Jemaat'
        }
    },
    {
        path: '/admin/persembahan',
        name: 'admin.persembahan',
        component: persembahan,
        meta: {
            title: 'Admin | Persembahan'
        }
    },
    {
        path: '/admin/jenisibadah',
        name: 'admin.jenisibadah',
        component: jenisibadah,
        meta: {
            title: 'Admin | Jenis Ibadah'
        }
    },
    {
        path: '/admin/publikasirenungan',
        name: 'admin.publikasirenungan',
        component: publikasirenungan,
        meta: {
            title: 'Admin | Publikasi Renungan'
        }
    },
    {
        path: '/admin/presensijemaat',
        name: 'admin.presensijemaat',
        component: presensijemaat,
        meta: {
            title: 'Admin | Presensi Jemaat'
        }
    },
    {
        path: '/admin/renunganharian',
        name: 'admin.renunganharian',
        component: renunganharian,
        meta: {
            title: 'Admin | Renungan Harian'
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