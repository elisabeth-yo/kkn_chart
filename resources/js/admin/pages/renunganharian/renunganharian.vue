<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Renungan Harian</h1>
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
                        Tambah Renungan Harian
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
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Gambar Bahan Bacaan</th>
                                <th>Sumber Referensi</th>
                                <th>Tanggal Dibuat</th>
                               
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.judul}}</td>
                                <td>{{ data.deskripsi}}</td>
                                <td><img :src="data.gambar_bahan_bacaan" :alt="data.judul" class="img"></td>
                                <td>{{ data.sumber_referensi}}</td>
                                <td>{{ data.tanggal_dibuat}}</td>
                               
                                
                                <td>

                                    <a href="#" @click.prevent="edit(data)"><i class="fa fa-edit"></i></a>
                                    <a href="#" @click.prevent="confirmDeletion(data.id_renungan)"><i class="fa fa-trash text-danger ml-2"></i></a>
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
                        <span v-if="statusEditing">Edit Renungan Harian</span>
                        <span v-else>Tambah Renungan Harian</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="statusEditing ? editDataSchema : createDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <Field name="judul" type="text" class="form-control" :class="{ 'is-invalid': errors.judul }" id="judul"/>
                            <span class="invalid-feedback">{{ errors.judul }}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <Field name="deskripsi" as="textarea" class="form-control" :class="{ 'is-invalid': errors.deskripsi }" id="deskripsi" cols="30" rows="10"/>
                            <span class="invalid-feedback">{{ errors.deskripsi }}</span>
                        </div>

                        <div class="form-group">
                            <label for="gambar_bahan_bacaan">Gambar Bahan Bacaan</label>
                            <div v-if="statusEditing">
                                <br>
                                <img :src="formImageGambarBahanBacaan.gambar_bahan_bacaan" class="img">
                            </div>
                            <Field name="gambar_bahan_bacaan" type="file" class="form-control" :class="{ 'is-invalid': errors.gambar_bahan_bacaan }" id="gambar_bahan_bacaan" aria-describedby="gambar_bahan_bacaanHelp" accept="gambar_bahan_bacaan/*" />
                            <span class="invalid-feedback">{{ errors.gambar_bahan_bacaan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="sumber_referensi">Sumber Referensi</label>
                            <Field name="sumber_referensi" as="textarea" class="form-control" :class="{ 'is-invalid': errors.sumber_referensi }" id="sumber_referensi" cols="30" rows="10"/>
                            <span class="invalid-feedback">{{ errors.sumber_referensi }}</span>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_dibuat">Tanggal di Buat</label>
                            <Field name="tanggal_dibuat" type="date" class="form-control" :class="{ 'is-invalid': errors.tanggal_dibuat }" id="tanggal_dibuat"/>
                            <span class="invalid-feedback">{{ errors.tanggal_dibuat }}</span>
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
    console.log(datas)
    const searchQuery        = ref(null);
    const dataLinkPagination = ref(null);
    const statusEditing      = ref(false);
    const form               = ref(null);
    const formValues         = ref(null);
    const formImageGambarBahanBacaan          = ref(null);
    const dataIdBeingDeleted = ref(null);
    const pageNumber         = ref(0);
    const resetValueImage    = () => {
        $ ("#gambar_bahan_bacaan").val(null);
    };
    

    const createDataSchema = yup.object({
        judul                      : yup.string().required(),
        deskripsi                  : yup.string().required(),
        gambar_bahan_bacaan        : yup.string().required(),
        sumber_referensi           : yup.string().required(),
        tanggal_dibuat             : yup.string().required(),

    });
    const editDataSchema = yup.object({ 
        judul                      : yup.string().required(),
        deskripsi                  : yup.string().required(),
        gambar_bahan_bacaan        : null,
        sumber_referensi           : yup.string().required(),
        tanggal_dibuat             : yup.string().required(),
    });
    const initForm = (data = null) => {
        if (data) {
            formValues.value = {
                id_renungan         : data.id_renungan,
                judul               : data.judul,
                deskripsi           : data.deskripsi,
                gambar_bahan_bacaan : null,
                sumber_referensi    : data.sumber_referensi,
                tanggal_dibuat      : data.tanggal_dibuat,
                
            };
            formImageGambarBahanBacaan.value = { gambar_bahan_bacaan : data.gambar_bahan_bacaan };    
        } else {
            formValues.value = {
                id_renungan            : null,
                judul               : null,
                deskripsi           : null,
                gambar_bahan_bacaan : null,
                sumber_referensi    : null,
                tanggal_dibuat      : null,
            };
        }
    };
    const getDatas = (page = 1) => {
        pageNumber.value = page;
        
        const queryParam = {
            page: page,
            search: searchQuery.value
        };
        requestGet(`admin/renunganharian`, queryParam)
        .then((RESPONSE) => {
            datas.value              = RESPONSE.data;
            console.log(RESPONSE);
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
            if (key !== 'id_renungan') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/renunganharian/store', formData)
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
            if (values[key] && key !== 'id_renungan') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/renunganharian/update/${formValues.value.id_renungan}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = datas.value.data.findIndex(data => data.id_renungan === RESPONSE.data.id_renungan);
            datas.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalForm').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletion = (id_berita) => {
        dataIdBeingDeleted.value = id_berita;
        $('#modalDeleteForm').modal('show');
    };
    const deleteData = () => {
        requestDelete(`admin/renunganharian/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id_renungan !== dataIdBeingDeleted.value);
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