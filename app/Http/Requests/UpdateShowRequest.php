<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShowRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:2000'],
            'poster_url' => [
                'nullable',
                'string',
                'max:255',
                Rule::requiredIf(function () {
                    return preg_match('/^https?:\/\//', $this->poster_url);
                }),
                Rule::requiredIf(function () {
                    return file_exists(public_path('images/' . basename($this->poster_url)));
                }),
            ],
            'duration' => ['required', 'numeric'],
            'artists' => ['nullable', 'array'],
            'artists.*' => ['exists:artists,id'],
        ];
    }
}
