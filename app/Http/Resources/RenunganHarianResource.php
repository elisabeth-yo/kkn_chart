<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RenunganHarianResource extends JsonResource
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
            'id_renungan' => $this->id_renungan,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'gambar_bahan_bacaan' =>env('VITE_APP_URL') .$this->gambar_bahan_bacaan,
            'sumber_referensi' => $this->sumber_referensi,
            'tanggal_dibuat' => $this->tanggal_dibuat,
        ];
    }
}