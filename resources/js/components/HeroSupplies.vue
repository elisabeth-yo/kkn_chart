<template>
  <section class="hero">
    <div
      class="image-hero position-relative"
      style="margin-top: 4rem !important;"
    >
      <img :src="image" style="width: 100%;" />
      <div
        class="position-absolute w-100 py-md-5 py-lg-4 py-xl-5 d-flex align-items-center"
        style="top: 0; left: 0; bottom: 0; right: 0;"
      >
        <div class="container">
          <div class="row align-items-center">
            <div class="">
              <div
                class="font-weight-700 col-6 font-size-xl-22 font-size-lg-20 font-size-md-16 font-size-sm-14 font-size-10 text-p-white"
              >
                {{ title }}
              </div>
              <div class="font-weight-700 col-md-7 col-5 font-size-xl-16 font-size-lg-14 font-size-md-12 font-size-sm-10 font-size-6 text-p-white mt-md-3 mt-1">
                {{ subTitle }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Hero",
  props: {
    title: {
      type: String,
      default: "",
    },
    subTitle: {
      type: String,
      default: true,
    },
    image: {
      type: String,
      default: "",
    },
  },
  data() {
    return {};
  },
};
</script>
