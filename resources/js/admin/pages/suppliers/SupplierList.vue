<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Suppliers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
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
                        Add New Supplier
                    </button>
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
                                <th>Image</th>
                                <th>Header Image</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.title }}</td>
                                <td><img :src="data.image" :alt="data.title" class="img"></td>
                                <td><img :src="data.header_image" :alt="data.title" class="img"></td>
                                <td>
                                    <router-link :to="{ name: 'admin.suppliers.detail', params: { id: data.id }}"><i class="fa fa-eye"></i></router-link>
                                    <!-- <a href="#" @click.prevent="edit(data)"><i class="fa fa-eye"></i></a> -->
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
    import { ref, onMounted, watch } from 'vue';
    import * as yup from 'yup';
    import $ from 'jquery'
    import { Form, Field } from 'vee-validate';
    import { useToastr } from '../../toastr';
    import { debounce } from 'lodash';
    
    import Pagination from '../../components/Pagination.vue';
    
    const toastr             = useToastr();
    const datas              = ref({'data': []});
    const dataLinkPagination = ref([]);
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
        requestGet(`admin/supplies`, queryParam)
        .then((RESPONSE) => {
            datas.value              = RESPONSE.data;
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
            id          : null,
            title       : null,
            image       : null,
            header_image: null
        };
        resetValueImage();
    };
    const createDataSchema = yup.object({
        title       : yup.string().required(),
        image       : yup.string().required(),
        header_image: yup.string().required()
    });
    const createData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (key !== 'id') {
                formData.append(key, values[key])                
            }
        });

        requestPost('admin/supplies/store', formData)
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
            id: v.id,
            title: v.title,
            image: null,
            header_image: null
        };
        formImage.value = {
            image: v.image,
            header_image: v.header_image
        };
        resetValueImage();
    };
    const editDataSchema = yup.object({
        title: yup.string().required()
    });
    const updateData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();
        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/supplies/update/${formValues.value.id}`, { _method: 'PATCH'}, formData)
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
        requestDelete(`admin/supplies/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#deleteDataModal').modal('hide');
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

    // MOUNTED
    onMounted(() => {
        getDatas();
    });
</script>

<style>

</style>