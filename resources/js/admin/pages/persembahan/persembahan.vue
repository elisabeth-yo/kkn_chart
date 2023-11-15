<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Persembahan</h1>
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
                        Tambah Persembahan
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
                                <th>Id Persembahan</th>
                                <th>Perolehan Persembahan</th>
                                <th>Keterangan</th>
                                <th>Id Jadwal Ibadah</th>
                                <th>Id Pengguna</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.id_persembahan }}</td>
                                <td>Rp {{ data.perolehan_persembahan }}</td>
                                <td>{{ data.keterangan }}</td>
                                <td>{{ data.id_jadwal_ibadah }}</td>
                                <td>{{ data.id_pengguna }}</td>
                                
                               
                                <td>
                                    <a href="#" @click.prevent="edit(data)"><i class="fa fa-edit"></i></a>
                                    <a href="#" @click.prevent="confirmDeletion(data.id_persembahan)"><i class="fa fa-trash text-danger ml-2"></i></a>
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
                        <span v-if="statusEditing">Edit Persembahan</span>
                        <span v-else>Tambah Persembahan</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="statusEditing ? editDataSchema : createDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="modal-body">
                        
                        

                        <div class="form-group">
                            <label for="perolehan_persembahan">Perolehan Persembahan</label>
                            <Field name="perolehan_persembahan" type="text" class="form-control" :class="{ 'is-invalid': errors.perolehan_persembahan }" id="perolehan_persembahan"/>
                            <span class="invalid-feedback">{{ errors.perolehan_persembahan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <Field name="keterangan" as="textarea" class="form-control" :class="{ 'is-invalid': errors.keterangan }" id="keterangan" cols="30" rows="10"/>
                            <span class="invalid-feedback">{{ errors.keterangan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="id_jadwal_ibadah">Id Jadwal Ibadah</label>
                            <Field name="id_jadwal_ibadah" type="text" class="form-control" :class="{ 'is-invalid': errors.id_jadwal_ibadah }" id="id_jadwal_ibadah" />
                            <span class="invalid-feedback">{{ errors.id_jadwal_ibadah }}</span>
                        </div>
                        

                        <div class="form-group">
                            <label for="id_pengguna">Id Pengguna</label>
                            <Field name="id_pengguna" type="text" class="form-control" :class="{ 'is-invalid': errors.id_pengguna }" id="id_pengguna" />
                            <span class="invalid-feedback">{{ errors.id_pengguna }}</span>
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

    import * as yup from 'yup';
    import $ from 'jquery';
    import { Form, Field } from 'vee-validate';
    import Pagination from '../../components/Pagination.vue';
    
    const toastr             = useToastr();

    // CONST
    const datas              = ref({'data': []});
    const searchQuery        = ref(null);
    const dataLinkPagination = ref(null);
    const statusEditing      = ref(false);
    const form               = ref(null);
    const formValues         = ref(null);
    const formFile          = ref(null);
    
    const dataIdBeingDeleted = ref(null);
    const pageNumber         = ref(0);
    const resetValueImage    = () => {
        $ ("#file_warta").val(null);
       

    };
    

    const createDataSchema = yup.object({
        perolehan_persembahan       : yup.string().required(),
        keterangan                  : yup.string().required(),
        id_jadwal_ibadah            : yup.string().required(),
        id_pengguna                 : yup.string().required(),
       
    });
    const editDataSchema = yup.object({ 
        perolehan_persembahan       : yup.string().required(),
        keterangan                  : yup.string().required(),
        id_jadwal_ibadah            : yup.string().required(),
        id_pengguna                 : yup.string().required(),
    });
    const initForm = (data = null) => {
        if (data) {
            formValues.value = {
                id_persembahan          : data.id_persembahan,
                perolehan_persembahan   : data.perolehan_persembahan,
                keterangan              : data.keterangan,
                id_jadwal_ibadah        : data.id_jadwal_ibadah,
                id_pengguna             : data.id_pengguna,
               
            };
            
                        
        } else {
            formValues.value = {
                id_persembahan          : null,
                perolehan_persembahan   : null,
                keterangan              : null,
                id_jadwal_ibadah        : null,
                id_pengguna             : null,
                
            };
        }
    };
    const getDatas = (page = 1) => {
        pageNumber.value = page;
        
        const queryParam = {
            page: page,
            search: searchQuery.value
        };
        requestGet(`admin/persembahan`, queryParam)
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
            if (key !== 'id_persembahan') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/persembahan/store', formData)
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
            if (values[key] && key !== 'id_persembahan') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/persembahan/update/${formValues.value.id_persembahan}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = datas.value.data.findIndex(data => data.id_persembahan === RESPONSE.data.id_persembahan);
            datas.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalForm').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletion = (id_persembahan) => {
        dataIdBeingDeleted.value = id_persembahan;
        $('#modalDeleteForm').modal('show');
    };
    const deleteData = () => {
        requestDelete(`admin/persembahan/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id_persembahan !== dataIdBeingDeleted.value);
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