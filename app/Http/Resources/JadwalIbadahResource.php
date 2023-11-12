<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalIbadahResource extends JsonResource
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
            'id_jadwal_ibadah' => $this->id_jadwal_ibadah,
            'nama_ibadah' => $this->nama_ibadah,
            'tanggal_waktu_pelaksanaan' => $this->tanggal_waktu_pelaksanaan,
            'tempat_pelaksanaan' => $this->tempat_pelaksanaan,
            'link_streaming' =>$this->link_streaming,
            'file_poster' =>env('VITE_APP_URL') . $this->file_poster,
           
        ];
    }
}