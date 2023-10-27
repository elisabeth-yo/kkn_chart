<template>
    <hero style="left: 32%" title="Become a Customer" :showMenu="false" />
    <section class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="font-size-14 font-weight-400 text-p-black">
                Products > Species > Inquiry
            </div>
        </div>
    </section>
    <section class="container mt-4">
        <div>
            We are committed to supplying customers no matter how big or small, with the same value and
            qualities that Enusantara has been renowned for.
        </div>
        <div class="mt-4">
            To become a customer, please use the contact form below, and you will be contacted by a sales
            agent as soon as possible. Please only use this form if you have a registered business, Enusantara
            does not sell directly to consumers. If you are interested in seeing where you can findour products
            at retail locations, please contact the office directly.
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <select-group label="I have a/ Iam" name="" />
                        </div>
                    </div>
                    <div>
                        <input-group label="Bussines Name" name="bussines_name" :required="true" />
                    </div>
                    <div>
                        <input-group label="Contact Name" name="contact" />
                    </div>
                    <div>
                        <input-group label="Email" name="email" />
                    </div>
                    <div>
                        <input-group label="Number Phone" name="number_phone" placeholder="ex +62 877 7878 8989" />
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form>
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
                    <div>
                        <input-group label="Categories of Interst" name="categories" />
                    </div>
                    <div>
                        <input-group label="Additions Details" name="details" />
                    </div>
                </form>

                <div class="mt-5 text-end">
                    <button class="btn btn-success px-5 py-3">
                        Send
                    </button>
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
    name: "BecomeCustomer"
}
</script>