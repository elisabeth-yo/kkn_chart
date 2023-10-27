<template>
  <section class="hero">
    <div
      class="image-hero position-relative"
      style="margin-top: 4rem !important;"
    >
      <img :src="image" style="width: 100%; max-height: 450px;" />
      <div
        class="position-absolute w-100 py-md-5 py-lg-4 py-xl-5 d-flex align-items-center"
        style="top: 0; left: 0; bottom: 0; right: 0;"
      >
        <div class="container">
          <div class="row align-items-center">
            <div class="">
              <div
                class="font-weight-700 col-6 font-size-xl-36 font-size-lg-30 font-size-md-20 font-size-sm-18 font-size-14 text-p-black-7"
              >
                {{ title }}
              </div>
              <div class="font-weight-700 col-md-7 col-5 font-size-xl-20 font-size-lg-18 font-size-md-14 font-size-sm-12 font-size-10 text-p-white mt-2 ">
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
