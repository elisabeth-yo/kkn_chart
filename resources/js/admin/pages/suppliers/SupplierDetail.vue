<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Suppliers Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Suppliers</li>
                        <li class="breadcrumb-item active">Suppliers Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Supplier</h3>
                </div>

                <Form ref="formSupplier" @submit="handleSubmitFormSupplier" :validation-schema="updateFormSupplier" v-slot="{ errors }" :initial-values="formValuesSupplier">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <Field name="title" type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" aria-describedby="titleHelp" placeholder="Enter title" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div v-if="formSupplierImage">
                                        <br>
                                        <img :src="formSupplierImage.image" class="img">
                                    </div>
                                    <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image" aria-describedby="imageHelp" accept="image/*" />
                                    <span class="invalid-feedback">{{ errors.image }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="header_image">Header Image</label>
                                    <div v-if="formSupplierImage">
                                        <br>
                                        <img :src="formSupplierImage.header_image" class="img">
                                    </div>
                                    <Field name="header_image" type="file" class="form-control" :class="{ 'is-invalid': errors.header_image }" id="header_image" accept="image/*" aria-describedby="header_imageHelp"/>
                                    <span class="invalid-feedback">{{ errors.header_image }}</span>
                                </div>
                            </div>
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
                
                <div class="col-md-12">
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

            <div class="row">

                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <button @click="addBrand" type="button" class="mb-2 btn btn-primary">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New Brand
                            </button>
                        </div>
                        <div>
                            <input type="text" v-model="searchQueryBrand" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive table-hover">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody v-if="dataBrands.data.length > 0" class="tbody-brand">
                                    <tr v-for="(data, index) in dataBrands.data" :key="index" :class="{ active: index === brandActive }" @click="getActiveBrand(data, index)">                                    
                                        <td v-if="pageNumberBrands > 1">{{ pageNumberBrands - 1 }}{{ index + 1 }}</td>
                                        <td v-else>{{ index + 1 }}</td>
                                        <td>{{ data.title }}</td>
                                        <td><img :src="data.image" :alt="data.title" class="img"></td>
                                        <td>
                                            <a href="#" @click.prevent="editBrand(data)"><i class="fa fa-edit"></i></a>
                                            <a href="#" @click.prevent="confirmDeletionBrand(data.id)"><i class="fa fa-trash text-danger ml-2"></i></a>
                                        </td>
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
                            <Pagination :data="dataBrandLinkPagination" @getDatas="getDataBrands" />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <button @click="addProduct" type="button" class="mb-2 btn btn-primary">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New Product
                            </button>
                        </div>
                        <div>
                            <input type="text" v-model="searchQueryProduct" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive table-hover">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody v-if="dataProducts.data.length > 0">
                                    <tr v-for="(data, index) in dataProducts.data" :key="index">                                    
                                        <td v-if="pageNumberProducts > 1">{{ pageNumberProducts - 1 }}{{ index + 1 }}</td>
                                        <td v-else>{{ index + 1 }}</td>
                                        <td>{{ data.title }}</td>
                                        <td>{{ data.description }}</td>
                                        <td><img :src="data.image" :alt="data.title" class="img"></td>
                                        <td>
                                            <a href="#" @click.prevent="editProduct(data)"><i class="fa fa-edit"></i></a>
                                            <a href="#" @click.prevent="confirmDeletionProduct(data.id)"><i class="fa fa-trash text-danger ml-2"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="5" class="text-center">No results found...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <Pagination :data="dataProductLinkPagination" @getDatas="getDataProducts" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Brand -->
    <div class="modal fade" id="modalFormBrand" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="statusEditingBrands">Edit Brands</span>
                        <span v-else>Add New Brands</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="formBrand" @submit="handleSubmitBrand" :validation-schema="statusEditingBrands ? editDataBrandSchema : createDataBrandSchema" v-slot="{ errors }" :initial-values="formValuesBrand">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <Field name="title" type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" aria-describedby="titleHelp" placeholder="Enter title" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div v-if="statusEditingBrands">
                                <br>
                                <img :src="formBrandImage.image" class="img">
                            </div>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image_brand" aria-describedby="imageHelp" accept="image/*" />
                            <span class="invalid-feedback">{{ errors.image }}</span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDeleteFormBrand" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span>Delete Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this data ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button @click.prevent="deleteDataBrand" type="button" class="btn btn-primary">Delete Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Brand -->
    <div class="modal fade" id="modalFormProduct" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="statusEditingProducts">Edit Products</span>
                        <span v-else>Add New Products</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="formProduct" @submit="handleSubmitProduct" :validation-schema="statusEditingProducts ? editDataProductSchema : createDataProductSchema" v-slot="{ errors }" :initial-values="formValuesProduct">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <Field name="title" type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" aria-describedby="titleHelp" placeholder="Enter title" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <Field name="description" as="textarea" class="form-control" :class="{ 'is-invalid': errors.description }" id="description" aria-describedby="descriptionHelp" placeholder="Enter description" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div v-if="statusEditingProducts">
                                <br>
                                <img :src="formProductImage.image" class="img">
                            </div>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image_product" aria-describedby="imageHelp" accept="image/*" />
                            <span class="invalid-feedback">{{ errors.image }}</span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDeleteFormProduct" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span>Delete Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this data ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button @click.prevent="deleteDataProduct" type="button" class="btn btn-primary">Delete Data</button>
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
    const router  = useRouter();
    const toastr = useToastr();
    
    // DATA SUPPLIER
    const dataSupplier       = ref(null);
    const formSupplier       = ref(null);
    const formValuesSupplier = ref(null);
    const formSupplierImage  = ref(null);    

    const updateFormSupplier = yup.object({
        title       : yup.string().required(),
        image       : null,
        header_image: null
    });
    const initFormSupplier = (data) => {
        formValuesSupplier.value = {
            id          : data.id,
            title       : data.title,
            image       : null,
            header_image: null
        }
        formSupplierImage.value = {
            image       : data.image,
            header_image: data.header_image
        };
    }
    const getDataSupplier = () => {        
        requestGet(`admin/supplies/${route.params.id}`, {})
        .then((RESPONSE) => {
            dataSupplier.value    = RESPONSE.data;
            selectedBenefit.value = RESPONSE.data.benefits;
            initFormSupplier(RESPONSE.data);
        })
        .then(() => {
            getDataBenefits();
        })
        .then(() => {            
            getDataBrands();
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const handleSubmitFormSupplier = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/supplies/update/${formValuesSupplier.value.id}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            dataSupplier.value = RESPONSE.data;
            initFormSupplier(RESPONSE.data);
            resetForm();
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    }

    // BRANDS
    const dataBrands              = ref({'data': []});
    const searchQueryBrand        = ref(null);
    const dataBrandLinkPagination = ref(null);
    const statusEditingBrands     = ref(false);
    const formBrand               = ref(null);
    const formValuesBrand         = ref(null);
    const formBrandImage          = ref(null);
    const dataIdBrandBeingDeleted = ref(null);
    const dataBrandSelected       = ref(null);
    const brandActive             = ref(0);
    const pageNumberBrands = ref(0);

    const resetValueImageBrand = () => {
        $("#image_brand").val(null);     
    };
    const createDataBrandSchema = yup.object({
        title       : yup.string().required(),
        image       : yup.string().required(),
    });
    const editDataBrandSchema = yup.object({
        title       : yup.string().required(),
        image       : null,
    });
    const initFormBrand = (data = null) => {
        if (data) {
            formValuesBrand.value = {
                id          : data.id,
                title       : data.title,
                image       : null,
            };
            formBrandImage.value = { image : data.image };            
        } else {
            formValuesBrand.value = {
                id          : null,
                title       : null,
                image       : null,
            };
        }
    };
    const getDataBrands = (page = 1) => {
        pageNumberBrands.value = page;

        const queryParam = {
            page: page,
            search: searchQueryBrand.value
        };
        requestGet(`admin/brands/all/${dataSupplier.value.id}`, queryParam)
        .then((RESPONSE) => {
            dataBrands.value              = RESPONSE.data;
            dataBrandLinkPagination.value = RESPONSE.data.meta.links;
            dataBrandSelected.value       = RESPONSE.data.data[0]
            getActiveBrand(dataBrandSelected.value, 0);
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const handleSubmitBrand = (values, actions) => {
        if (statusEditingBrands.value) {
            updateDataBrand(values, actions);
        } else {
            createDataBrand(values, actions);
        }
    };
    const addBrand = () => {
        statusEditingBrands.value = false;
        $('#modalFormBrand').modal('show');
        initFormBrand();
        resetValueImageBrand();
    };
    const createDataBrand = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (key !== 'id') {
                formData.append(key, values[key]);
            }
        });
        formData.append('supply_id', dataSupplier.value.id); 

        requestPost('admin/brands/store', formData)
        .then((RESPONSE) => {
            dataBrands.value.data.push(RESPONSE.data);
            $('#modalFormBrand').modal('hide');
            resetForm();
            toastr.success('Data created successfully!');
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
    };
    const editBrand = (data) => {
        statusEditingBrands.value = true;
        formBrand.value.resetForm();
        $('#modalFormBrand').modal('show');
        initFormBrand(data);
        resetValueImageBrand();
    };
    const updateDataBrand = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/brands/update/${formValuesBrand.value.id}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = dataBrands.value.data.findIndex(data => data.id === RESPONSE.data.id);
            dataBrands.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalFormBrand').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletionBrand = (id) => {
        dataIdBrandBeingDeleted.value = id;
        $('#modalDeleteFormBrand').modal('show');
    };
    const deleteDataBrand = () => {
        requestDelete(`admin/brands/destroy/${dataIdBrandBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteFormBrand').modal('hide');
            toastr.success('Data deleted successfully!');
            dataBrands.value.data = dataBrands.value.data.filter(data => data.id !== dataIdBrandBeingDeleted.value);
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const getActiveBrand = (data, index) => {
        brandActive.value       = index;
        dataBrandSelected.value = data;

        getDataProducts();
    }

    // DATA PRODUCT    
    const dataProducts              = ref({'data': []});
    const searchQueryProduct        = ref(null);
    const dataProductLinkPagination = ref(null);
    const statusEditingProducts     = ref(false);
    const formProduct               = ref(null);
    const formValuesProduct         = ref(null);
    const formProductImage          = ref(null);
    const dataIdProductBeingDeleted = ref(null);
    const pageNumberProducts        = ref(0);

    const resetValueImageProduct = () => {
        $("#image_product").val(null);     
    };
    const createDataProductSchema = yup.object({
        title       : yup.string().required(),
        image       : yup.string().required(),
    });
    const editDataProductSchema = yup.object({
        title       : yup.string().required(),
        image       : null,
    });
    const initFormProduct = (data = null) => {
        if (data) {
            formValuesProduct.value = {
                id         : data.id,
                title      : data.title,
                description: data.description,
                image      : null,
            };
            formProductImage.value = { image : data.image };            
        } else {
            formValuesProduct.value = {
                id         : null,
                title      : null,
                description: null,
                image      : null,
            };
        }
    };
    const getDataProducts = (page = 1) => {
        pageNumberProducts.value = page;
        
        const queryParam = {
            page: page,
            search: searchQueryProduct.value
        };
        requestGet(`admin/products/all/${dataBrandSelected.value.id}`, queryParam)
        .then((RESPONSE) => {
            dataProducts.value              = RESPONSE.data;
            dataProductLinkPagination.value = RESPONSE.data.meta.links;
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const handleSubmitProduct = (values, actions) => {
        if (statusEditingProducts.value) {
            updateDataProduct(values, actions);
        } else {
            createDataProduct(values, actions);
        }
    };
    const addProduct = () => {
        statusEditingProducts.value = false;
        $('#modalFormProduct').modal('show');
        initFormProduct();
        resetValueImageProduct();
    };
    const createDataProduct = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (key !== 'id') {
                formData.append(key, values[key]);
            }
        });
        formData.append('brand_id', dataBrandSelected.value.id); 

        requestPost('admin/products/store', formData)
        .then((RESPONSE) => {
            dataProducts.value.data.push(RESPONSE.data);
            $('#modalFormProduct').modal('hide');
            resetForm();
            toastr.success('Data created successfully!');
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
    };
    const editProduct = (data) => {
        statusEditingProducts.value = true;
        formProduct.value.resetForm();
        $('#modalFormProduct').modal('show');
        initFormProduct(data);
        resetValueImageProduct();
    };
    const updateDataProduct = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/products/update/${formValuesProduct.value.id}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = dataProducts.value.data.findIndex(data => data.id === RESPONSE.data.id);
            dataProducts.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalFormProduct').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletionProduct = (id) => {
        dataIdProductBeingDeleted.value = id;
        $('#modalDeleteFormProduct').modal('show');
    };
    const deleteDataProduct = () => {
        requestDelete(`admin/products/destroy/${dataIdProductBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteFormProduct').modal('hide');
            toastr.success('Data deleted successfully!');
            dataProducts.value.data = dataProducts.value.data.filter(data => data.id !== dataIdProductBeingDeleted.value);
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };

    // DATA BENEFIT    
    const dataBenefits              = ref({'data': []});
    const searchQueryBenefit        = ref(null);
    const dataBenefitLinkPagination = ref(null);
    const getDataBenefits = (page = 1) => {
        const queryParam = {
            type: 'supply',
            page: page,
            search: searchQueryBenefit.value,
            per_page: 2
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
        updateSuppyBenefit();
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

        updateSuppyBenefit();
    }
    const checkDataBenefit = (id) => {
        const a = selectedBenefit.value.filter(v => v.id === id);
        if (a.length > 0) {
            return true;
        } else {
            return false;
        }
    }
    const updateSuppyBenefit = () => {
        const formData = new FormData();

        let dataFormBenefit = [];
        selectedBenefit.value.filter(v => dataFormBenefit.push(v.id));
        formData.append('benefit_id', JSON.stringify(dataFormBenefit));

        requestPatch(`admin/supplies/update-benefit/${formValuesSupplier.value.id}`, { _method: 'PATCH'}, formData)
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
    // watch(() => route.params.id);
    watch(searchQueryBrand, debounce(() => {
        getDataBrands();
    }, 300));
    watch(searchQueryProduct, debounce(() => {
        getDataProducts();
    }, 300));    

    // MOUNTED
    onMounted(() => {
        getDataSupplier();
    });
</script>

<style scoped>
    .tbody-brand tr {
        cursor: pointer;
    }
    .tbody-brand tr:hover {
        background-color: rgba(0,0,0,.075);
    }
    .tbody-brand .active {
        background-color: rgba(0,0,0,.075);
    }
</style>