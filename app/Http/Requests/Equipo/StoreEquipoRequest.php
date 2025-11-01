<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreEquipoRequest extends FormRequest
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
            'codigo' => 'required|string|unique:equipos,codigo',
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            'marca' => 'required|string',
            'organization_id' => 'required|integer|exists:organizations,id',
            'sistema_operativo' => 'required|string',
            'procesador' => 'required|string',
            'memoria_ram' => 'required|string',
            'almacenamiento' => 'required|string',
            'estado' => 'required|string',
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
