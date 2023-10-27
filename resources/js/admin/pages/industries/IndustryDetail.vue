<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Industries Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Industries</li>
                        <li class="breadcrumb-item active">Industries Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Industrie</h3>
                </div>

                <Form ref="formIndustrie" @submit="handleSubmitFormIndustrie" :validation-schema="updateFormIndustrie" v-slot="{ errors }" :initial-values="formValuesIndustrie">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <Field name="title" type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" aria-describedby="titleHelp" placeholder="Enter title" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <Field name="description" as="textarea" class="form-control" :class="{ 'is-invalid': errors.description }" id="description" aria-describedby="descriptionHelp" placeholder="Enter description" />
                            <span class="invalid-feedback">{{ errors.description }}</span>
                        </div>

                        <div class="form-group">
                            <label for="header_description">Header Description</label>
                            <Field name="header_description" as="textarea" class="form-control" :class="{ 'is-invalid': errors.header_description }" id="header_description" aria-describedby="header_descriptionHelp" placeholder="Enter header description" />
                            <span class="invalid-feedback">{{ errors.header_description }}</span>
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <Field name="slogan" type="text" class="form-control" :class="{ 'is-invalid': errors.slogan }" id="slogan" aria-describedby="sloganHelp" placeholder="Enter slogan" />
                            <span class="invalid-feedback">{{ errors.slogan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="header_slogan">Header Slogan</label>
                            <Field name="header_slogan" type="text" class="form-control" :class="{ 'is-invalid': errors.header_slogan }" id="header_slogan" aria-describedby="header_sloganHelp" placeholder="Enter header slogan" />
                            <span class="invalid-feedback">{{ errors.header_slogan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div v-if="formIndustrieImage">
                                <br>
                                <img :src="formIndustrieImage.image" class="img">
                            </div>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image" aria-describedby="imageHelp" accept="image/*" />
                            <span class="invalid-feedback">{{ errors.image }}</span>
                        </div>

                        <div class="form-group">
                            <label for="header_image">Header Image</label>
                            <div v-if="formIndustrieImage">
                                <br>
                                <img :src="formIndustrieImage.header_image" class="img">
                            </div>
                            <Field name="header_image" type="file" class="form-control" :class="{ 'is-invalid': errors.header_image }" id="header_image" accept="image/*" aria-describedby="header_imageHelp"/>
                            <span class="invalid-feedback">{{ errors.header_image }}</span>
                        </div>                     

                    </div>

                    <div class="card-footer" style="display: flex; gap: 5px;">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-info" @click="back">Back</button>
                    </div>
                </Form>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="d-flex justify-content-end">                        
                        <div class="d-flex py-2">
                            <input type="text" v-model="searchQuerySupplier" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 10px"><input type="checkbox" v-model="selectAllSupplier" @change="handleSelectAllSupplier" /></th> -->
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody v-if="dataSuppliers.data.length > 0" class="tbody-supplier">
                                    <tr v-for="(data, index) in dataSuppliers.data" :key="index">
                                        <td><input type="checkbox" :checked="checkDataSupplier(data.id)" @change="handleTogleSupplier(data)" /></td>
                                        <td>{{ data.title }}</td>
                                        <td><img :src="data.image" :alt="data.title" class="img"></td>                                        
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="3" class="text-center">No results found...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <Pagination :data="dataSupplierLinkPagination" @getDatas="getDataSuppliers" />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex py-2">
                            <input type="text" v-model="searchQueryBenefit" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 10px"><input type="checkbox" v-model="selectAllBenefit" @change="handleSelectAllBenefit" /></th> -->
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody v-if="dataBenefits.data.length > 0">
                                    <tr v-for="(data, index) in dataBenefits.data" :key="index">                                    
                                        <td><input type="checkbox" :checked="checkDataBenefit(data.id)" @change="handleTogleBenefit(data)" /></td>
                                        <td>{{ data.title }}</td>
                                        <td>{{ data.description }}</td>
                                        <td><img :src="data.image" :alt="data.title" class="img"></td>                                        
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4" class="text-center">No results found...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <Pagination :data="dataBenefitLinkPagination" @getDatas="getDataBenefits" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
    import { watch, ref, onMounted } from "vue";
    import { useRouter, useRoute } from "vue-router";
    import { requestDelete, requestGet, requestPatch, requestPost } from "../../api/api";
    import { useToastr } from '../../toastr';
    import { debounce } from 'lodash';

    import * as yup from 'yup';
    import $ from 'jquery';
    import { Form, Field } from 'vee-validate';
    import Pagination from '../../components/Pagination.vue';

    const route  = useRoute();
    const router = useRouter();
    const toastr = useToastr();
    
    // DATA INDUSTRIE
    const dataIndustrie       = ref(null);
    const formIndustrie       = ref(null);
    const formValuesIndustrie = ref(null);
    const formIndustrieImage  = ref(null);
    const updateFormIndustrie = yup.object({
        title             : yup.string().required(),
        header_image      : null,
        header_slogan     : yup.string().required(),
        header_description: yup.string().required(),
        slogan            : yup.string().required(),
        description       : yup.string().required(),
        image             : null,
    });
    const initFormIndustrie = (data) => {
        formValuesIndustrie.value = {
            id                : data.id,
            title             : data.title,
            header_slogan     : data.header_slogan,
            header_description: data.header_description,
            slogan            : data.slogan,
            description       : data.description,
            image             : null,
            header_image      : null,
        }
        formIndustrieImage.value = {
            image       : data.image,
            header_image: data.header_image
        };
    }
    const getDataIndustrie = () => {
        requestGet(`admin/industries/${route.params.id}`, {})
        .then((RESPONSE) => {
            dataIndustrie.value    = RESPONSE.data;
            selectedSupplier.value = RESPONSE.data.supplies;
            selectedBenefit.value  = RESPONSE.data.benefits;
            initFormIndustrie(RESPONSE.data);
        })
        .then(() => {            
            getDataSuppliers();
        })
        .then(() => {
            getDataBenefits()
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const handleSubmitFormIndustrie = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                           
        
        requestPatch(`admin/industries/update/${formValuesIndustrie.value.id}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            dataIndustrie.value = RESPONSE.data;
            initFormIndustrie(RESPONSE.data);
            resetForm();
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    }

    // SUPPLIER
    const dataSuppliers              = ref({'data': []});
    const searchQuerySupplier        = ref(null);
    const dataSupplierLinkPagination = ref(null);
    
    const getDataSuppliers = (page = 1) => {
        const queryParam = {
            page: page,
            search: searchQuerySupplier.value
        };
        requestGet(`admin/supplies`, queryParam)
        .then((RESPONSE) => {
            dataSuppliers.value              = RESPONSE.data;
            dataSupplierLinkPagination.value = RESPONSE.data.meta.links;

            checkStatusSelectedAllSupplier();
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const selectedSupplier = ref([]);
    const handleTogleSupplier = (data) => {
        const index = selectedSupplier.value.findIndex(v => v.id === data.id);
        if (index === -1) {
            selectedSupplier.value.push(data);
        } else {
            selectedSupplier.value = selectedSupplier.value.filter(v => v.id !== data.id);
        }
        
        checkStatusSelectedAllSupplier();
        updateIndustrySupply();
    }
    const checkStatusSelectedAllSupplier = () => {
        if (selectedSupplier.value.length === dataSuppliers.value.data.length) {
            selectAllSupplier.value = true;
        } else {
            selectAllSupplier.value = false;
        }
    }
    const selectAllSupplier = ref(false);
    const handleSelectAllSupplier = () => {
        if (selectAllSupplier.value) {
            selectedSupplier.value = dataSuppliers.value.data.map(data => data);
        } else {
            selectedSupplier.value = [];
        }
        updateIndustrySupply();
    }
    const checkDataSupplier = (id) => {
        const a = selectedSupplier.value.filter(v => v.id === id);
        if (a.length > 0) {
            return true;
        } else {
            return false;
        }
    }
    const updateIndustrySupply = () => {
        const formData = new FormData();

        let dataFormSupplier = [];
        selectedSupplier.value.filter(v => dataFormSupplier.push(v.id));
        formData.append('supply_id', JSON.stringify(dataFormSupplier));

        requestPatch(`admin/industries/update-supply/${formValuesIndustrie.value.id}`, { _method: 'PATCH'}, formData)
        .then(() => {            
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            toastr.error('Data failed to update!');
        });
    }

    // DATA BENEFIT    
    const dataBenefits              = ref({'data': []});
    const searchQueryBenefit        = ref(null);
    const dataBenefitLinkPagination = ref(null);
    
    const getDataBenefits = (page = 1) => {
        const queryParam = {
            type: 'industry',
            page: page,
            search: searchQueryBenefit.value
        };
        requestGet(`admin/benefits`, queryParam)
        .then((RESPONSE) => {
            dataBenefits.value              = RESPONSE.data;
            dataBenefitLinkPagination.value = RESPONSE.data.meta.links;

            checkStatusSelectedAllBenefit();
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };

    const selectedBenefit = ref([]);
    const handleTogleBenefit = (data) => {
        const index = selectedBenefit.value.findIndex(v => v.id === data.id);
        if (index === -1) {
            selectedBenefit.value.push(data);
        } else {
            selectedBenefit.value = selectedBenefit.value.filter(v => v.id !== data.id);
        }
        
        checkStatusSelectedAllBenefit();
        updateIndustryBenefit();        
    }
    const checkStatusSelectedAllBenefit = () => {
        if (selectedBenefit.value.length === dataBenefits.value.data.length) {
            selectAllBenefit.value = true;
        } else {
            selectAllBenefit.value = false;
        }
    }
    const selectAllBenefit = ref(false);
    const handleSelectAllBenefit = () => {
        if (selectAllBenefit.value) {
            selectedBenefit.value = dataBenefits.value.data.map(data => data);
        } else {
            selectedBenefit.value = [];
        }

        updateIndustryBenefit();
    }
    const checkDataBenefit = (id) => {
        const a = selectedBenefit.value.filter(v => v.id === id);
        if (a.length > 0) {
            return true;
        } else {
            return false;
        }
    }
    const updateIndustryBenefit = () => {
        const formData = new FormData();

        let dataFormBenefit = [];
        selectedBenefit.value.filter(v => dataFormBenefit.push(v.id));
        formData.append('benefit_id', JSON.stringify(dataFormBenefit));

        requestPatch(`admin/industries/update-benefit/${formValuesIndustrie.value.id}`, { _method: 'PATCH'}, formData)
        .then(() => {            
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            toastr.error('Data failed to update!');
        });
    }

    const back = () => {
        router.go(-1);
    }

    // WATCH
    watch(searchQuerySupplier, debounce(() => {
        getDataSuppliers();
    }, 300));
    watch(searchQueryBenefit, debounce(() => {
        getDataBenefits();
    }, 300));    

    // MOUNTED
    onMounted(() => {
        getDataIndustrie();
    });
</script>

<style scoped>
    .tbody-supplier tr {
        cursor: pointer;
    }
    .tbody-supplier tr:hover {
        background-color: rgba(0,0,0,.075);
    }
    .tbody-supplier .active {
        background-color: rgba(0,0,0,.075);
    }
</style>