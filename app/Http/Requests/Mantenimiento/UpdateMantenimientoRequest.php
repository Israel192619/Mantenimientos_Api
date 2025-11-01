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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación',
            'errors' => $validator->errors()
        ], 422));
    }
}
