<template>
    <section>
      <div class="px-10 pt-10 d-flex justify-content-center" style="height: 100%; width:100%;">
          <div class="fs-3 fw-bold text-blue">
              Pelatihan Multimedia
          </div>
      </div>
      </section>
    <section class="container">
        <section class="container mb-5">
            <div class="row py-5 d-flex justify-content-center">
                <div class="col-md-8">
                    <figure>
                        <img src="/assets/images/header1.jpg" style="width: 100%;" class="img-fluid" />
                    </figure>
                    <article class="mt-4">
                        <div style="text-align:justify">
                          <p>Kegiatan ini dilaksanakan pada tanggal 23 Oktober 2023 lalu, dan diikuti oleh 50 orang dari segala umur perwakilah wilayah.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </section>
  </template>
  
  <script>
  import axios from "axios";
  import { parseHtml, formatDate } from '@/Helper/Helpers';
  import moment from 'moment';
  import router from "../../../router";
  export default {
    name: "Index",
    data() {
        return {
            detail: {},
            loaderDetail: false,
            recentNews: [],
            loadingRecentNews: false,
        };
    },
    methods: {
        async getDetail() {
            this.loaderDetail = true;
            try {
                const {slug} = this.$route.params;
                const response = await axios.get(`/api/newszz/getDetail/${slug}`);
                this.detail = response.data;
            } catch (error) {
                console.log(error);
            }
            this.loaderDetail = false;
        },
        async getRecentNews() {
            this.loadingRecentNews = true;
            try {
                const res = await axios.get('/api/news/getAll?limit=3&sort=desc');
                res.data.data.forEach((item) => {
                    item.content = parseHtml(item.content).length > 100 ? parseHtml(item.content).substring(0, 100) + '...' : parseHtml(item.content);
                    item.created_at = moment(item.created_at).format('YYYY, MMMM DD');
                });
                this.recentNews = res.data.data;
            } catch (error) {
                console.log(error);
            }
            this.loadingRecentNews = false;
        }
    },
    mounted() {
        this.getDetail();
        this.getRecentNews();
        // this.reloadAndScrollTop();
    },
  }
  </script>
  