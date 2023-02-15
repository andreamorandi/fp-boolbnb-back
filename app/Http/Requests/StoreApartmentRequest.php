<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:100'],
            'room_number' => ['required', 'numeric', 'integer', 'gt:0'],
            'bed_number' => ['required', 'numeric', 'integer', 'gt:0'],
            'bathroom_number' => ['required', 'numeric', 'integer', 'gt:0'],
            'surface_sqm' => ['required', 'numeric', 'integer', 'gt:0'],
            'full_address' => ['required'],
            'image' => ['required', 'image', 'max:5120'],
            'services' => ['required', 'exists:services,id'],
            'is_visible' => ['nullable'],
        ];
    }
}


// 'title' => ['required', 'max:100'],
// 'room_number' => ['required'],
// 'bed_number' => ['required'],
// 'bathroom_number' => ['required'],
// 'surface_sqm' => ['required'],
// 'full_address' => ['required'],
// 'image' => ['nullable', 'image', 'max:5120'],
// 'services' => ['required', 'exists:services,id'],
// 'is_visible' => ['nullable'],