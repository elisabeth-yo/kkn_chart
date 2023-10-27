<template>
  <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Industries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Industries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <button @click="add" type="button" class="mb-2 btn btn-primary">
                        <i class="fa fa-plus-circle mr-1"></i>
                        Add New Industry
                    </button>
                    <div v-if="selectedData.length > 0">
                        <button @click="bulkDelete" type="button" class="ml-2 mb-2 btn btn-danger">
                            <i class="fa fa-trash mr-1"></i>
                            Delete Selected
                        </button>
                        <span class="ml-2">Selected {{ selectedData.length }} users</span>
                    </div>
                </div>
                <div>
                    <input type="text" v-model="searchQuery" class="form-control" placeholder="Search..." />
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
                                <th>Slogan</th>
                                <th>Image</th>
                                <th>Header Image</th>
                                <th>Header Slogan</th>
                                <th>Header Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.title }}</td>
                                <td>{{ data.description }}</td>
                                <td>{{ data.slogan }}</td>
                                <td><img :src="data.image" :alt="data.title" class="img"></td>
                                <td><img :src="data.header_image" :alt="data.title" class="img"></td>
                                <td>{{ data.header_slogan }}</td>
                                <td>{{ data.header_description }}</td>
                                <td>
                                    <router-link :to="{ name: 'admin.industries.detail', params: { id: data.id }}"><i class="fa fa-eye"></i></router-link>
                                    <a href="#" @click.prevent="confirmDeletion(data.id)"><i class="fa fa-trash text-danger ml-2"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="10" class="text-center">No results found...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <Pagination :data="dataLinkPagination" @getDatas="getDatas" />
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="editing">Edit Industry</span>
                        <span v-else>Add New Industry</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="editing ? editDataSchema : createDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="modal-body">
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
                            <label for="supply_id">Supplier</label>
                            <Field name="supply_id" as="select" multiple class="form-control" :class="{ 'is-invalid': errors.supply_id }" id="supply_id">
                                <!-- <template v-for="(v, i) in dataSuppliers" :key="i"> -->
                                    <option value="" disabled>Select a supplier</option>
                                    <!-- <option :value="v.id">{{ v.title }}</option> -->
                                    <option v-for="(v, i) in dataSuppliers" :key="i" :value="v.id" :selected="value && value.includes(v.id)">{{ v.title }}</option>
                                <!-- </template> -->
                            </Field>
                            <span class="invalid-feedback">{{ errors.supply_id }}</span>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div v-if="editing">
                                <br>
                                <img :src="formImage.image" class="img">
                            </div>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image" aria-describedby="imageHelp" accept="image/*" />
                            <span class="invalid-feedback">{{ errors.image }}</span>
                        </div>

                        <div class="form-group">
                            <label for="header_image">Header Image</label>
                            <div v-if="editing">
                                <br>
                                <img :src="formImage.header_image" class="img">
                            </div>
                            <Field name="header_image" type="file" class="form-control" :class="{ 'is-invalid': errors.header_image }" id="header_image" accept="image/*" aria-describedby="header_imageHelp"/>
                            <span class="invalid-feedback">{{ errors.header_image }}</span>
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

    <div class="modal fade" id="deleteDataModal" data-backdrop="static" tabindex="-1" role="dialog"
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
                    <button @click.prevent="deleteData" type="button" class="btn btn-primary">Delete Data</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
    import { requestDelete, requestGet, requestPatch, requestPost } from '../../api/api';
    import { ref, onMounted, watch, reactive } from 'vue';
    import Pagination from '../../components/Pagination.vue';
    import * as yup from 'yup';
    import $ from 'jquery'
    import { Form, Field } from 'vee-validate';
    import { useToastr } from '../../toastr';
    import { debounce } from 'lodash';
    
    const toastr             = useToastr();
    const datas              = ref({'data': []});
    const dataLinkPagination = ref([]);
    const selectedData       = ref([]);
    const selectAll          = ref(false);
    const searchQuery        = ref(null);
    const editing            = ref(false);
    const formValues         = ref(null);
    const form               = ref(null);
    const formImage          = ref(null);
    const pageNumber         = ref(0);

    const resetValueImage = () => {
        $("#image").val(null);       
        $("#header_image").val(null);       
    };

    // GET DATAS
    const getDatas = (page = 1) => {
        pageNumber.value = page;

        const queryParam = {
            page: page,
            search: searchQuery.value
        };
        requestGet(`admin/industries`, queryParam, true)
        .then((RESPONSE) => {
            datas.value = RESPONSE.data;
            selectAll.value = false;
            selectedData.value = [];

            dataLinkPagination.value = RESPONSE.data.meta.links;
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };

    // SUBMITTED
    const handleSubmit = (values, actions) => {
        if (editing.value) {
            updateData(values, actions);
        } else {
            createData(values, actions);
        }
    };

    // CREATE
    const add = () => {
        editing.value = false;
        $('#formModal').modal('show');
        formValues.value = {
            id                : null,
            title             : null,
            header_image      : null,
            header_slogan     : null,
            header_description: null,
            slogan            : null,
            description       : null,
            image             : null,
        };
        resetValueImage();
        getDataSupplier();
    };
    const createDataSchema = yup.object({
        title             : yup.string().required(),
        header_image      : yup.string().required(),
        header_slogan     : yup.string().required(),
        header_description: yup.string().required(),
        slogan            : yup.string().required(),
        description       : yup.string().required(),
        image             : yup.string().required(),
    });
    const createData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (key !== 'id') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/industries/store', formData)
        .then((RESPONSE) => {
            datas.value.data.push(RESPONSE.data);
            $('#formModal').modal('hide');
            resetForm();
            toastr.success('Data created successfully!');
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
    }

    // EDIT
    const edit = (v) => {
        editing.value = true;
        form.value.resetForm();
        $('#formModal').modal('show');
        formValues.value = {
            id                : v.id,
            title             : v.title,
            header_image      : null,
            header_slogan     : v.header_slogan,
            header_description: v.header_description,
            slogan            : v.slogan,
            description       : v.description,
            image             : null,
        };
        formImage.value = {
            image       : v.image,
            header_image: v.header_image
        };
        resetValueImage();
    };
    const editDataSchema = yup.object({
        title             : yup.string().required(),
        header_image      : null,
        header_slogan     : yup.string().required(),
        header_description: yup.string().required(),
        slogan            : yup.string().required(),
        description       : yup.string().required(),
        image             : null,
    });
    const updateData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/industries/update/${formValues.value.id}`, { _method: 'PATCH'}, formData)
        .then((response) => {
            const index = datas.value.data.findIndex(data => data.id === response.data.id);
            datas.value.data[index] = response.data;
            resetForm();
            $('#formModal').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    }

    // DELETE
    const dataIdBeingDeleted = ref(null);
    const confirmDeletion = (id) => {
        dataIdBeingDeleted.value = id;
        $('#deleteDataModal').modal('show');
    };

    const deleteData = () => {
        requestDelete(`admin/industries/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#deleteDataModal').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id !== dataIdBeingDeleted.value);
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };

    const dataSuppliers = ref([]);
    const getDataSupplier = () => {
        requestGet(`admin/supplies`, {})
        .then((RESPONSE) => {
            dataSuppliers.value = RESPONSE.data.data;
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    }

    // WATCH
    watch(searchQuery, debounce(() => {
        getDatas();
    }, 300));

    // MOUNTED
    onMounted(() => {
        getDatas();
    });
</script>

<style>
    .img {
        height: 100px;
        width: auto;
        max-width: 100%;
    }
    input[type="file"] {
        border: none;
        padding: 0;
    }
</style>