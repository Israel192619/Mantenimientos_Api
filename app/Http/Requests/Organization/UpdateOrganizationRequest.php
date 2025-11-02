<?php

namespace App\Http\Requests\Organization;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOrganizationRequest extends FormRequest
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
        $organization = $this->route('organization');
        return [
            'nombre' => 'sometimes|required|string|unique:organizations,nombre,' . $organization->id,
            'descripcion' => 'sometimes|nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la organización es obligatorio cuando se envía.',
            'nombre.string' => 'El nombre de la organización debe ser un texto válido.',
            'nombre.unique' => 'Ya existe una organización con este nombre.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
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
