<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            "url" => $this->url,
            "description" => $this->description,
            "article" => $this->article,
            "image" => env('APP_ENV') == 'local'
                ? asset('storage/' . $this->image)
                : secure_asset('storage/' . $this->image),

            "icon" => env('APP_ENV') == 'local'
                ? asset('storage/' . $this->icon)
                : secure_asset('storage/' . $this->icon),
        ];
    }
}
