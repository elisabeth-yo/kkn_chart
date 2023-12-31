<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WilayahResource extends JsonResource
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
            'id_wilayah' => $this->id_wilayah,
            'nama_wilayah' => $this->nama_wilayah,
            'deskripsi' => $this->deskripsi,
        ];
    }
}
