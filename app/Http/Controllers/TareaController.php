<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::all();
        $data = [
            'mensaje' => 'Lista de tareas',
            'tareas' => $tareas,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $tarea = Tarea::create($request->all());
        $data = [
            'message' => 'Tarea creada',
            'tarea' => $tarea,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarea = Tarea::find($id);
        if (!$tarea) {
            $data = [
                "message" => "Tarea no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'mensaje' => 'Detalles de la tarea',
            'tarea' => $tarea,
        ];
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tarea = Tarea::find($id);
        if (!$tarea) {
            $data = [
                "message" => "Tarea no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $validate = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string',
            'descripcion' => 'sometimes|required|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $tarea->update($request->all());
        $data = [
            'message' => 'Tarea actualizada',
            'tarea' => $tarea,
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarea = Tarea::find($id);
        if (!$tarea) {
            $data = [
                "message" => "Tarea no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $tarea->delete();
        $data = [
            'message' => 'Tarea eliminada',
        ];
        return response()->json($data, 200);
    }
}
