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
          <img src="/assets/images/carousel/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <h5>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</h5>
        </b-carousel-slide>

        <!-- Slides with custom text -->
        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
          <img src="/assets/images/carousel/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <p>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</p>
        </b-carousel-slide>

        <!-- Slides with image only -->
        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=66">
          <img src="/assets/images/carousel/logogkj.png" class="justify-content-center mb-4" style="height:300px;" />
          <h2>Selamat Datang di Gereja Kristen Jawa Yeremia</h2>
          <p>"Menjadi Jemaat Kristus yang Mewartakan Kerajaan Allah"</p>
        </b-carousel-slide>
        
      </b-carousel>
    </div>
  </section>
 
  <section>
    <div class="row mx-0 my-5">
      <div class="col-md-8 col-xs-12">
        <iframe width="770" height="380" class="px-5 w-100" src="https://www.youtube.com/embed/rMKdnJe-l0w?si=z_6AtnduD9PY2MsK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <b-card v-for="(item, index) in renungan_harians"
            title= {{ item.judul }}
            sub-title="Daniel 6 : 16-18"
            text-variant="center"
            img-alt="Image"
            img-height="85"
            tag="warta"
            style="max-width: 50rem;"
            class="mb-xl-2 mb-5 mt-5 mx-5 border"
          >
            <b-card-text>
              <div class="row mx-0 my-3">
                <div class="col-md-8 col-xs-12">
                  <b-img src="https://picsum.photos/1024/400/?image=43" fluid alt="Responsive image" class="mb-4"></b-img>
                  <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="col-md-4 col-xs-12">
                  <b-img src="https://picsum.photos/170/250/?image=43" fluid alt="Responsive image" class="mb-4"></b-img>
                  <p class="text-justify px-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
              </div>
            </b-card-text>
        </b-card>
      </div>
      <div class="col-md-4 col-xs-12 my-25 pe-xl-5 px-xl-0 px-5">
        <div>
          <b-card
            title="Jadwal Ibadah Minggu Ini"
            img-height="85"
            img-top
            tag="warta"
            style="max-width: 30rem;"
            class="mb-5 border bg-soft-blue"
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
                      <a href="#" class="btn bg-navy text-white rounded-pill my-4 mx-2 fs-14 fw-bold">Masuk</a>
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
                      <a href="#" class="btn bg-navy text-white rounded-pill my-4 mx-2 fs-14 fw-bold">Masuk</a>
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
                      <a href="#" class="btn bg-navy text-white rounded-pill my-4 mx-2 fs-14 fw-bold">Masuk</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </b-card>

          <b-card
            title="Warta Jemaat"
            text-variant="center"
            img-src="/assets/images/carousel/bg-warta4.jpg"
            img-alt="Image"
            img-height="85"
            img-top
            tag="warta"
            style="max-width: 30rem;"
            class="border"
          >
            <b-card-text>
              <div>
                <table class="my-3 mx-3">
                  <tr>
                    <td width="100px" class="text-center py-3"><a href="#"><i class="fas fa-file-pdf" @click="showPdf" style="height:40px;"></i></a></td>
                    <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 5 November 2023</td>
                  </tr>
                  <tr>
                    <td width="100px" class="text-center pb-3"><a href="#"><i class="fas fa-file-pdf" @click="showPdf" style="height:40px;"></i></a></td>
                    <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 5 November 2023</td>
                  </tr>
                  <tr>
                    <td width="100px" class="text-center pb-3"><a href="#"><i class="fas fa-file-pdf" @click="showPdf" style="height:40px;"></i></a></td>
                    <td width="400px" class="text-start fs-15 pb-3">Warta Jemaat<br> 5 November 2023</td>
                  </tr>
                  <tr>
                    <td width="100px" class="text-center"><a href="#"><i class="fas fa-file-pdf" @click="showPdf" style="height:40px;"></i></a></td>
                    <td width="400px" class="text-start fs-15">Warta Jemaat<br> 5 November 2023</td>
                  </tr>
                </table>
              </div>
            </b-card-text>
          </b-card>
        </div>
      </div>
    </div>
  </section>
  
  <section>
    <div class="row mx-0 px-xl-0 px-5">
    <b-card title="Punya Pergumulan dan Perlu Didoakan?" class="col-md-11 p-4 mb-5 text-center mx-auto"  style="background-image:url(/assets/images/carousel/cta5.jpg);" >
      <b-button href="#" variant="primary" class="mt-3"><strong>Hubungi Kami</strong></b-button>
    </b-card>
    </div>
  </section>
  

</template>

<script>
  import { Swiper, SwiperSlide } from "swiper/vue";
  import { Navigation, Pagination } from "swiper/modules";
  import "swiper/css";
  import "swiper/css/navigation";
  import 'swiper/css/pagination';
  
  // import 'vue-pdf';
  // import 'vue-pdf/dist/pdf.worker.css';

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
        judul: [],
        deskripsi: [],
        gambar_bahan_bacaan: [],


        dataPartners: [],
        pdfUrl: '/assets/pdf/zz.pdf',
      };
    },
  
    methods: {
      getData() {
        axios.get(window.baseURL + 'api/frontend/home')
              .then((data) => {
                this.judul = data.data.data.renunganharian['judul']
                this.deskripsi = data.data.data.renunganharian['deskripsi']
                this.gambar_bahan_bacaan = data.data.data.renunganharian['gambar_bahan_bacaan']
              
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

  @media screen and (max-width: 493px) {
    .gkj_slider__card {
      padding: 0 20px;
    }
  }

  .gkj_slider__card .ebiz_item_slider__card:hover {
    background: #aecaf5 !important;
    transition: 0.5s;
    width: 370px !important;
    height: 438px !important;
  }

  .gkj_slider__card .ebiz_item_slider__card:hover .text-p-white {
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