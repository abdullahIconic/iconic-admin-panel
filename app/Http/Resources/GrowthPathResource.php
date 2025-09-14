<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrowthPathResource extends JsonResource
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
            "title" => $this->name,
            "year" => $this->year,
            "description" => $this->description,
            "image" => env('APP_ENV') == 'local' ? asset('storage/' . $this->image) : secure_asset('storage/' . $this->image),
        ];
    }
}
