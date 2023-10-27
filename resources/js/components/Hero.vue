<template>
    <section class="hero">
        <div class="image-hero position-relative" style="margin-top: 4rem !important;">
            <img src="/assets/images/hero-product-bg.png" style="width: 100%;" />
            <div class="position-absolute w-100 py-md-5 py-lg-4 py-xl-5" style="top: 30%;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div
                            class="font-weight-700 font-size-xl-40 font-size-lg-30 font-size-md-20 font-size-sm-18 font-size-14 text-p-orange-12">
                            {{ title }}
                        </div>
                        </div>
                        <div class="col-9 mx-auto">
                            <div class="d-flex gap-md-4 justify-content-start gap-2 flex-wrap w-100">
                                <div v-for="item in navbar"
                                    class="font-weight-600 text-nowrap font-size-xl-20 font-size-lg-20 font-size-md-10 font-size-sm-5 font-size-8 text-p-black">
                                    {{ item }}
                                </div>
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
        showMenu: {
            type: Boolean,
            default: true,
        },
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
        };
    },
};
</script>
