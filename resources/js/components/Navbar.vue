<template>
  <header
    class="header fixed-top"
    style="box-shadow: 0px -3px 10px 0px rgba(87, 67, 67, 0.2) inset;"
  >

    <div class="container-md d-flex flex-wrap justify-content-between mt-2 mb-2">
      <router-link :class="`nav-link`" to="/">
        <img src="/assets/images/espn.png" style="height: 30px;" />
      </router-link>
      <div v-if="this.$route.path !== '/'" class="text-center font-size-15 font-weight-600 mr-4" style="cursor: pointer"><a @click="$router.back()">Back To Previous</a></div>
    </div>

    <b-navbar
      class="navbar-top navbar-expand-lg"
      toggleable="md"
      type="light"
      variant="light"
      style="box-shadow: 0px -3px 10px 0px rgba(87, 67, 67, 0.2) inset;"
    >
      <div class="container-md">
        <b-navbar-brand class="d-md-none focus-border-0">
          <img
            src="/assets/images/footer-elevenia.png"
            style="height: 60px; width: auto;"
          />
        </b-navbar-brand>
        <div
          v-if="isCollapse"
          role="button"
          class="btn border-0 d-md-none"
          @click="toggleCollapse(false)"
        >
          <i class="fas fa-times font-size-30"></i>
        </div>
        <div
          v-else
          role="button"
          class="btn border-0 d-md-none"
          @click="toggleCollapse(true)"
        >
          <i class="fas fa-bars font-size-30"></i>
        </div>
        <b-collapse class="justify-content-center py-2" id="navBarCollapse" is-nav>
          <!-- <div class="navbar-nav pe-2 pe-md-5">
            <router-link :class="`nav-link`" to="/">
              <img
                src="/assets/images/footer-elevenia.png"
                style="height: 60px;"
              />
            </router-link>
          </div> -->
          <ul class="navbar-nav mb-0">
            <li class="nav-item d-none d-md-block">
              <router-link :class="`nav-link d-flex align-items-center`" to="/">
                <img
                  src="/assets/images/footer-elevenia.png"
                  style="height: 60px; width: auto;"
                />
              </router-link>
            </li>
            <li
              v-for="(item, indexNav) in navbar"
              :key="indexNav"
              class="nav-item"
            >
              <b-nav-item-dropdown class="dropdown" v-if="item.industryNav" :text="item.name" right>
                <b-dropdown-item
                  v-for="(navItem, index) in item.industryNav"
                  :key="index"
                  :href="`${item.link}${navItem.link}`"
                  class="w-100 px-2">
                  <div class="d-flex align-items-center gap-3">
                    <!-- <div>
                      <img :src="`/${navItem.icon}`" />
                    </div> -->
                    <div class="font-size-16 font-weight-500">
                      {{ navItem.title }}
                    </div>
                  </div>
                </b-dropdown-item>
              </b-nav-item-dropdown>
              <router-link
                v-else
                :class="`nav-link font-weight-600 font-size-16 ${
                  item.link == currentUrl ? 'active' : ''
                }`"
                :to="item.link"
                >{{ item.name }}</router-link
              >
            </li>
            <!-- <li class="nav-item">
              <router-link :class="`nav-link`" to="/">
                <img src="/assets/images/espn.png" style="height: 30px;" />
              </router-link>
            </li> -->
          </ul>
        </b-collapse>
      </div>
    </b-navbar>
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
