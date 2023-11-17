<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PresensiJemaatResource extends JsonResource
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
            'id_presensi_jemaat' => $this->id_presensi_jemaat,
            'tanggal_waktu_presensi' => $this->tanggal_waktu_presensi,
            'id_jadwal_ibadah' => $this->id_jadwal_ibadah,
            'id_pengguna' => $this->id_pengguna,

        ];
    }
}
