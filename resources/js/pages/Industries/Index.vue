<template>
  <div>
    <HeroIndustries
      :title="industry.header_slogan"
      :subTitle="industry.header_description"
      :image="industry.header_image"
    />
    <!-- <section class="mt-5">
      <div class="container">
        <div class="row g-5">
          <div class="col-md-5">
            <img
              src="/assets/images/251659-P4FZXZ-563.png"
              class="img-fluid w-100"
            />
          </div>
          <div class="col-md-7">
            <div class="font-weight-400 font-size-16">
              {{ industry.description }}
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <section style="margin-top: 100px;">
      <div class="container text-center">
        <div class="">
          <div class="font-weight-600 font-size-16">
            {{ industry.slogan }}
          </div>
        </div>
        <div class="col-12 mx-auto mt-2">
          <div class="font-weight-400 font-size-16">
            {{ industry.description }}
          </div>
        </div>
      </div>
    </section>
    <section class="mt-5">
      <div class="container-fluid">
        <div class="row g-4">
          <div class="col-md-4" v-for="(item, index) in industry.benefits">
            <div class="text-center">
              <img :src="item.image" />
              <div class="font-weight-700 mt-1 font-size-20">
                {{ item.title }}
              </div>
            </div>
            <div class="font-weight-400 mt-1 font-size-12">
              {{ item.description }}
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="margin-top: 100px;">
      <div class="container">
        <div class="font-weight-600 font-size-16 text-center mb-5">
          Supplies to keep your business moving
        </div>
        <div class="col-6 mx-auto">
          <div class="row justify-content-center align-items-center g-4">
            <div
              v-for="(detail, indexDetail) in industry.supplies"
              class="col-lg-4 col-sm-6"
              :key="indexDetail"
            >
              <router-link
                :to="{path: '/supplies/' + detail.code}"
                class="card border-2 border-black rounded-0 hover-shadow-lg"
                style="min-height: 190px;"
              >
                <div
                  class="card-body text-center p-4 vstack justify-content-between"
                >
                  <div>
                    <img
                      :src="`/${detail.image}`"
                      class="img-fluid"
                      alt=""
                      style="height: 100px;"
                    />
                  </div>
                  <div class="font-size-14 font-weight-700 text-center">
                    {{ detail.title }}
                  </div>
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="margin: 100px;">
      <div class="container">
        <div class="row">
          <div class="col-12 bg-p-grey-43 p-5 text-center">
            <div class="font-weight-600 font-size-16">
              Elevenia Biz and its integration with SAP Ariba has been a great
              solution for meeting our global corporate goals. We’ve replaced
              hundreds of one-time vendors, seamlessly brought Elevenia Biz
              purchases into our existing polici es for compliance, identified
              preferred suppliers with Guided Buying to maintain our global
              contracts, and leverage robust analytics for budgeting and
              forecasting, among other benefits. We look forward to growing our
              partnership with Elevenia Biz in an effort to continually enhance
              our procurement organization.”
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import HeroIndustries from "@/components/HeroIndustries.vue";
import axios from "axios";
import { ref } from "vue";
import route from '@/router';

export default {
  components: {
    HeroIndustries,
  },
  name: "Inquiry",
  data() {
    return {
      industry: ref([]),
    };
  },
  methods: {
    getData() {
      let industryCode = this.$route.params.industry

      axios.get(window.baseURL + 'api/frontend/industries/get/' + industryCode)
            .then((data) => {
              this.industry = data.data.data
            })
            .catch((err) => {
              console.error(err);

              if (err.response.status === 404) {
                route.push({ name: 'NotFound' });
              }
            });
    }
  },
  mounted () {
    
  },
  beforeMount() {
    this.getData()
  },
};
</script>
