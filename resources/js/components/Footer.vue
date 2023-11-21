FOOTER

<template>
  <footer>
    <div style="background-color:#001D6A">
      <div class="container-fluid">
        <div class="row p-4 pt-0">
          <div class="col-lg-6 text-white">
            <div class="flex-wrap gap-3 mb-lg-0 mb-2 mt-5">
              <h5 class="mb-4"><strong>Kantor Gereja</strong></h5>
              <table>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-map-marker"></i></p>
                          </td>
                          <td><p class="mb-0">Jl. Melati Raya No. 1A, Depok 16432</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-phone"></i></p>
                          </td>
                          <td><p class="mb-0">(021) 7522589</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-envelope"></i></p>
                          </td>
                          <td><p class="mb-0">kantor.yeremia@gmail.com</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa-solid fa-money-check-dollar"></i></p>
                          </td>
                          <td><p class="mb-0">157-00-062608-2 - Bank Mandiri</p></td>
                    </tr><br>
                    <tr>
                      <td><a href="https://www.instagram.com/gkjyeremiadepok/"><i class="fa-brands fa-instagram text-white" style="width:30px; height:30px;"></i></a></td>
                      <td><a href="http://facebook.com/gkj.depok"><i class="fa-brands fa-facebook ms-3 text-white" style="width:30px; height:30px;"></i></a></td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15860.118571472072!2d106.8102818!3d-6.3901766!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e950492b37c5%3A0xa4e3dd301bb7a62d!2sGereja%20Kristen%20Jawa%20Yeremia!5e0!3m2!1sen!2sid!4v1698580793943!5m2!1sen!2sid" width="580" height="200" style="border:0;" class="mt-5 w-100" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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