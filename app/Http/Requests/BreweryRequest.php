<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreweryRequest extends FormRequest
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
            // https://laravel.com/docs/10.x/validation#available-validation-rules
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:20',
            'place' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ];
    }

      /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener al menos tres posiciones',
            'name.max' => 'El campo nombre debe menos de veinte posiciones',

            'description' => [
                'required' => 'El campo descripción es obligatorio',
                'min' => 'El campo descripción debe tener al menos 20 caracteres'
            ],
            
            'place' => 'Es obligatoria la descripción',
            'latitude' => 'Es obligatoria la latitud',
            'longitude' => 'Es obligatoria la longitud'
            
        ];
    }
}
