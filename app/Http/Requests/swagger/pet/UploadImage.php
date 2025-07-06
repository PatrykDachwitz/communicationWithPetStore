<?php

namespace App\Http\Requests\swagger\pet;

use Illuminate\Foundation\Http\FormRequest;

class UploadImage extends FormRequest
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
            'additionalMetadata' => ['string'],
            'file' => ['file'],
        ];
    }
}
