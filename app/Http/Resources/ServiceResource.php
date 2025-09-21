<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($service)
    {
        return [
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "article" => $this->article,
            "category" => ['url' => $this->category->url],
            "image" => env('APP_ENV') == 'local' ? asset('storage/'.$this->image_medium) : secure_asset('storage/'.$this->image_medium),
        ];
    }
}
