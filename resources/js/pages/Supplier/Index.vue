<template>
    <hero style="left: 32%" title="Become a Supplier" :showMenu="false" />
    <section class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="font-size-14 font-weight-400 text-p-black">
                Products > Species > Inquiry
            </div>
        </div>
    </section>
    <section class="container mt-4">
        <div>
            To become a supplier, please fill out the application form below. A member from our purchasing
            team will contact you as soon as possible.
        </div>
        <div class="mt-4">
            Before submitting the contact form, please verify that your products are compliable with CFIA’s
            labeling requirements, have billingual translation, and must contain a barcode.
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div>
                        <input-group label="Company" name="company" :required="true" />
                    </div>
                    <div>
                        <input-group label="Brand Name " name="brand_name " />
                    </div>
                    <div>
                        <input-group label="Legal Business Name" name="legal" :required="true" />
                    </div>
                    <div>
                        <input-group label="Type of Product" name="type" :required="true" />
                    </div>
                    <div>
                        <input-group label="Contact Name" name="contact_name" :required="true" />
                    </div>
                    <div>
                        <input-group label="Email" name="Email" :required="true" />
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
    name: "BecomeSupplier"
}
</script>