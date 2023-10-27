<template>
  <section class="ebiz__hero_slider">
    <swiper
      :navigation="true"
      :modules="modules"
      :autoplay="{
        delay: 2500,
        disableOnInteraction: false,
      }"
    >
      <!-- <swiper-slide>
        <div class="position-relative">
          <img src="/assets/images/hero-ebiz.png" class="w-100" />
          <div
            class="position-absolute d-flex align-items-start justify-content-center w-100"
            style="top: 35%;"
          >
            <div class="col-lg-6 col-8 text-center mx-auto">
              <div
                class="text-p-white font-weight-600 font-size-lg-22 font-size-md-20 font-size-sm-16 font-size-10"
              >
                Smart business buying starts here
              </div>
              <div
                class="text-p-white font-weight-400 font-size-lg-16 font-size-md-12 font-size-sm-10 font-size-6 mt-lg-3 mt-md-2"
              >
                Elevenia.Biz realizes that all businesses and businesses have
                different challenges. Therefore, we are here to bring various
                solutions to answer all your business and business challenges.
              </div>
            </div>
          </div>
        </div>
      </swiper-slide> -->
      <swiper-slide v-for="(item, index) in  hero_header">
        <img :src="item.image" class="w-100" />
      </swiper-slide>
    </swiper>
  </section>
  <section class="mt-4">
    <div class="container">
      <div class="text-center font-size-24 font-weight-600 text-p-blue-24">
        Why Choose Me
      </div>
      <div class="">
        <div class="row align-items-center">
          <div class="col-xl-5 col-lg-6">
            <div class="text-center">
              <img
                src="/assets/images/asset-left-home.svg"
                style="width: 100%;"
              />
            </div>
          </div>
          <div class="col-xl-7 col-lg-6">
            <div class="row p-xl-4 g-4">
              <div v-for="(item, index) in why_choose_me" class="col-sm-6">
                <div
                  class="bg-p-grey-58 px-4 py-2 radius-10 hover-bg-p-blue-25"
                >
                  <div class="hstack align-items-center gap-4">
                    <div>
                      <img :src="item.image" style="max-width: 39px;" />
                    </div>
                    <div>
                      <div class="font-weight-500 font-size-16">
                        {{ item.title }}
                      </div>
                      <div class="font-weight-400 font-size-12">
                        {{ item.content }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-5">
    <div class="text-center font-size-24 font-weight-600 text-p-blue-24 my-5">
      How To Order
    </div>
    <swiper
      :slidesPerView="3"
      :spaceBetween="10"
      :freeMode="true"
      :autoplay="{
        delay: 2500,
        disableOnInteraction: false,
      }"
      :breakpoints="{
        320: {
          slidesPerView: 1,
          spaceBetween: 50,
        },
        430: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        512: {
          slidesPerView: 1,
          spaceBetween: 50,
        },
        659: {
          slidesPerView: 2,
          spaceBetween: 300,
        },
        699: {
          slidesPerView: 2,
          spaceBetween: 200,
        },
        933: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1025: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1290: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        1336: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
      }"
      :modules="modules"
      class="ebiz_slider__card"
    >
      <swiper-slide v-for="(item, index) in how_to_order">
        <div
          class="ebiz_item_slider__card bg-p-blue-24 p-4 hstack align-items-center justify-content-center text-center radius-10"
          style="
            width: 350px;
            height: 418px;
            filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
          "
        >
          <div>
            <div>
              <img :src="item.image" style="max-width: 90px;" />
              <div class="font-weight-700 font-size-24 text-p-white">
                {{ item.title }}
              </div>
            </div>
            <div class="mt-4">
              <div class="font-weight-400 font-size-16 text-p-white">
                {{ item.content }}
              </div>
            </div>
          </div>
        </div>
      </swiper-slide>
    </swiper>
  </section>
  <section class="mt-5">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-md-4">
          <div class="text-center">
            <img
                src="/assets/images/elevenia-biz-black.png"
                style="height: 70px;"
              />
            <div class="font-size-20 font-weight-400">
              You Must Know
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="row g-sm-5 g-3">
            <div class="flex-container">
              <div class="col-lg-4 col-6 px-sm-4 flex-item" v-for="(item, index) in you_must_know">
                <div
                  class="card border-0"
                  style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"
                >
                  <div class="text-center p-4">
                    <div class="font-weight-600 font-size-18">
                      {{ item.title }}
                    </div>
                  </div>
                  <div>
                    <img
                      :src="item.image"
                      class="w-100"
                    />
                  </div>
                  <div class="p-4">
                    <div class="font-size-14 font-weight-600">
                      {{ item.description }}
                    </div>
                    <div class="mt-1 font-weight-400 font-size-12">
                      {{ item.content }}
                    </div>
                  </div>
                  <!-- <div
                    class="py-2 text-center bg-p-blue-24 text-p-white font-weight-500 font-size-12"
                  >
                    Discover How
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-5 bg-p-blue-24">
    <div class="container pb-4">
      <div class="text-center py-4">
        <div class="font-weight-500 font-size-30 text-p-white">
          Achievement Results
        </div>
      </div>
      <div class="row pb-5 pt-4 justify-content-center g-5">
        <div class="col-xl-3 col-md-4 col-sm-6 px-xl-5" v-for="(item, index) in achievement_result">
          <div
            class="radius-10 text-center p-4"
            style="background: rgba(217, 203, 191, 0.5); min-height: 190px;"
          >
            <div class="font-weight-600 font-size-15 text-p-white">
              {{ item.title.toUpperCase() }}
            </div>
            <div class="mt-3 d-flex justify-content-center gap-3">
              <div class="">
                <div
                  class="font-size-45 font-weight-400 text-p-white text-center"
                >
                  +{{ item.content }}
                </div>
                <div class="font-size-18 text-p-white text-center" v-if="item.title !== 'partner'">Million</div>
              </div>
              <div>
                <img :src="item.image" />
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-xl-3 col-md-4 col-sm-6 px-xl-5">
          <div
            class="radius-10 text-center p-4"
            style="background: rgba(217, 203, 191, 0.5); min-height: 190px;"
          >
            <div class="font-weight-600 font-size-15 text-p-white">
              Customers
            </div>
            <div class="mt-3 d-flex justify-content-center gap-3">
              <div class="">
                <div
                  class="font-size-45 font-weight-400 text-p-white text-center"
                >
                  +1.8
                </div>
                <div class="font-size-18 text-p-white text-center">Million</div>
              </div>
              <div>
                <img src="/assets/images/users-icon-white.png" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 px-xl-5">
          <div
            class="radius-10 text-center p-4"
            style="background: rgba(217, 203, 191, 0.5); min-height: 190px;"
          >
            <div class="font-weight-600 font-size-15 text-p-white">
              Partner
            </div>
            <div class="mt-3 d-flex justify-content-center gap-3">
              <div class="">
                <div
                  class="font-size-45 font-weight-400 text-p-white text-center"
                >
                  +100
                </div>
              </div>
              <div>
                <img src="/assets/images/partner-icon-white.png" />
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>
  <section class="my-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <div class="font-size-24 font-weight-500">
            Smart leaders choose smart business buying
          </div>
          <div class="font-weight-400 font-size-16 mt-4">
            Discover how over 5 million organizations are simplifying employee
            purchasing with a one-stop shopping experience, real-time analytics,
            and time saving features – backed by Earth’s largest selection of
            business supplies.
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="" style="margin-top: 100px;">
    <div class="container">
      <div class="text-center">
        <div class="font-weight-600 font-size-24">
          Our Client
        </div>
      </div>
      <div
        class="bg-p-white pt-4 pb-3 px-3"
        style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"
      >
        <swiper
          v-if="dataClient.length > 0"
          class="ebiz_slider__client_partner px-4"
          :navigation="true"
          :modules="modules"
          :pagination="{
            clickable: true,
          }"
          :autoplay="{
            delay: 2500,
            disableOnInteraction: false,
          }"
        >
          <swiper-slide v-for="(itemClient, index) in dataClient">
            <div
              class="row align-items-center justify-content-center"
              :key="index"
            >
              <div
                class="col-md-2 col-4 gy-4"
                v-for="(item, index) in itemClient"
                :key="item.id"
              >
                <div class="px-lg-4 px-3">
                  <img
                    :src="item.image"
                    alt="partner logo"
                    class="img-fluid"
                    style="max-height: 150px; width: 190px;"
                  />
                </div>
              </div>
            </div>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </section>

  <section class="mb-5" style="margin-top: 100px;">
    <div class="container">
      <div class="text-center">
        <div class="font-weight-600 font-size-24">
          Our Partner
        </div>
      </div>
      <div
        class="bg-p-white pt-4 pb-3 px-3"
        style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"
      >
        <swiper
          v-if="10 > 0"
          class="ebiz_slider__client_partner px-4"
          :navigation="true"
          :modules="modules"
          :pagination="{
            clickable: true,
          }"
          :autoplay="{
            delay: 2500,
            disableOnInteraction: false,
          }"
        >
          <swiper-slide v-for="(itemPartner, index) in dataPartners">
            <div
              class="row align-items-center justify-content-center"
              :key="index"
            >
              <div
                class="col-md-2 col-4 gy-4"
                v-for="(item, index) in itemPartner"
                :key="item.id"
              >
                <div class="px-lg-4 px-3">
                  <img
                  :src="item.image"
                    alt="partner logo"
                    class="img-fluid"
                    style="max-height: 150px; width: 190px;"
                  />
                </div>
              </div>
            </div>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </section>
</template>

<script>
  import { Swiper, SwiperSlide } from "swiper/vue";
  import { Navigation, Pagination } from "swiper/modules";
  import "swiper/css";
  import "swiper/css/navigation";
  import 'swiper/css/pagination';

  export default {
    name: "Home",
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      return {
        modules: [Navigation, Pagination],
      };
    },
    mounted() {
      this.getData();
    },
    data() {
      return {
        hero_header: [],
        why_choose_me: [],
        how_to_order: [],
        you_must_know: [],
        achievement_result: [],
        email_inquiry: [],
        clients: [],
        partners: [],
        dataClient: [],
        dataPartners: [],
      };
    },
    methods: {
      getData() {
        axios.get(window.baseURL + 'api/frontend/home')
              .then((data) => {
                this.hero_header = data.data.data.homeSettings['hero_header']
                this.why_choose_me = data.data.data.homeSettings['why_choose_me']
                this.how_to_order = data.data.data.homeSettings['how_to_order']
                this.you_must_know = data.data.data.homeSettings['you_must_know']
                this.achievement_result = data.data.data.homeSettings['achievement_result']

                this.achievement_result.sort(function(a, b) { 
                  return ( a.id - b.id  ||  a.name.localeCompare(b.name) );
                });

                this.clients = data.data.data.clients
                this.partners = data.data.data.partners

                this.filterData()
              })
              .catch((err) => {
                  console.error(err);
              });
      },

      filterData() {
        this.clients.reduce((result, item, index) => {
          if (index % 12 === 0) {
            this.dataClient.push([]);
          }

          this.dataClient[Math.floor(index / 12)].push(item);
          return result;
        }, []);

        this.partners.reduce((result, item, index) => {
          if (index % 12 === 0) {
            this.dataPartners.push([]);
          }

          this.dataPartners[Math.floor(index / 12)].push(item);
          return result;
        }, []);
      },
    },
  };
</script>

<style>
  .swiper-button-next:after,
  .swiper-button-prev:after {
    color: white;
  }

  .swiper-button-next::after {
    content: "" !important;
    background: url(/assets/images/chevrons-right.svg);
    background-repeat: no-repeat;
    display: block;
    height: 25px;
    width: 25px;
  }

  .swiper-button-prev::after {
    content: "" !important;
    background: url(/assets/images/chevrons-left.svg);
    background-repeat: no-repeat;
    display: block;
    height: 25px;
    width: 25px;
  }

  .ebiz_slider__card {
    padding: 0 100px;
  }

  @media screen and (max-width: 493px) {
    .ebiz_slider__card {
      padding: 0 20px;
    }
  }

  .ebiz_slider__card .ebiz_item_slider__card:hover {
    background: #aecaf5 !important;
    transition: 0.5s;
    width: 370px !important;
    height: 438px !important;
  }

  .ebiz_slider__card .ebiz_item_slider__card:hover .text-p-white {
    color: black !important;
  }

  .ebiz_slider__client_partner .swiper-button-next:after,
  .ebiz_slider__client_partner .swiper-button-prev:after {
    color: black !important;
  }

  .ebiz_slider__client_partner .swiper-button-next::after {
    background: url(/assets/images/chevrons-right-black.svg) !important;
  }

  .ebiz_slider__client_partner .swiper-button-prev::after {
    background: url(/assets/images/chevrons-left-black.svg);
  }

  .ebiz_slider__client_partner .swiper-pagination-fraction,
  .ebiz_slider__client_partner .swiper-pagination-custom,
  .ebiz_slider__client_partner .swiper-horizontal > .swiper-pagination-bullets,
  .ebiz_slider__client_partner .swiper-pagination-bullets.swiper-pagination-horizontal {
      top: none !important;
      bottom: -7px !important;
  }

  .ebiz_slider__client_partner .swiper-pagination-bullet-active {
      background: black !important;
  }

  .flex-container { 
    display: flex;
    flex-wrap: wrap;
  } 

  .flex-item { 
    display: flex; 
    padding: 0.5em;
  }
</style>
