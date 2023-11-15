<template>
  <header
    class="header fixed-top mx-15"
    style="box-shadow: 0px -3px 10px 0px rgba(87, 67, 67, 0.2) inset;">
  <div>
    <b-navbar toggleable="md" type="dark" style="background-color:#0480fc;">
      <b-navbar-brand href="#" class="mx-5 d-flex"><img src="/assets/images/carousel/logogkj.png" style="height:70px;" /></b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse class="flex-row-reverse px-4" id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-navbar-nav class="text-white px-2">
            <b-nav-item href="/"><strong>Dashboard</strong></b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="text-nowrap px-2">
            <b-nav-item href="/sejarah-gereja"><strong>Tentang Gereja</strong></b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav>
            <b-nav-item href="/administrasi"><strong>Administrasi</strong></b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="text-nowrap">
            <b-nav-item href="/data_jemaat" class=text-white><strong>Data Jemaat</strong></b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="text-white">
            <b-nav-item href="#"><strong>Berita & Kegiatan</strong></b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="text-white">
            <b-nav-item href="#"><strong>Streaming Ibadah</strong></b-nav-item>
          </b-navbar-nav>

          <b-nav-item-dropdown right class="pe-5">
            <!-- Using 'button-content' slot -->
            <template #button-content>
              <strong>Pengguna</strong>
            </template>
            <b-dropdown-item href="/detail_jemaat">Profile</b-dropdown-item>
            <b-dropdown-item href="#">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
  </header>
</template>

<script>
  import axios from "axios";
  import $ from "jquery";
  import { ref } from "vue";

  export default {
    name: "Navbar",
    data() {
      return {
        isCollapse: false,
        currentUrl: window.location.pathname,
        industries: ref([]),
        navbar: [
          {
            name: "Home",
            link: "/",
          },
          {
            name: "Industries",
            link: "/industries",
            industryNav: ref([])
          },
        ],
      };
    },
    methods: {
      toggleCollapse(status) {
        this.isCollapse = status;
        const navBarCollapse = $("#navBarCollapse");
        if (status) navBarCollapse.show("slow");
        else navBarCollapse.hide("slow");
      },
      getIndustries() {
        axios.get(window.baseURL + 'api/frontend/industries')
            .then((data) => {
              this.navbar[1].industryNav = data.data.data
            })
            .catch((err) => {
                console.error(err);
            });
      }
    },
    beforeMount() {
      this.getIndustries()
    }
  };
</script>
<style>
  .navbar-nav .dropdown-menu {
    min-width: 300px;
    padding: 0px;
    gap: 4px;
    border: 1px solid rgba(0, 0, 0, 0.10);
    border-radius: 8px !important;
    
  }

  .navbar-nav .dropdown-menu .dropdown-item:hover,
  .navbar-nav .dropdown-menu .dropdown-item:focus {
      background: none !important;
      color: #5D5FEF !important;
  }

  .navbar-nav .nav-item.b-nav-dropdown.dropdown:hover .dropdown-menu {
      display: block !important;
  }
</style>
