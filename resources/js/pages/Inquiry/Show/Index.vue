<template>
    <hero title="Inquiry" />
    <section class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="font-size-14 font-weight-400 text-p-black">
                Products > Species > Inquiry
            </div>
        </div>
    </section>
    <section class="container py-5">
        <div class="d-flex align-items-center gap-5">
            <div>
                <img src="/assets/images/black-paper.png" alt="hero" />
            </div>
            <div class="font-size-22 font-weight-600">
                Black Pepper Kel. Tani Bunga Harapan Luwu Timur
            </div>
        </div>
    </section>
    <section class="container mt-4">
        <div class="card border-1 radius-10 border-p-orange-13">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="font-size-20 font-weight-500 text-p-orange-13">
                            Personal & Company Information
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <input-group label="First Name" name="firts_name" placeholder="Albert"
                                        :required="true" />
                                </div>
                                <div class="col-md-6">
                                    <input-group label="Last Name" name="last_name" placeholder="Wibowo" :required="true" />
                                </div>
                            </div>
                            <div>
                                <input-group label="Phone Number" name="phone_number" placeholder="+62 822 6767 7878"
                                    :required="true" />
                            </div>
                            <div>
                                <input-group label="Email" name="email" />
                            </div>
                            <div>
                                <input-group label="Company Name" name="company_name" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select-group label="Country" name="county" :required="true" />
                                </div>
                                <div class="col-md-6">
                                    <select-group label="City" name="city" />
                                </div>
                            </div>
                            <div>
                                <input-group label="Sub Distric" name="sub_distric" />
                            </div>
                            <div class="mt-4">
                                <div class="col-4">
                                    <div class="card radius-0">
                                        <div class="card-body p-2 bg-p-grey-43">
                                            F 5 K J 4 9 6
                                        </div>
                                    </div>
                                </div>
                                <input-group label="Captcha" name="captcha" :required="true" />
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="font-size-20 font-weight-500 text-p-orange-13">
                            Product Data
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <select-group label="Category Product" name="category" />
                                </div>
                            </div>
                            <div>
                                <input-group label="Name Product" name="name_product" />
                            </div>
                            <div>
                                <input-group label="Quantity" name="qty" type="number" />
                            </div>
                            <div>
                                <input-group label="Spect and Note" name="note" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select-group label="Payment Method" name="pay_method" />
                                </div>
                            </div>
                        </form>

                        <div class="mt-5 text-end">
                            <button class="btn btn-success px-5 py-3">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Hero from "@/components/Hero.vue";
import InputGroup from "@/components/InputGroup.vue";
import SelectGroup from "@/components/SelectGroup.vue";
export default {
    components: {
        Hero,
        InputGroup,
        SelectGroup,
    },
    name: "InquiryShow"
}
</script>