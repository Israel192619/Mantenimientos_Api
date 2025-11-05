<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipo\StoreEquipoRequest;
use App\Http\Requests\Equipo\UpdateEquipoRequest;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::with('organization')->get();
        $data = [
            'mensaje' => 'Lista de equipos',
            'equipos' => $equipos,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipoRequest $request)
    {
        $equipo = Equipo::create($request->all());
        $data = [
            'message' => 'Equipo creado exitósamente',
            'equipo' => $equipo->load('organization'),
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        $data = [
            'mensaje' => 'Detalles del equipo',
            'equipo' => $equipo->load('organization'),
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        $equipo->update($request->all());
        $data = [
            "message" => "Equipo actualizado exitósamente",
            "equipo" => $equipo->load('organization')
        ];
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        if ($equipo->mantenimientos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el equipo porque tiene mantenimientos asociados.'
            ], 400);
        }
        $equipo->delete();
        $data = [
            "message" => "Equipo eliminado exitósamente",
        ];
        return response()->json($data,200);
    }
}
