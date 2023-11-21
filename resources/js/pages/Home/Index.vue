

<template>
  <section class="mt-0">
    <div>
      <b-carousel
        id="carousel-fade"
        v-model="slide"
        :interval="4000"
        controls
        fade
        img-width="1024"
        img-height="480"
        style="text-shadow: 1px 1px 2px #333;"
        @sliding-start="onSlideStart"
        @sliding-end="onSlideEnd"
      >
        <!-- Text slides with image -->
        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=57">
          <img src="/assets/images/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <h5>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</h5>
        </b-carousel-slide>

        <!-- Slides with custom text -->
        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
          <img src="/assets/images/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <p>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</p>
        </b-carousel-slide>

        <!-- Slides with image only -->
        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=66">
          <img src="/assets/images/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <p>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</p>
        </b-carousel-slide>
        
      </b-carousel>
    </div>
  </section>

  <section>
    <div class="row mx-0 my-5">
        <!-- Youtube -->
      <div class="col-xl-8 col-md-7 col-xs-12">
        <iframe width="770" height="460" class="px-xl-5 px-3 w-100 mb-xl-0 mb-5" src="https://www.youtube.com/embed/rMKdnJe-l0w?si=z_6AtnduD9PY2MsK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
      <div class="col-xl-4 col-md-5 col-xs-12 my-25 pe-xl-5 px-xl-0 px-4">
         <!-- Jadwal Ibadah -->
          <b-card
            title="Jadwal Ibadah Minggu Ini"
            img-height="85"
            img-top
            tag="warta"
            style="max-width: 40rem;"
            class="border bg-soft-blue"
          >
            <div class="row mx-0 mb-3">
              <div class="card mt-2">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="col-9">
                      <h6 class="counter mb-2">Ibadah Online Hari Minggu</h6><hr class="my-0">
                      <p class="mb-0 mt-2 fs-14">31 Agustus 2023</p>
                      <p class="mb-0 fs-14">08:00-10:30 WIB</p>
                    </div>
                    <div class="col-3">
                      <b-button href="#" variant="primary rounded-pill my-2 bg-navy fw-bold flex-row">Masuk</b-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="col-9">
                      <h6 class="counter mb-2">Ibadah Online Hari Minggu</h6><hr class="my-0">
                      <p class="mb-0 mt-2 fs-14">31 Agustus 2023</p>
                      <p class="mb-0 fs-14">08:00-10:30 WIB</p>
                    </div>
                    <div class="col-3">
                      <b-button href="#" variant="primary rounded-pill my-2 bg-navy fw-bold flex-row">Masuk</b-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="col-9">
                      <h6 class="counter mb-2">Ibadah Online Hari Minggu</h6><hr class="my-0">
                      <p class="mb-0 mt-2 fs-14">31 Agustus 2023</p>
                      <p class="mb-0 fs-14">08:00-10:30 WIB</p>
                    </div>
                    <div class="col-3">
                      <b-button href="#" variant="primary rounded-pill my-2 bg-navy fw-bold flex-row">Masuk</b-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </b-card>
      </div>
    </div>
  </section>
 
  <section> 
    <div class="row mx-0 my-5">
      <div class="col-xl-8 col-md-7 col-xs-12">
        <!-- Renungan Harian -->
        <b-card
            text-variant="center"
            img-alt="Image"
            img-height="85"
            tag="warta"
            style="max-width: 50rem;"
            class="mb-5 mx-5 border"
          >
            <b-card-text>
              <div
                v-for="(data, index) in datas.data" :key="index"
              >
                <h2>Renungan Harian</h2>
                <h4>{{ data.judul }}</h4>
              </div>
              <div class="container row mt-5 mx-0 scroll">
                <div class="col-md-12 col-xs-12" v-for="(data, index) in datas.data" :key="index">
                  <p class="text-justify">{{ data.deskripsi }}</p>
                  <p class="text-justify">{{ data.deskripsi }}</p>
                </div>
              </div>
              <div class="container row mt-2 mx-0">
              <div class="col-md-12 col-xs-12" v-for="(data, index) in datas.data" :key="index">
                <p class="text-justify">Penulis :  {{ data.sumber_referensi }}</p>
              </div>
              </div>
            </b-card-text>
        </b-card>
        <!-- Pengajuan Doa -->
        <b-card title="Punya Pergumulan dan Perlu Didoakan?" class="col-xl-11 col-10 col-xs-12 p-4 text-center mx-auto mb-xl-0 mb-5"  style="background-image:url(/assets/images/cta5.jpg);" >
          <b-button href="#" variant="btn primary btn-primary rounded-pill" class="mt-3 p-3 px-4"><strong>Hubungi Kami</strong></b-button>
        </b-card>
      </div>
      <!-- Warta Jemaat -->
      <div class="col-xl-4 col-md-5 col-xs-12 pe-xl-5 px-xl-0 px-4">
        <b-card
          title="Warta Jemaat"
          text-variant="center"
          img-src="/assets/images/bg-warta4.jpg"
          img-alt="Image"
          img-height="115"
          img-top
          tag="warta"
          style="max-width: 40rem;"
          class="border"
        >
          <b-card-text>
            <div class="scroll-warta">
              <table class="my-3 mx-3">
                <tr>
                  <td width="200px" class="text-center py-4"><img src="/assets/images/cover-warta1.jpeg" alt="" srcset="" @click="showPdf" style="height:120px;"/></td>
                  <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 5 November 2023</td>
                </tr>
                <tr>
                  <td width="200px" class="text-center pb-4"><img src="/assets/images/cover-warta2.jpeg" alt="" srcset="" @click="showPdf" style="height:120px;"/></td>
                  <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 12 November 2023</td>
                </tr>
                <tr>
                  <td width="200px" class="text-center pb-4"><img src="/assets/images/cover-warta1.jpeg" alt="" srcset="" @click="showPdf" style="height:120px;"/></td>
                  <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 19 November 2023</td>
                </tr>
                <tr>
                  <td width="200px" class="text-center"><img src="/assets/images/cover-warta2.jpeg" alt="" srcset="" @click="showPdf" style="height:120px;"/></td>
                  <td width="400px" class="text-start fs-15">Warta Jemaat<br> 26 November 2023</td>
                </tr>
              </table>
            </div>
          </b-card-text>
        </b-card>
      </div>
    </div>
  </section>

  <section class="wrapper pb-5">
    <!-- Persembahan -->
    <div class="container py-md-16">
        <div class="row mb-3">
        <div class="col-md-10 col-lg-12 col-xl-10 col-xxl-12 mx-auto text-center">
            <h4 class="text-center mb-4">Rekening Persembahan</h4>
        </div>
        <!--/column -->
        </div>
        <!--/.row -->
        <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0">
        <div class="col-md-6 col-lg-3 px-xl-3 px-5 pb-xl-0 pb-4">
            <div class="position-relative">
            <div class="shape rounded rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
            <div class="card">
              <figure class="card-img-top mb-0 px-5"><img class="img-fluid" src="/assets/images/logogkj.png" srcset="/assets/images/qr.png" alt="" /></figure>
              <div class="card-body px-6 pb-4 pt-1">
                <h5 class="mb-1">Persembahan Mingguan/Bulanan/Istimewa</h5><hr>
                <h4 class="mb-1">157-00-0626070-8</h4>
                <p class="mb-0">Bank Mandiri</p>
              </div>
              <!--/.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /div -->
        </div>
        <!--/column -->
        <div class="col-md-6 col-lg-3 px-xl-3 px-5 pb-xl-0 pb-4">
            <div class="position-relative">
            <div class="shape rounded bg-soft-red rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
            <div class="card">
              <figure class="card-img-top mb-0 px-5"><img class="img-fluid" src="/assets/images/qr.png" srcset="/assets/images/qr.png" alt="" /></figure>
              <div class="card-body px-6 pb-4 pt-1">
                <h5 class="mb-1">Dana Pembangunan</h5><hr>
                <h4 class="mb-1">157-00-0626068-2</h4>
                <p class="mb-0">Bank Mandiri</p>
              </div>
              <!--/.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /div -->
        </div>
        <!--/column -->
        <div class="col-md-6 col-lg-3 px-xl-3 px-5 pb-xl-0 pb-4">
            <div class="position-relative">
            <div class="shape rounded bg-soft-green rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
            <div class="card">
              <figure class="card-img-top mb-0 px-5"><img class="img-fluid" src="/assets/images/qr.png" srcset="/assets/images/qr.png" alt="" /></figure>
              <div class="card-body px-6 pb-4 pt-1">
                <h5 class="mb-1">Dana Abadi</h5><hr>
                <h4 class="mb-1">157-00-0626067-4</h4>
                <p class="mb-0">Bank Mandiri</p>
              </div>
              <!--/.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /div -->
        </div>
        <!--/column -->
        <div class="col-md-6 col-lg-3 px-xl-3 px-5 pb-xl-0 pb-4">
            <div class="position-relative">
            <div class="shape rounded bg-soft-violet rellax d-md-block" data-rellax-speed="0" style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
            <div class="card">
                <figure class="card-img-top mb-0 px-5"><img class="img-fluid" src="/assets/images/qr.png" srcset="/assets/images/qr.png" alt="" /></figure>
                <div class="card-body px-6 pb-4 pt-1">
                  <h5 class="mb-1">Diakonia</h5><hr>
                  <h4 class="mb-1">157-00-0665450-4</h4>
                  <p class="mb-0">Bank Mandiri</p>
                </div>
                <!--/.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /div -->
        </div>
        <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->

  <section>
    <!-- Pengajuan Doa -->
    <div class="row mx-0 px-xl-0 ">
      <div class="col-md-12 col-xl-12 px-5 mb-5">
        <img src="/assets/images/peta-gkj.png" alt="" srcset="/assets/images/peta-gkj.png" class="w-100 h-100 ms-xl-5 px-5"/>
      </div>
      <div class="col-xl-9 col-xxl-9 mx-auto mb-5">
        <div class="row align-items-center justify-content-center counter-wrapper gy-6">
          <div class="col-md-3 col-lg-3 col-5 mb-xl-0 mb-3">
            <b-card
            border-variant="secondary"
            header="Sawangan"
            header-text-variant="white h6 fw-bold"
            align="center"
            header-class="bg-peta1"
          >
            <b-card-text>
              <h1>270+</h1>
              <h5>Jiwa</h5>
            </b-card-text>
            </b-card>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 col-lg-3 col-5 mb-xl-0 mb-3">
            <b-card
            border-variant="secondary"
            header="Depok Utara"
            header-text-variant="white h6 fw-bold"
            align="center"
            header-class="bg-peta2"
          >
            <b-card-text>
              <h1>206+</h1>
              <h5>Jiwa</h5>
            </b-card-text>
            </b-card>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 col-lg-3 col-5">
            <b-card
            border-variant="secondary"
            header="Depok 1"
            header-text-variant="white h6 fw-bold"
            align="center"
            header-class="bg-peta3"
          >
            <b-card-text>
              <h1>245+</h1>
              <h5>Jiwa</h5>
            </b-card-text>
            </b-card>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 col-lg-3 col-5">
            <b-card
            border-variant="secondary"
            header="Depok Timur Tengah"
            header-class="bg-peta4"
            header-text-variant="white h6 fw-bold"
            align="center"
          >
            <b-card-text>
              <h1>108+</h1>
              <h5>Jiwa</h5>
            </b-card-text>
            </b-card>
            <!--/.card -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /column -->
    </div>
  </section>
  
  

</template>

<script>
  import { Swiper, SwiperSlide } from "swiper/vue";
  import { Navigation, Pagination } from "swiper/modules";
  import "swiper/css";
  import "swiper/css/navigation";
  import 'swiper/css/pagination';
  import { watch, ref, onMounted } from "vue";
    
  
  
  // import 'vue-pdf';
  // import 'vue-pdf/dist/pdf.worker.css';
  // const datas              = ref({'data': []});
  
  // const getDatas = async (page = 1) => {
  //       pageNumber.value = page;
        
  //       const queryParam = {
  //           page: page,
  //           search: searchQuery.value
  //       };
  //        await axios.get("/api/renunganharian")
  //       .then((RESPONSE) => {
  //           datas.value              = RESPONSE.data;
  //           console.log(RESPONSE);
  //           dataLinkPagination.value = RESPONSE.data.meta.links;
  //       })
  //       .catch((ERROR) => {
  //           // alert(ERROR.response.data.message);
  //       });
  //   };
  //   onMounted(() => {
  //       getDatas();
  //   });
  //  v-for="(data, index) in datas.data" :key="index"
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
    
    data() {
      return {
        hero_header: [],
        datas: [],
        loaderRenunganHarian: [],
        pdfUrl: '/assets/pdf/zz.pdf',
      };
    },

    mounted() {
        this.getRenunganHarian();
    },

    computed: {
        containerElement() {
            return document.querySelector(".overflow-auto");
        },
        contentElement() {
            return document.querySelector(".achievement");
        },
        maxScrollOffset() {
            return (
                this.contentElement.scrollWidth - this.containerElement.clientWidth
            );
        },
    },

    methods: {
          
        async getRenunganHarian() {
            console.log("hai");
            this.loaderRenunganHarian = true;
            try {
                const res = await axios.get("/api/renunganharian");
                console.log(res);
                this.datas = res.data.data;
            } catch (err) {
                console.log(err);
            }
            this.loaderRenunganHarian = false;
        },
        
        scrollLeft() {
            this.scrollOffset -= this.scrollStep;
            if (this.scrollOffset < 0) {
                this.scrollOffset = 0;
            }
            this.scrollToOffset();
        },
        scrollRight() {
            this.scrollOffset += this.scrollStep;
            if (this.scrollOffset > this.maxScrollOffset) {
                this.scrollOffset = this.maxScrollOffset;
            }
            this.scrollToOffset();
        },
        scrollToOffset() {
            this.containerElement.scrollLeft = this.scrollOffset;
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }

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

  .gkj_slider__card {
    padding: 0 100px;
  }

  .text-justify {
  text-align: justify;
  }

  .fs-14{
    font-size: 14px;
  }

  .fs-15{
    font-size: 15px;
  }

  .bg-soft-blue{
    background: #E0F4FF;
  }

  .bg-navy{
    background: #001D6A;
  }

  .bg-yellow{
    background: #f6b269;
  }

  .bg-orange{
    background: #dd753e;
  }

  .scroll {
    max-height: 310px;
    overflow-y: auto;
  }

  .scroll-warta {
      max-height: 500px;
      overflow-y: auto;
  }

  @media screen and (max-width: 493px) {
    .gkj_slider__card {
      padding: 0 20px;
    }
  }

  .gkj_slider_card .ebiz_item_slider_card:hover {
    background: #aecaf5 !important;
    transition: 0.5s;
    width: 370px !important;
    height: 438px !important;
  }

  .gkj_slider_card .ebiz_item_slider_card:hover .text-p-white {
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

  .carousel-fade .carousel-item {
 opacity: 0;
 transition-duration: .6s;
 transition-property: opacity;
}

.carousel-fade  .carousel-item.active,
.carousel-fade  .carousel-item-next.carousel-item-left,
.carousel-fade  .carousel-item-prev.carousel-item-right {
  opacity: 1;
}

.carousel-fade .active.carousel-item-left,
.carousel-fade  .active.carousel-item-right {
 opacity: 0;
}

.carousel-fade  .carousel-item-next,
.carousel-fade .carousel-item-prev,
.carousel-fade .carousel-item.active,
.carousel-fade .active.carousel-item-left,
.carousel-fade  .active.carousel-item-prev {
 transform: translateX(0);
 transform: translate3d(0, 0, 0);
}
</style>

