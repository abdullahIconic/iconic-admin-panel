<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndustryProjectRequest extends FormRequest
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
            "isFeatured" => "required",
            "industry_id" => "required",
            "authored_by" => "required",
            "title" => "required",
            "description" => "required",
            "url" => "required|unique:industry_projects",
            "article" => "required",
            "image" => "required|image",
        ];
    }
}
