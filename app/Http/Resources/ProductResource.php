<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($product)
    {
        return [
            "title" => $this->title,
            "url" => $this->url,
            "image" => env('APP_ENV') == 'local' ? asset('storage/'.$this->image) : secure_asset('storage/'.$this->image),
        ];
    }
}
