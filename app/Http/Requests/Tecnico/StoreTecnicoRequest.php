<?php

namespace App\Http\Requests\Tecnico;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTecnicoRequest extends FormRequest
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
            'nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'nullable|string',
            'especialidad' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del técnico es obligatorio.',
            'nombre.string' => 'El nombre debe contener solo texto.',
            'primer_apellido.required' => 'Debe ingresar el primer apellido.',
            'especialidad.string' => 'La especialidad debe ser un texto válido.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación',
            'errors' => $validator->errors()
        ], 422));
    }

}
