<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'website_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title cannot be empty',
            'description.required' => 'Description cannot be empty',
            'website_id.required' => 'Website cannot be empty'
        ];
    }
}
