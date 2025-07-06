<?php

namespace App\Http\Requests\swagger\pet;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'int'],
            'category.name' => ['required', 'string'],
            'category.id' => ['required', 'int'],
            'name' => ['required', 'string'],
            'photoUrls.0' => ['required', 'string'],
            'tags.0.id' => ['required', 'int'],
            'tags.0.name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }
}
