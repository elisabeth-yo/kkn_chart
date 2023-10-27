<template>
    <div v-if="authUser.userIsAuth" class="wrapper" id="app-admin">
        <AppNavbar />
        <SidebarLeft />
        <div class="content-wrapper">
            <router-view />
        </div>
        <SidebarRight />
        <Footer />
    </div>
    <div v-else class="login-page" >
        <router-view></router-view>
    </div>
</template>

<script setup>
import AppNavbar from './components/AppNavbar.vue';
import SidebarLeft from './components/SidebarLeft.vue';
import SidebarRight from './components/SidebarRight.vue';
import Footer from './components/AppFooter.vue';
import useAuthStore from './stores/auth';

const authUser = useAuthStore();
</script>

<style>
    .table {
        border-top: 2px solid #dee2e6 !important;
    }
</style>