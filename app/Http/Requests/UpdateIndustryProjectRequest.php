<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIndustryProjectRequest extends FormRequest
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
            "title" => "required",
            "url" => ["required", Rule::unique('industry_projects')->ignore($this->project)],
            "image" => "nullable|image",
            "isFeatured" => "required",
            "industry_id" => "required",
            "authored_by" => "required",
            "description" => "required",
            "article" => "required",
        ];
    }
}
