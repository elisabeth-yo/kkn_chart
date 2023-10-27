<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Benefits</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Benefits</li>
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
                        Add New Benefits
                    </button>
                </div>
                    <div class="d-flex">
                        <div class="pr-1">
                            <select v-model="searchQueryType" class="form-control" placeholder="Choose by type">
                                <option value="" selected>All Type</option>
                                <template v-for="(v) in benefitType" :key="v">
                                    <option :value="v">{{ v.toUpperCase() }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="pl-1">
                            <input type="text" v-model="searchQuery" class="form-control" placeholder="Search..." />
                        </div>
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
                                <th>Type</th>
                                <th>Image</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.title }}</td>
                                <td>{{ data.description }}</td>
                                <td>{{ data.type.toUpperCase() }}</td>
                                <td><img :src="data.image" :alt="data.title" class="img"></td>
                                <td>
                                    <a href="#" @click.prevent="edit(data)"><i class="fa fa-edit"></i></a>
                                    <a href="#" @click.prevent="confirmDeletion(data.id)"><i class="fa fa-trash text-danger ml-2"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="6" class="text-center">No results found...</td>
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

    <!-- Modal  -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="statusEditing">Edit Benefits</span>
                        <span v-else>Add New Benefits</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="statusEditing ? editDataSchema : createDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="title">Title</label>
                            <Field name="title" type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" aria-describedby="titleHelp" placeholder="Enter title" />
                            <span class="invalid-feedback">{{ errors.title }}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <Field name="description" as="textarea" class="form-control" :class="{ 'is-invalid': errors.description }" id="description" aria-describedby="descriptionHelp" />
                            <span class="invalid-feedback">{{ errors.description }}</span>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <Field name="type" as="select" class="form-control" :class="{ 'is-invalid': errors.type }" id="type">
                                <option value="">Enter type</option>
                                <template v-for="(v) in benefitType" :key="v">
                                    <option :value="v">{{ v.toUpperCase() }}</option>
                                </template>
                            </Field>
                            <span class="invalid-feedback">{{ errors.type }}</span>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div v-if="statusEditing">
                                <br>
                                <img :src="formImage.image" class="img">
                            </div>
                            <Field name="image" type="file" class="form-control" :class="{ 'is-invalid': errors.image }" id="image" aria-describedby="imageHelp" accept="image/*" />
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
    <div class="modal fade" id="modalDeleteForm" data-backdrop="static" tabindex="-1" role="dialog"
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
    import { watch, ref, onMounted } from "vue";
    import { requestDelete, requestGet, requestPatch, requestPost } from "../../api/api";
    import { useToastr } from '../../toastr';
    import { debounce } from 'lodash';
    import { benefitType } from "../../utils/constants";

    import * as yup from 'yup';
    import $ from 'jquery';
    import { Form, Field } from 'vee-validate';
    import Pagination from '../../components/Pagination.vue';
    
    const toastr             = useToastr();

    // CONST
    const datas              = ref({'data': []});
    const searchQuery        = ref(null);
    const searchQueryType    = ref('');
    const dataLinkPagination = ref(null);
    const statusEditing      = ref(false);
    const form               = ref(null);
    const formValues         = ref(null);
    const formImage          = ref(null);
    const dataIdBeingDeleted = ref(null);
    const pageNumber         = ref(0);

    const resetValueImage = () => {
        $("#image").val(null);     
    };
    const createDataSchema = yup.object({
        title      : yup.string().required(),
        description: yup.string().required(),
        type       : yup.string().required(),
        image      : yup.string().required(),
    });
    const editDataSchema = yup.object({
        title      : yup.string().required(),
        description: yup.string().required(),
        type       : yup.string().required(),
        image      : null,
    });
    const initForm = (data = null) => {
        if (data) {
            formValues.value = {
                id         : data.id,
                title      : data.title,
                description: data.description,
                type       : data.type,
                image      : null,
            };
            formImage.value = { image : data.image };            
        } else {
            formValues.value = {
                id         : null,
                title      : null,
                description: null,
                type       : '',
                image      : null,
            };
        }
    };
    const getDatas = (page = 1) => {
        pageNumber.value = page;

        let queryParam;
        if (searchQueryType.value !== '') {
            queryParam = {
                page: page,
                search: searchQuery.value,
                type: searchQueryType.value
            };            
        } else {
            queryParam = {
                page: page,
                search: searchQuery.value,
            };  
        }
        requestGet(`admin/benefits`, queryParam)
        .then((RESPONSE) => {
            datas.value              = RESPONSE.data;
            dataLinkPagination.value = RESPONSE.data.meta.links;
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };
    const handleSubmit = (values, actions) => {
        if (statusEditing.value) {
            updateData(values, actions);
        } else {
            createData(values, actions);
        }
    };
    const add = () => {
        statusEditing.value = false;
        $('#modalForm').modal('show');
        initForm();
        resetValueImage();
    };
    const createData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (key !== 'id') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/benefits/store', formData)
        .then((RESPONSE) => {
            datas.value.data.push(RESPONSE.data);
            $('#modalForm').modal('hide');
            resetForm();
            toastr.success('Data created successfully!');
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
    };
    const edit = (data) => {
        statusEditing.value = true;
        form.value.resetForm();
        $('#modalForm').modal('show');
        initForm(data);
        resetValueImage();
    };
    const updateData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/benefits/update/${formValues.value.id}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = datas.value.data.findIndex(data => data.id === RESPONSE.data.id);
            datas.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalForm').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletion = (id) => {
        dataIdBeingDeleted.value = id;
        $('#modalDeleteForm').modal('show');
    };
    const deleteData = () => {
        requestDelete(`admin/benefits/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id !== dataIdBeingDeleted.value);
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };

    // WATCH
    watch(searchQuery, debounce(() => {
        getDatas();
    }, 300));
    watch(searchQueryType, debounce(() => {
        getDatas();
    }, 300));

    // MOUNTED
    onMounted(() => {
        getDatas();
    });
</script>

<style>
    
</style>