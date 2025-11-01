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
            'organizacion' => 'sometimes|required|string',
            'sistema_operativo' => 'sometimes|required|string',
            'procesador' => 'sometimes|required|string',
            'memoria_ram' => 'sometimes|required|string',
            'almacenamiento' => 'sometimes|required|string',
            'estado' => 'sometimes|required|string',
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
