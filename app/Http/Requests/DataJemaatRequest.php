<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataJemaatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'kode_dokumen' => ['required'],
        'nama_lengkap' => ['required'],
        'jenis_kelamin' => ['required'],
        'tempat_lahir' => ['required'],
        'tanggal_lahir' => ['required', 'date'],
        'golongan_darah' => ['required'],
        'alamat_domisili' => ['required'],
        'rt' => ['required'],
        'rw' => ['required'],
        'kode_pos' => ['required'],
        'nomor_telepon_rumah' => ['required'],
        'nomor_telepon_seluler' => ['required'],
        'status_perkawinan' => ['required'],
        'status_hubungan_dalam_keluarga' => ['required'],
        'pendidikan_terakhir' => ['required'],
        'bidang_ilmu' => ['required'],
        'aktivitas_keseharian' => ['required'],
        'pekerjaan_terakhir' => ['required'],
        'nama_instansi_tempat_bekerja' => ['required'],
        'status_hubungan_kerja' => ['required'],
        'gereja_tempat_baptis' => ['required'],
        'tanggal_baptis' => ['required', 'date'],
        'gereja_tempat_sidi' => ['required'],
        'tanggal_sidi' => ['required', 'date'],
        'rata_rata_pengeluaran' => ['required', 'numeric'],
        'rata_rata_penghasilan' => ['required', 'numeric'],
        'status_rumah_tinggal' => ['required'],
        'transportasi_utama' => ['required'],
        'foto' => ['required'],
        'id_wilayah' => ['required'],
        ];
    }
}
