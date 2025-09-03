<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            "language" => "required",
            "visible" => "required",
            "category" => "required",
            "title" => "required",
            "url" => "required|unique:blogs",
            "image" => "required|image",
        ];
    }
}
