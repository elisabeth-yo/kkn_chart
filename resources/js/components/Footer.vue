<template>
  <footer class="mt-5">
    <div class="bg-p-grey-43">
      <div class="container-fluid">
        <div class="row p-4 align-items-center">
          
          <div class="col-lg-4 order-lg-0 order-1">
            <ul class="navbar-nav d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-sm-5 gap-4" style="flex-direction: unset !important;">
              <li v-for="(item, indexNav) in navbar"
                  :key="indexNav"
                  class="nav-item" >
                <div class="d-flex align-items-center gap-3">
                    <router-link
                      :class="`nav-link font-weight-600 font-size-16 ${
                        item.link == currentUrl ? 'active' : ''
                      }`"
                      :to="item.link"
                      >{{ item.name }}</router-link
                    >
                  </div>
              </li>
            </ul>
          </div>

          <div class="col-lg-4 order-lg-0 order-1">
            <div class="d-flex flex-wrap align-items-center justify-content-center gap-sm-5 gap-4 mb-lg-0 mb-5">
              <div class="text-center mb-0">
                <div class="row">
                  <div class="col-md-12">
                    <img src="/assets/images/logo-espn.png" width="183px"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <img src="/assets/images/footer-elevenia.png" width="137px"/>
                  </div>
                  <div class="col-md-6">
                    <img src="/assets/images/footer-e-nusantara.png" width="137px"/>
                  </div>
                </div>
                <div class="font-size-12 font-weight-500 mt-3">
                  © 2022 elnusantara all rights reserved
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 order-lg-1 order-0 ms-auto">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center gap-sm-5 gap-4 mb-lg-0 mb-5">
              <table class="contact-info">
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-map-marker"></i></p>
                          </td>
                          <td><p class="mb-0">{{ contact_us.address }}</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-phone"></i></p>
                          </td>
                          <td><p class="mb-0">{{ contact_us.phone }}</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-envelope"></i></p>
                          </td>
                          <td><p class="mb-0">{{ contact_us.email }}</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                            <img src="/assets/images/linkedin-icon.svg" />
                          </td>
                          <td><p class="mb-0">{{ contact_us.linkedin }}</p></td>
                    </tr>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import axios from 'axios';

export default {
  name: "Footer",
  data() {
    return {
      currentUrl: window.location.pathname,
      navbar: [
        {
          name: "Home",
          link: "/",
        },
        {
          name: "Industries",
          link: "/industries",
        },
      ],
      contact_us: {
        address: null,
        phone: null,
        email: null,
        linkedin: null,
      }
    }
  },
  methods: {
    getData() {
      axios.get(window.baseURL + 'api/frontend/contact-us/get' )
            .then((data) => {
              this.contact_us = data.data.data
            })
            .catch((err) => {
                console.log(err);
            });
    }
  },
   beforeMount() {
    this.getData()
  }
};
</script>
