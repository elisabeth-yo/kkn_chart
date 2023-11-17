<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublikasiRenunganResource extends JsonResource
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
            'id_publikasi_renungan' => $this->id_publikasi_renungan,
            'tanggal_publikasi' => $this->tanggal_publikasi,
            'id_bahan_bacaan' => $this->id_bahan_bacaan,
            'id_pengguna' => $this->id_pengguna,

        ];
    }
}
