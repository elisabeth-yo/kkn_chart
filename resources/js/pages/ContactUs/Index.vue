<template>
    <hero style="left: 32%" title="Contact Us" :showMenu="false" />
    <section class="container my-5">
        <div class="font-size-22 font-weight-600">
            Join With Us
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="border-radius: 0 !important;">
                    <div class="card-header bg-p-orange-9" style="border-radius: 0 !important;">
                        <div class="font-size-18 font-weight-700 text-center">
                            Benefit join Becoome a Customer
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="font-size-16 font-weight-400">
                            <ol>
                                <li>Get the best price</li>
                                <li>Get the best quality</li>
                                <li>Get the best service</li>
                                <li>Get the best delivery</li>
                            </ol>
                        </div>
                        <div class="text-center py-2">
                            <router-link to="/become-a-customer" class="btn radius-0 btn-p-grey-35 px-4">
                                Become a Customer
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 0 !important;">
                    <div class="card-header bg-p-orange-9" style="border-radius: 0 !important;">
                        <div class="font-size-18 font-weight-700 text-center">
                            Benefit join Becoome a Supplier
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="font-size-16 font-weight-400">
                            <ol>
                                <li>Get the best price</li>
                                <li>Get the best quality</li>
                                <li>Get the best service</li>
                                <li>Get the best delivery</li>
                            </ol>
                        </div>
                        <div class="text-center py-2">
                            <router-link to="/become-a-supplier" class="btn radius-0 btn-p-grey-35 px-4">
                                Become a Supplier
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
import InputGroup from "@/components/InputGroup.vue";
import SelectGroup from "@/components/SelectGroup.vue";
export default {
    components: {
        Hero,
        InputGroup,
        SelectGroup,
    },
    name: "ContactUs"
}
</script>
