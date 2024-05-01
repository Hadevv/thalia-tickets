<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'representation_id' => 'required|exists:representations,id',
            'places.adulte' => 'nullable|integer|min:0',
            'places.enfant' => 'nullable|integer|min:0',
            'places.senior' => 'nullable|integer|min:0',
        ];
    }
}
