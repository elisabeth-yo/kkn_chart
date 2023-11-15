<template>
  <footer>
    <div style="background-color:#001D6A">
      <div class="container-fluid">
        <div class="row p-4">
          
          <div class="col-lg-6 text-white">
            <div class="d-flex flex-wrap gap-3 mb-lg-0 mb-2">
              <h5><strong>Informasi Kontak Kesekretariatan</strong></h5>
              <table class="contact-info">
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-map-marker"></i></p>
                          </td>
                          <td><p class="mb-0">Jl Melati Raya 1 A RT 004 Depok Jaya Pancoran Mas Depok Jawa Barat, Depok Jaya, Kec. Pancoran Mas, Kota Depok, Jawa Barat 16436</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-phone"></i></p>
                          </td>
                          <td><p class="mb-0">(021) 77203180</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa fa-envelope"></i></p>
                          </td>
                          <td><p class="mb-0">yeremia@gmail.com</p></td>
                    </tr>
                    <tr>
                          <td style="width: 29px; vertical-align:top; padding-right: 20px;">
                              <p class="mb-0"><i class="fa-solid fa-money-check-dollar"></i></p>
                          </td>
                          <td><p class="mb-0">070 301 466 3 - BCA</p></td>
                    </tr><br>
                    <tr>
                      <td><i class="fa-brands fa-instagram" style="width:30px; height:30px;"></i></td>
                      <td><i class="fa-brands fa-facebook ms-3" style="width:30px; height:30px;"></i></td>
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