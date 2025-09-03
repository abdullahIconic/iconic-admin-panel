<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($slider)
    {
        return [
            "slogan" => $this->slogan,
            "slogan_color" => $this->slogan_color,
            "title" => $this->title,
            "title_color" => $this->title_color,
            "overview" => $this->overview,
            "overview_color" => $this->overview_color,
            "link" => $this->link,
            "link_text" => $this->link_text,
            "button_color" => $this->button_color,
            "label_color" => $this->label_color,
            "image" => $this->image,
            "image" => env('APP_ENV') == 'local' ? asset('storage/'.$this->image) : secure_asset('storage/'.$this->image),
        ];
    }
}
