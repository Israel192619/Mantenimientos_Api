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

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del equipo es obligatorio.',
            'codigo.string' => 'El código del equipo debe ser un texto.',
            'codigo.unique' => 'Ya existe un equipo con este código.',

            'nombre.required' => 'El nombre del equipo es obligatorio.',
            'nombre.string' => 'El nombre del equipo debe ser un texto válido.',

            'tipo.required' => 'El tipo de equipo es obligatorio.',
            'tipo.string' => 'El tipo de equipo debe ser un texto válido.',

            'marca.required' => 'La marca del equipo es obligatoria.',
            'marca.string' => 'La marca del equipo debe ser un texto válido.',

            'organization_id.required' => 'La organización es obligatoria.',
            'organization_id.integer' => 'El identificador de la organización debe ser un número entero.',
            'organization_id.exists' => 'La organización seleccionada no existe en el sistema.',

            'sistema_operativo.required' => 'El sistema operativo es obligatorio.',
            'sistema_operativo.string' => 'El sistema operativo debe ser un texto válido.',

            'procesador.required' => 'El procesador es obligatorio.',
            'procesador.string' => 'El procesador debe ser un texto válido.',

            'memoria_ram.required' => 'La memoria RAM es obligatoria.',
            'memoria_ram.string' => 'La memoria RAM debe ser un texto válido.',

            'almacenamiento.required' => 'El almacenamiento es obligatorio.',
            'almacenamiento.string' => 'El almacenamiento debe ser un texto válido.',

            'estado.required' => 'El estado del equipo es obligatorio.',
            'estado.string' => 'El estado debe ser un texto válido.',
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
