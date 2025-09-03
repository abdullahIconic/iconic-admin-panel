<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "visible" => "required",
            "page_name" => "required",
            "slogan" => "required",
            "title" => "required",
            "overview" => "required",
            "image" => ["required", "image"],
            "link" => "required",
            "link_text" => "required",
        ];
    }
}
