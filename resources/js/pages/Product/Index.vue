<template>
  <Hero title="Product" />
  <section class="container mt-4">
    <div class="d-flex justify-content-between align-items-start">
      <div>
        <div class="font-size-14 font-weight-400 text-p-black">
          Products <button @click="fetchData">tes</button>
        </div>
      </div>
      <div class="text-end">
        <div
          class="d-flex justify-content-between align-items-center position-relative bg-p-grey-43 mb-4"
        >
          <input
            type="text"
            class="rounded-0 py-1 px-3 border-0 bg-transparent"
            placeholder="Search"
            style="min-width: 250px;"
          />
          <div class="btn btn-p-orange-13 rounded-0">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-search text-p-white"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
              <path d="M21 21l-6 -6"></path>
            </svg>
          </div>
        </div>
        <div class="btn btn-p-grey-43 rounded-0 p-2 text-p-orange-13 font-weight-700 font-size-16">
            request quote by your self
        </div>
      </div>
    </div>
  </section>
  <section class="container mt-4">
    <div class="row g-5">
      <div class="col-lg-3 col-md-4 col-sm-6" v-for="item in products">
        <div class="card rounded-0 border-0 bg-transparent">
          <div class="card-body p-0 position-relative">
            <div>
              <img :src="item.image" class="img-fluid w-100" />
            </div>
            <div>
              <div class="mt-2">
                <div class="font-size-15 font-weight-400 text-p-grey-56 mx-3">
                  Species
                </div>
                <div
                  class="font-size-16 font-weight-600 text-p-black mx-3 my-2"
                >
                  {{ item.name }}
                </div>
              </div>
              <router-link
                to="/inquiry"
                class="btn btn-p-grey-43 font-size-14 font-weight-700 text-p-orange-13 text-center w-100 rounded-0 mt-2"
              >
                Request Quote
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Hero from "@/components/Hero.vue";
export default {
  components: {
    Hero,
  },
  data() {
    return {
      navbar: [
        "Spices",
        "Palm Oil  Derivatives & Biomass",
        "Fishery",
        "Chinese Med",
        "Others",
      ],
      products: [
        {
          name: "Spices",
          image: "/assets/images/product-04.png",
        },
        {
          name: "Palm Oil Derivatives",
          image: "/assets/images/product-05.png",
        },
        {
          name: "Fishery",
          image: "/assets/images/product-06.png",
        },
        {
          name: "Chinese Med",
          image: "/assets/images/product-07.png",
        },
        {
          name: "Others",
          image: "/assets/images/product-07.png",
        },
      ],
    };
  },
  methods: {
        fetchData() {
            fetch('https://randomuser.me/api/?results/500', {
                method: "GET",
                // headers: {
                // "X-RapidAPI-Key": 'your-api-key',
                // "X-RapidAPI-Host": 'facts-by-api-ninjas.p.rapidapi.com',
                // },
            })
            .then((response) => {
                response.json().then((data) => {
                    console.log(data)
                });
            })
            .catch((err) => {
                console.error(err);
            });
        },
        getIndustries() {
          axios.get('api/industries')
              .then((data) => {
                console.log(data)
              })
        }
  },
  beforeMount() {
    this.fetchData()
  },
  onMounted() {
    this.getIndustries()
  },
  name: "Product",
};
</script>
