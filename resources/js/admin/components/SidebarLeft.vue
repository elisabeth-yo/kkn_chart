<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">KKN GKJ Yeremia</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ authStore.user.email }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="" :class="$route.path.startsWith('/admin/industries') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Data Jemaat
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="" class="nav-link">
                            <i class="nav-icon fas fa-gift"></i>
                            <p>
                                Streaming Ibadah
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/pengguna" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Pengguna
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/wilayah" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Wilayah
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/kategoripengguna" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Kategori Pengguna
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/beritakegiatan" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Berita Kegiatan
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/jadwalibadah" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Jadwal Ibadah
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/wartajemaat" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Warta Jemaat
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/persembahan" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Persembahan
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/jenisibadah" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Jenis Ibadah
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/publikasirenungan" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Publikasi Renungan
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/presensijemaat" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Presensi Jemaat
                            </p>
                        </router-link>
                    </li>

                    <!-- <li class="nav-item">
                        <router-link to="/admin/clients" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Clients
                            </p>
                        </router-link>
                    </li> -->

                    <!-- <li class="nav-item">
                        <router-link to="/admin/home-setting" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-ad"></i>
                            <p>
                                Home Settings
                            </p>
                        </router-link>
                    </li> -->

                    <li class="nav-item">
                        <form class="nav-link">
                            <a href="#" @click.prevent="loggingOut === false && handleLogOut()">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script setup>
    import useAuthStore from '../stores/auth';
    import { ref } from 'vue';
    import { useRouter } from "vue-router";
    import { requestPost } from '../api/api';

    const router    = useRouter();
    const authStore = useAuthStore();

    const loggingOut = ref(false);

    const handleLogOut = () => {
        loggingOut.value = true;
        requestPost('admin/logout', {}).then(RESPONSE => {
            authStore.logoutUser();
            router.replace({ name: 'admin.login' });
        }).catch(ERROR => {
            alert(ERROR.response.data.message);
        });
        
    }
</script>