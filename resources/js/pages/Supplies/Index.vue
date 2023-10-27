<template>
  <div>
    <HeroSupplies
      :title="'Discover a vast selection of ' + `${supply.title}` + ' supplies'"
      subTitle="Sustainable and innovative purchasing solutions"
      image="/assets/images/hero-supplies.png"
    />
    <section style="margin-top: 100px;">
      <div class="container">
        <div class="row g-4">
          <div class="col-md-3" v-for="(item, index) in functionality" :key="index">
            <div class="text-center">
              <img :src="item.image" />
              <div class="font-weight-700 mt-1 font-size-20">
                {{ item.title }}
              </div>
            </div>
            <div class="font-weight-400 mt-1 font-size-12">
              {{ item.subTitle }}
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="margin-top: 100px;">
      <div class="container">
        <div class="row g-5">
          <div class="col-md-3">
            <div class="font-weight-700 font-size-21">
              Buy {{ supply.title }} items from trusted brands
            </div>
          </div>
          <div class="col-md-9 ms-auto">
            <table>
              <template
                v-for="(itemFilter, indexFilter) in brandFilter"
                :key="indexFilter"
              >
                <tr>
                  <td
                    v-for="(itemParent, index) in itemFilter"
                    @click="setShowBrand(index)"
                    :key="index"
                    class="px-5"
                    style="cursor: pointer;"
                  >
                    <img
                      :src="itemParent.image"
                      class="img-fluid"
                      alt=""
                      style="max-width: 200px;"
                      @mouseover="setShowBrand(index)"
                    />
                  </td>
                </tr>
                <tr v-for="(item, indexItem) in itemFilter" :key="indexItem">
                  <td
                    colspan="3"
                    class="text-center"
                    v-if="showBrandItem[indexItem]"
                  >
                    <div
                      class="card radius-10"
                      style="border: 5px solid #142f56; margin-top: 30px;"
                    >
                      <div class="card-body py-5 px-4">
                        <div class="row">
                          <div
                            class="col-md-4 text-center"
                            v-for="(product, index) in item.products"
                            :key="index"
                          >
                            <img
                              :src="product.image"
                              class="img-fluid"
                              alt=""
                            />
                            <div class="font-weight-700 font-size-12">
                              {{ product.title }}
                            </div>
                            <div class="font-weight-400 font-size-12">
                              15mil thick all-purpose chemical protection which
                              performs well in a wide variety of applications
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </template>
            </table>
          </div>
        </div>
      </div>
    </section>

    <section class="container mt-4">
        <div class="card border-1 radius-10 border-p-orange-13">
            <div class="card-body">
                <div class="row"> 
                  <div class="col-md-4">

                  </div>
                  <div class="col-md-8">
                      <div class="font-size-20 font-weight-500 text-p-orange-13 text-center">
                          <h3>Form Inquiry</h3>
                      </div>
                      
                      <Form ref="form" @submit="handleSubmitInquiryForm" :validation-schema="submitInquirySchema" :initial-values="formValues" v-slot="{ errors }">
                          <div class="form-group mb-3">
                              <label for="product_name">PRODUCT NAME</label>
                              <Field name="product_name" type="text" class="form-control" :class="{ 'is-invalid': errors.product_name }" id="product_name" aria-describedby="productNameHelp" placeholder="e.g Mask" />
                              <span class="invalid-feedback">{{ errors.product_name }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="quantity">QUANTITY</label>
                              <Field name="quantity" type="number" class="form-control" :class="{ 'is-invalid': errors.quantity }" id="quantity" aria-describedby="productNameHelp" placeholder="e.g 10" />
                              <span class="invalid-feedback">{{ errors.quantity }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="detail_product">DETAIL PRODUCT</label>
                              <Field name="detail_product" as="textarea" class="form-control" :class="{ 'is-invalid': errors.detail_product }" id="detail_product" aria-describedby="productNameHelp" placeholder="e.g 10" />
                              <span class="invalid-feedback">{{ errors.detail_product }}</span>
                          </div>
                          <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image" aria-describedby="imageHelp" accept="image/*" />
                            <span class="invalid-feedback">{{ errors.image }}</span>
                        </div>
                          <div class="form-group mb-3">
                              <label for="name">YOUR NAME</label>
                              <Field name="name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }" id="name" aria-describedby="productNameHelp" placeholder="e.g Maria" />
                              <span class="invalid-feedback">{{ errors.name }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="email">EMAIL</label>
                              <Field name="email" type="text" class="form-control" :class="{ 'is-invalid': errors.email }" id="email" aria-describedby="productNameHelp" placeholder="e.g mary@example.com" />
                              <span class="invalid-feedback">{{ errors.email }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="phone">PHONE</label>
                              <Field name="phone" type="text" class="form-control" :class="{ 'is-invalid': errors.phone }" id="phone" aria-describedby="productNameHelp" placeholder="e.g 081-xxx-xxx" />
                              <span class="invalid-feedback">{{ errors.phone }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="business_name">BUSINESS NAME</label>
                              <Field name="business_name" type="text" class="form-control" :class="{ 'is-invalid': errors.business_name }" id="business_name" aria-describedby="productNameHelp" placeholder="e.g PT. ABC" />
                              <span class="invalid-feedback">{{ errors.business_name }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="shipping_terms">BUSINESS ADDRESS</label>
                              <Field name="business_address" as="textarea" class="form-control" :class="{ 'is-invalid': errors.business_address }" id="business_address" aria-describedby="productNameHelp" placeholder="e.g ELEVENIA" />
                              <span class="invalid-feedback">{{ errors.business_address }}</span>
                          </div>
                          <div class="form-group mb-3">
                              <label for="shipping_terms">SHIPPING TERMS</label>
                              <Field name="shipping_terms" as="select" class="form-control" :class="{ 'is-invalid': errors.shipping_terms }" id="shipping_terms">
                                <option value="" disabled>==Select Shipping Terms==</option>
                                <template v-for="(v) in shippingTerms" :key="v">
                                    <option :value="v.title">{{ v.title.toUpperCase() }}</option>
                                </template>
                            </Field>
                            <span class="invalid-feedback">{{ errors.shipping_terms }}</span>
                          </div>
                          <div class="mt-5 text-end">
                            <button class="btn btn-success px-5 py-3" :disabled="loading">
                                <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span v-else>Send</span>
                            </button>
                          </div>
                    </Form>
                  </div>
                </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script setup>
  import HeroSupplies from "@/components/HeroSupplies.vue";
  
  import { watch, ref, onMounted } from "vue";
  import { useRouter, useRoute } from "vue-router";
  import { requestDelete, requestGet, requestPatch, requestPost } from "../../admin/api/api";
  import { useToastr } from '@/admin/toastr';
  import { debounce } from 'lodash';
  import axios from "axios";

  import * as yup from 'yup';
  import $ from 'jquery';
  import { Form, Field } from 'vee-validate';

  const route  = useRoute();
  const router = useRouter();
  const toastr = useToastr();
  const MAX_FILE_SIZE = 2048000; //100KB
  const loading = ref(false);

  //SUPPLY
  const supplyName = route.params.supplies
  const showBrandItem = ref([])
  const supply = ref([])
  const brands = ref([])
  const brandFilter = ref([])
  const formValues = ref(null)
  const shippingTerms = ref([])
  const form = ref(null)
  const submitInquirySchema = yup.object({
      product_name: yup.string().required(),
      quantity: yup.string().required(),
      detail_product: yup.string().required(),
      name: yup.string().required(),
      email: yup.string().required(),
      phone: yup.string().required(),
      business_name: yup.string().required(),
      business_address: yup.string().required(),
      shipping_terms: yup.string().required(),
      image: yup.mixed().nullable(true).test("is-valid-size", "Max allowed size is 2MB", value => value && value.size <= MAX_FILE_SIZE)
  });

  //METHOD
  const getData = () => {
    axios.get(window.baseURL + 'api/frontend/supplies/get/' + supplyName)
          .then((RESPONSE) => {
            supply.value = RESPONSE.data.data.supply
            brands.value = RESPONSE.data.data.supply.brands
            shippingTerms.value = RESPONSE.data.data.shipping_terms

            filterBrandItem();

            brands.value.map((item, index) => {
              showBrandItem.value.push(false);
            });
          })
          .catch((err) => {
              
          });
  }
  
  const filterBrandItem = () => {
    brands.value.reduce((result, item, index) => {
      if (index % 3 === 0) {
        brandFilter.value.push([]);
      }

      brandFilter.value[Math.floor(index / 3)].push(item);
      return result;
    }, []);
  }

  const setShowBrand = (index) => {
    showBrandItem.value.map((item, indexItem) => {
      if (indexItem != index) showBrandItem.value[indexItem] = false;
      else showBrandItem.value[indexItem] = !showBrandItem.value[indexItem];
    });
  }

  const handleSubmitInquiryForm = (values, { resetForm, setErrors }) => {
    loading.value = true;

    const formData = new FormData();

    Object.keys(values).forEach(key => {
        if (values[key] && key !== 'id') {
            formData.append(key, values[key])                
        }
    });

    axios.post(window.baseURL + 'api/frontend/send-inquiry', formData)
          .then(res => {
            resetForm()
            toastr.success(res.data.message)
            loading.value = false;
          })
          .catch(er => {
            if (er.response.status == 429) {
              toastr.error("Too much submit form")
            } else if (er.response.data.message) {
              toastr.error(er.response.data.message)
            }

            loading.value = false;
          });
  };

  // MOUNTED
  onMounted(() => {
    getData();
  });
</script>
