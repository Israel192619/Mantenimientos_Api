<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientos = Mantenimiento::with(['equipo', 'tecnico', 'tareas'])->get();
        $data = [
            'mensaje' => 'Lista de mantenimientos',
            'mantenimientos' => $mantenimientos,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'fecha_programada' => 'required|date',
            'equipo_id' => 'required|integer',
            'tecnico_id' => 'required|integer',
            'estado' => 'required|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $mantenimiento = Mantenimiento::create($request->all());
        $data = [
            'message' => 'Mantenimiento creado',
            'mantenimiento' => $mantenimiento,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mantenimiento = Mantenimiento::find($id);
        if (!$mantenimiento) {
            $data = [
                "message" => "Mantenimiento no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'mensaje' => 'Detalles del mantenimiento',
            'mantenimiento' => $mantenimiento,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mantenimiento = Mantenimiento::find($id);
        if(!$mantenimiento){
            $data = [
                "message" => "Mantenimiento no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $validate = Validator::make($request->all(), [
            'fecha_programada' => 'sometimes|required|date',
            'equipo_id' => 'sometimes|required|integer',
            'tecnico_id' => 'sometimes|required|integer',
            'estado' => 'sometimes|required|string',
        ]);
        if($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }

        $mantenimiento->update($request->all());

        $data = [
            "message" => "Mantenimiento editado",
            "mantenimiento" => $mantenimiento,
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mantenimiento = Mantenimiento::find($id);
        if(!$mantenimiento){
            $data = [
                "message" => "Mantenimiento no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $mantenimiento->delete();
        $data = [
            "message" => "Mantenimiento eliminado"
        ];
        return response()->json($data, 200);
    }

    // Asignar tareas al mantenimiento
    public function asignarTareas(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $data = $request->validate([
            'tareas' => 'required|array',
            'tareas.*' => 'exists:tareas,id',
        ]);

        // Asocia las tareas (sin duplicar)
        $mantenimiento->tareas()->syncWithoutDetaching(
            collect($data['tareas'])->mapWithKeys(fn ($tareaId) => [
                $tareaId => ['estado' => 'pendiente']
            ])->toArray()
        );

        return response()->json([
            'message' => 'Tareas asignadas correctamente',
            'mantenimiento' => $mantenimiento->load('tareas')
        ]);
    }

    // Actualizar el estado u observaciones de una tarea específica del mantenimiento
    public function actualizarTarea(Request $request, $id, $tareaId)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $data = $request->validate([
            'estado' => 'nullable|in:pendiente,en_proceso,completada',
            'observaciones' => 'nullable|string',
        ]);

        $mantenimiento->tareas()->updateExistingPivot($tareaId, $data);

        return response()->json([
            'message' => 'Tarea actualizada correctamente',
            'pivot' => $mantenimiento->tareas()->find($tareaId)->pivot
        ]);
    }
}
