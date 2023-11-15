<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Berita Kegiatan</h1>
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
                        Tambah Berita Kegiatan
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
                                <th>Id Berita</th>
                                <th>Nama Kegiatan</th>
                                <th>Deskripsi Kegiatan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Poster Kegiatan</th>
                                <th>Foto Kegiatan</th>
                                <th>Id Pengguna</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.id_berita }}</td>
                                <td>{{ data.nama_kegiatan }}</td>
                                <td>{{ data.deskripsi_kegiatan }}</td>
                                <td>{{ data.tanggal_pelaksanaan }}</td>
                                <td><a :href="data.poster_kegiatan" class="img"><img :src="data.poster_kegiatan" :alt="data.nama_kegiatan" class="img"></a></td>
                                <td><a :href="data.foto_kegiatan" class="img"><img :src="data.foto_kegiatan" :alt="data.nama_kegiatan" class="img"></a></td>
                                <td>{{ data.id_pengguna }}</td>
                                
                                <td>
                                    <a href="#" @click.prevent="edit(data)"><i class="fa fa-edit"></i></a>
                                    <a href="#" @click.prevent="confirmDeletion(data.id_berita)"><i class="fa fa-trash text-danger ml-2"></i></a>
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
                        <span v-if="statusEditing">Edit Berita Kegiatan</span>
                        <span v-else>Tambah Berita Kegiatan</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="statusEditing ? editDataSchema : createDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <Field name="nama_kegiatan" type="text" class="form-control" :class="{ 'is-invalid': errors.nama_kegiatan }" id="nama_kegiatan"/>
                            <span class="invalid-feedback">{{ errors.nama_kegiatan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                            <Field name="deskripsi_kegiatan" as="textarea" class="form-control" :class="{ 'is-invalid': errors.deskripsi_kegiatan }" id="deskripsi_kegiatan" cols="30" rows="10"/>
                            <span class="invalid-feedback">{{ errors.deskripsi_kegiatan }}</span>
                        </div>

                        

                        <div class="form-group">
                            <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                            <div v-if="statusEditing">
                                
                            </div>
                            <Field name="tanggal_pelaksanaan" type="date" class="form-control" :class="{ 'is-invalid': errors.tanggal_pelaksanaan }" id="tanggal_pelaksanaan" aria-describedby="tanggal_pelaksanaanHelp" accept="tanggal_pelaksanaan/*" />
                            <span class="invalid-feedback">{{ errors.tanggal_pelaksanaan }}</span>
                        </div>

                        

                        <div class="form-group">
                            <label for="poster_kegiatan">Poster Kegiatan</label>
                            <div v-if="statusEditing">
                                <br>
                                <img :src="formImagePosterKegiatan.poster_kegiatan" class="img">
                            </div>
                            <Field name="poster_kegiatan" type="file" class="form-control" :class="{ 'is-invalid': errors.poster_kegiatan }" id="poster_kegiatan" aria-describedby="poster_kegiatanHelp" accept="poster_kegiatan/*" />
                            <span class="invalid-feedback">{{ errors.poster_kegiatan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="foto_kegiatan">Foto Kegiatan</label>
                            <div v-if="statusEditing">
                                <br>
                                <img :src="formImageFotoKegiatan.foto_kegiatan" class="img">
                            </div>
                            <Field name="foto_kegiatan" type="file" class="form-control" :class="{ 'is-invalid': errors.foto_kegiatan }" id="foto_kegiatan" aria-describedby="foto_kegiatanHelp" accept="foto_kegiatan/*" />
                            <span class="invalid-feedback">{{ errors.foto_kegiatan }}</span>
                        </div>

                        <div class="form-group">
                            <label for="id_pengguna">id_pengguna</label>
                            <Field name="id_pengguna" type="text" class="form-control" :class="{ 'is-invalid': errors.id_pengguna }" id="id_pengguna"/>
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
    const formImagePosterKegiatan          = ref(null);
    const formImageFotoKegiatan          = ref(null);
    const dataIdBeingDeleted = ref(null);
    const pageNumber         = ref(0);
    const resetValueImage    = () => {
        $ ("#poster_kegiatan").val(null);
        $ ("#foto_kegiatan").val(null);

    };
    

    const createDataSchema = yup.object({
        nama_kegiatan               : yup.string().required(),
        deskripsi_kegiatan          : yup.string().required(),
        tanggal_pelaksanaan         : yup.string().required(),
        poster_kegiatan             : yup.string().required(),
        foto_kegiatan               : yup.string().required(),
        id_pengguna                 : yup.string().required(),

    });
    const editDataSchema = yup.object({ 
        nama_kegiatan               : yup.string().required(),
        deskripsi_kegiatan          : yup.string().required(),
        tanggal_pelaksanaan         : yup.string().required(),
        poster_kegiatan             : null,
        foto_kegiatan               : null,
        id_pengguna                 : yup.string().required(),
    });
    const initForm = (data = null) => {
        if (data) {
            formValues.value = {
                id_berita                 : data.id_berita,
                nama_kegiatan             : data.nama_kegiatan,
                deskripsi_kegiatan        : data.deskripsi_kegiatan,
                tanggal_pelaksanaan       : data.tanggal_pelaksanaan,
                poster_kegiatan           : null,
                foto_kegiatan             : null,
                id_pengguna               : data.id_pengguna,
                
            };
            formImagePosterKegiatan.value = { poster_kegiatan : data.poster_kegiatan };  
            formImageFotoKegiatan.value = { foto_kegiatan : data.foto_kegiatan };              
        } else {
            formValues.value = {
                id_berita              : null,
                nama_kegiatan          : null,
                deskripsi_kegiatan     : null,
                tanggal_pelaksanaan    : null,
                poster_kegiatan        : null,
                foto_kegiatan          : null,
                id_pengguna            : null,
            };
        }
    };
    const getDatas = (page = 1) => {
        pageNumber.value = page;
        
        const queryParam = {
            page: page,
            search: searchQuery.value
        };
        requestGet(`admin/beritakegiatan`, queryParam)
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
            if (key !== 'id_berita') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/beritakegiatan/store', formData)
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
            if (values[key] && key !== 'id_berita') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/beritakegiatan/update/${formValues.value.id_berita}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = datas.value.data.findIndex(data => data.id_berita === RESPONSE.data.id_berita);
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
        requestDelete(`admin/beritakegiatan/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id_berita !== dataIdBeingDeleted.value);
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