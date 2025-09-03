<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCareerRequest extends FormRequest
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
            'visible' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'url' => ['required', Rule::unique('careers')->ignore($this->career)],
            'image' => ['nullable', 'image'],
        ];
    }
}
