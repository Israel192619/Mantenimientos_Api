<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEquipoRequest extends FormRequest
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
        $equipo = $this->route('equipo');
        return [
            'codigo' => 'sometimes|required|string|unique:equipos,codigo,' . $equipo->id,
            'nombre' => 'sometimes|required|string',
            'tipo' => 'sometimes|required|string',
            'marca' => 'sometimes|required|string',
            'organization_id' => 'sometimes|required|string|exists:organizations,id',
            'sistema_operativo' => 'sometimes|required|string',
            'procesador' => 'sometimes|required|string',
            'memoria_ram' => 'sometimes|required|string',
            'almacenamiento' => 'sometimes|required|string',
            'estado' => 'sometimes|required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del equipo es obligatorio.',
            'codigo.string' => 'El código del equipo debe ser un texto.',
            'codigo.unique' => 'Ya existe otro equipo con este código.',

            'organization_id.required' => 'La organización es obligatoria.',
            'organization_id.integer' => 'El identificador de la organización debe ser un número entero.',
            'organization_id.exists' => 'La organización seleccionada no existe.',

            'nombre.required' => 'El nombre del equipo es obligatorio.',
            'tipo.required' => 'El tipo de equipo es obligatorio.',
            'marca.required' => 'La marca del equipo es obligatoria.',
            'sistema_operativo.required' => 'El sistema operativo es obligatorio.',
            'procesador.required' => 'El procesador es obligatorio.',
            'memoria_ram.required' => 'La memoria RAM es obligatoria.',
            'almacenamiento.required' => 'El almacenamiento es obligatorio.',
            'estado.required' => 'El estado del equipo es obligatorio.',
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
