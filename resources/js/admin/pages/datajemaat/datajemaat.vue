<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jemaat</h1>
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
                        Tambah Data Jemaat
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
                                <th>Nama Lengkap</th>
                                <th>Alamat Domisili</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Status Perkawinan</th>
                                <th>Foto</th>
                                <th>Id Wilayah</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.nama_lengkap }}</td>
                                <td>{{ data.alamat_domisili }}</td>
                                <td>{{ data.jenis_kelamin }}</td>
                                <td>{{ data.tanggal_lahir }}</td>
                                <td>{{ data.status_perkawinan }}</td>
                                <td><a :href="data.foto" class="img"><img :src="data.foto" :alt="data.nama_lengkap" class="img"></a></td>
                                <td>{{ data.id_wilayah }}</td>
                                <td>
                                    <a href="#" @click.prevent="edit(data)"><i class="fa fa-edit"></i></a>
                                    <a href="#" @click.prevent="confirmDeletion(data.id_data_jemaat)"><i class="fa fa-trash text-danger ml-2"></i></a>
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
                        <span v-if="statusEditing">Edit Data Jemaat</span>
                        <span v-else>Tambah Data Jemaat</span>
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
    const formImageFoto          = ref(null);
    const dataIdBeingDeleted = ref(null);
    const pageNumber         = ref(0);
    const resetValueImage    = () => {
        $ ("#foto").val(null);
    };
    

    const createDataSchema = yup.object({
        kode_dokumen                       : yup.string().required(),
        nama_lengkap                       : yup.string().required(),
        jenis_kelamin                      : yup.string().required(),
        tempat_lahir                       : yup.string().required(),
        golongan_darah                     : yup.string().required(),
        alamat_domisili                    : yup.string().required(),
        rt                                 : yup.string().required(),
        rw                                 : yup.string().required(),
        kode_pos                           : yup.string().required(),
        nomor_telpon_rumah                 : yup.string().required(),
        nomor_telpon_seluler               : yup.string().required(),
        status_perkawinan                  : yup.string().required(),
        status_hubungan_dalam_keluarga     : yup.string().required(),
        pendidikan_terakhir                : yup.string().required(),
        bidang_ilmu                        : yup.string().required(),
        aktivitas_keseharian               : yup.string().required(),
        pekerjaan_terakhir                 : yup.string().required(),
        nama_instansi_tempat_kerja         : yup.string().required(),
        status_hubungan_kerja              : yup.string().required(),
        gereja_tempat_baptis               : yup.string().required(),
        tanggal_baptis                     : yup.string().required(),
        gereja_tempat_sidi                 : yup.string().required(),
        tanggal_sidi                       : yup.string().required(),
        rata_rata_pengeluaran              : yup.string().required(),
        rata_rata_penghasilan              : yup.string().required(),
        status_rumah_tinggal               : yup.string().required(),
        transportasi_utama                 : yup.string().required(),
        foto                               : yup.string().required(),
        id_wilayah                         : yup.string().required(),
       

    });
    const editDataSchema = yup.object({ 
        kode_dokumen                       : yup.string().required(),
        nama_lengkap                       : yup.string().required(),
        jenis_kelamin                      : yup.string().required(),
        tempat_lahir                       : yup.string().required(),
        golongan_darah                     : yup.string().required(),
        alamat_domisili                    : yup.string().required(),
        rt                                 : yup.string().required(),
        rw                                 : yup.string().required(),
        kode_pos                           : yup.string().required(),
        nomor_telpon_rumah                 : yup.string().required(),
        nomor_telpon_seluler               : yup.string().required(),
        status_perkawinan                  : yup.string().required(),
        status_hubungan_dalam_keluarga     : yup.string().required(),
        pendidikan_terakhir                : yup.string().required(),
        bidang_ilmu                        : yup.string().required(),
        aktivitas_keseharian               : yup.string().required(),
        pekerjaan_terakhir                 : yup.string().required(),
        nama_instansi_tempat_kerja         : yup.string().required(),
        status_hubungan_kerja              : yup.string().required(),
        gereja_tempat_baptis               : yup.string().required(),
        tanggal_baptis                     : yup.string().required(),
        gereja_tempat_sidi                 : yup.string().required(),
        tanggal_sidi                       : yup.string().required(),
        rata_rata_pengeluaran              : yup.string().required(),
        rata_rata_penghasilan              : yup.string().required(),
        status_rumah_tinggal               : yup.string().required(),
        transportasi_utama                 : yup.string().required(),
        foto                               : null,
        id_wilayah                         : yup.string().required(),
    });
    const initForm = (data = null) => {
        if (data) {
            formValues.value = {
                id_data_jemaat                     : data.id_data_jemaat,
                kode_dokumen                       : data.kode_dokumen,
                nama_lengkap                       : data.nama_lengkap,
                jenis_kelamin                      : data.jenis_kelamin,
                tempat_lahir                       : data.tempat_lahir,
                golongan_darah                     : data.golongan_darah,
                alamat_domisili                    : data.alamat_domisili,
                rt                                 : data.rt,
                rw                                 : data.rw,
                kode_pos                           : data.kode_pos,
                nomor_telpon_rumah                 : data.nomor_telpon_rumah,
                nomor_telpon_seluler               : data.nomor_telpon_seluler,
                status_perkawinan                  : data.sataus_perkawinan,
                status_hubungan_dalam_keluarga     : data.status_hubungan_dalam_keluarga,
                pendidikan_terakhir                : data.pendidikan_terakhir,
                bidang_ilmu                        : data.bidang_ilmu,
                aktivitas_keseharian               : data.aktivitas_keseharian,
                pekerjaan_terakhir                 : data.pekerjaan_terakhir,
                nama_instansi_tempat_kerja         : data.nama_instansi_tempat_kerja,
                status_hubungan_kerja              : data.status_hubungan_kerja,
                gereja_tempat_baptis               : data.gereja_tempat_baptis,
                tanggal_baptis                     : data.tanggal_baptis,
                gereja_tempat_sidi                 : data.gereja_tempat_sidi,
                tanggal_sidi                       : data.tanggal_sidi,
                rata_rata_pengeluaran              : data.rata_rata_pengeluaran,
                rata_rata_penghasilan              : data.rata_rata_penghasilan,
                status_rumah_tinggal               : data.status_rumah_tinggal,
                transportasi_utama                 : data.transportasi_utama,
                foto                               : null,
                id_wilayah                         : data.id_wilayah,
                        
            };
            formImageFoto.value = { foto : data.foto };  
                     
        } else {
            formValues.value = {
                id_data_jemaat                     : null,
                kode_dokumen                       : null,
                nama_lengkap                       : null,
                jenis_kelamin                      : null,
                tempat_lahir                       : null,
                golongan_darah                     : null,
                alamat_domisili                    : null,
                rt                                 : null,
                rw                                 : null,
                kode_pos                           : null,
                nomor_telpon_rumah                 : null,
                nomor_telpon_seluler               : null,
                status_perkawinan                  : null,
                status_hubungan_dalam_keluarga     : null,
                pendidikan_terakhir                : null,
                bidang_ilmu                        : null,
                aktivitas_keseharian               : null,
                pekerjaan_terakhir                 : null,
                nama_instansi_tempat_kerja         : null,
                status_hubungan_kerja              : null,
                gereja_tempat_baptis               : null,
                tanggal_baptis                     : null,
                gereja_tempat_sidi                 : null,
                tanggal_sidi                       : null,
                rata_rata_pengeluaran              : null,
                rata_rata_penghasilan              : null,
                status_rumah_tinggal               : null,
                transportasi_utama                 : null,
                foto                               : null,
                id_wilayah                         : null,
            };
        }
    };
    const getDatas = (page = 1) => {
        pageNumber.value = page;
        
        const queryParam = {
            page: page,
            search: searchQuery.value
        };
        requestGet(`admin/datajemaat`, queryParam)
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
            if (key !== 'id_data_jemaat') {
                formData.append(key, values[key]);
            }
        });

        requestPost('admin/datajemaat/store', formData)
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
            if (values[key] && key !== 'id_data_jemaat') {
                formData.append(key, values[key])                
            }
        });                
        
        requestPatch(`admin/datajemaat/update/${formValues.value.id_data_jemaat}`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            const index = datas.value.data.findIndex(data => data.id_data_jemaat === RESPONSE.data.id_data_jemaat);
            datas.value.data[index] = RESPONSE.data;
            resetForm();
            $('#modalForm').modal('hide');
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors(error.response.data.errors);
        });
    };
    const confirmDeletion = (id_data_jemaat) => {
        dataIdBeingDeleted.value = id_data_jemaat;
        $('#modalDeleteForm').modal('show');
    };
    const deleteData = () => {
        requestDelete(`admin/datajemaat/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id_data_jemaat !== dataIdBeingDeleted.value);
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