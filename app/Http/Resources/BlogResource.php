<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($post)
    {
        return [
            "category" => $this->category->title,
            'created_at' => $this->created_at->format('M d, Y'),
            'duration' => readingTime($this->article),
            "title" => $this->title,
            "url" => $this->url,
            "meta_description" => $this->meta_description, // substr($this->meta_description, 0, 100),
            "image" => env('APP_ENV') == 'local' ? asset('storage/'.$this->image_medium) : secure_asset('storage/'.$this->image_medium),
        ];
    }
}
