<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeSettingResource extends JsonResource
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
            "id"          => $this->id,
            "key"         => $this->key,
            "title"       => $this->title,
            "description" => $this->description,
            "content"     => $this->content,
            "image"       => env('VITE_APP_URL') . $this->image,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at
        ];
    }
}
