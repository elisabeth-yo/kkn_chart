<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenggunaResource extends JsonResource
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
            'id' => $this->id,
            'id_pengguna' => $this->id_pengguna,
            'email' => $this->email,
            'password'=> $this->password,
            'profil_pengguna'=> $this->profil_pengguna,
            'id_kategori_pengguna'=> $this->id_kategori_pengguna,
            'id_data_jemaat'=> $this->id_data_jemaat,
        ];
    }
}
