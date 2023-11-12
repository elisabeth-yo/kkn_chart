<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WartaJemaatResource extends JsonResource
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
            'id_warta' => $this->id_warta,
            'tanggal_warta' => $this->tanggal_warta,
            'file_warta' =>env('VITE_APP_URL') . $this->file_warta,
            'id_pengguna' => $this->id_pengguna,           
        ];
    }
}
