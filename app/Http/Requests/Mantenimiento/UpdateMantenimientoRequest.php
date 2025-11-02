<?php

namespace App\Http\Requests\Mantenimiento;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMantenimientoRequest extends FormRequest
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
            'fecha_programada' => 'sometimes|date',
            'equipo_id' => 'sometimes|integer|exists:equipos,id',
            'tecnico_id' => 'nullable|integer|exists:tecnicos,id',
            'estado' => 'nullable|string|in:pendiente,completado',
            'tareas' => 'array',
            'tareas.*' => 'integer|exists:tareas,id',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_programada.date' => 'La fecha programada debe tener un formato de fecha válido.',

            'equipo_id.integer' => 'El identificador del equipo debe ser un número entero.',
            'equipo_id.exists' => 'El equipo seleccionado no existe en el sistema.',

            'tecnico_id.integer' => 'El identificador del técnico debe ser un número entero.',
            'tecnico_id.exists' => 'El técnico seleccionado no existe en el sistema.',

            'estado.string' => 'El estado debe ser un texto válido.',
            'estado.in' => 'El estado solo puede ser "pendiente" o "completado".',

            'tareas.array' => 'El campo de tareas debe ser un arreglo.',
            'tareas.*.integer' => 'Cada tarea debe ser un número entero.',
            'tareas.*.exists' => 'Alguna de las tareas seleccionadas no existe en el sistema.',
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
