<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeritaKegiatanResource extends JsonResource
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
            'id_berita' => $this->id_berita,
            'nama_kegiatan' => $this->nama_kegiatan,
            'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'poster_kegiatan' =>env('VITE_APP_URL') .$this->poster_kegiatan,
            'foto_kegiatan' =>env('VITE_APP_URL') . $this->foto_kegiatan,
            'id_pengguna' => $this->id_pengguna,
           
        ];
    }
}
