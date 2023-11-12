<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersembahanResource extends JsonResource
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
            'id_persembahan' => $this->id_persembahan,
            'perolehan_persembahan' => $this->perolehan_persembahan,
            'keterangan' => $this->keterangan,
            'id_jadwal_ibadah' => $this->id_jadwal_ibadah,
            'id_pengguna' => $this->id_pengguna,
        ];
    }
}