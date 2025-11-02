<?php

namespace App\Http\Requests\Tarea;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTareaRequest extends FormRequest
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
            'nombre' => 'required|string|unique:tareas,nombre',
            'descripcion' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la tarea es obligatorio.',
            'nombre.string' => 'El nombre de la tarea debe ser un texto válido.',
            'nombre.unique' => 'Ya existe una tarea con este nombre, elija otro nombre.',

            'descripcion.required' => 'Debe ingresar una descripción para la tarea.',
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
