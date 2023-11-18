<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataJemaatResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        return [
            'id_data_jemaat' => $this->id_data_jemaat,
            'kode_dokumen' => $this->kode_dokumen,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'golongan_darah' => $this->golongan_darah,
            'alamat_domisili' => $this->alamat_domisili,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'kode_pos' => $this->kode_pos,
            'nomor_telepon_rumah' => $this->nomor_telepon_rumah,
            'nomor_telepon_seluler' => $this->nomor_telepon_seluler,
            'status_perkawinan' => $this->status_perkawinan,
            'status_hubungan_dalam_keluarga' => $this->status_hubungan_dalam_keluarga,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'bidang_ilmu' => $this->bidang_ilmu,
            'aktivitas_keseharian' => $this->aktivitas_keseharian,
            'pekerjaan_terakhir' => $this->pekerjaan_terakhir,
            'nama_instansi_tempat_bekerja' => $this->nama_instansi_tempat_bekerja,
            'status_hubungan_kerja' => $this->status_hubungan_kerja,
            'gereja_tempat_baptis' => $this->gereja_tempat_baptis,
            'tanggal_baptis' => $this->tanggal_baptis,
            'gereja_tempat_sidi' => $this->gereja_tempat_sidi,
            'tanggal_sidi' => $this->tanggal_sidi,
            'rata_rata_pengeluaran' => $this->rata_rata_pengeluaran,
            'rata_rata_penghasilan' => $this->rata_rata_penghasilan,
            'status_rumah_tinggal' => $this->status_rumah_tinggal,
            'transportasi_utama' => $this->transportasi_utama,
            'foto' =>env('VITE_APP_URL') . $this->foto,
            'id_wilayah' => $this->id_wilayah,
        ];
    }
}
