<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            "title" => $this->title,
            "image" => env('APP_ENV') == 'local' ? asset('storage/' . $this->image) : secure_asset('storage/' . $this->image),
            "image_medium" => env('APP_ENV') == 'local' ? asset('storage/' . $this->image_medium) : secure_asset('storage/' . $this->image_medium),
            "image_small" => env('APP_ENV') == 'local' ? asset('storage/' . $this->image_small) : secure_asset('storage/' . $this->image_small),
        ];
    }
}
