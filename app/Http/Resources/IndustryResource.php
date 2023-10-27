<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndustryResource extends JsonResource
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
            "id" => $this->id,
            "code" => $this->code,
            "title" => $this->title,
            "header_image" => env('VITE_APP_URL') . $this->header_image,
            "header_slogan" => $this->header_slogan,
            "header_description" => $this->header_description,
            "slogan" => $this->slogan,
            "description" => $this->description,
            "image" => env('VITE_APP_URL') . $this->image,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "supplies" => $this->supplies,
            "benefits" => BenefitResource::collection($this->benefits),
        ];
    }
}
