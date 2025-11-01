<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tarea\StoreTareaRequest;
use App\Http\Requests\Tarea\UpdateTareaRequest;
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
    public function store(StoreTareaRequest $request)
    {
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
    public function show(Tarea $tarea)
    {
        $data = [
            'mensaje' => 'Detalles de la tarea',
            'tarea' => $tarea,
        ];
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
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
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        $data = [
            'message' => 'Tarea eliminada',
        ];
        return response()->json($data, 200);
    }
}
