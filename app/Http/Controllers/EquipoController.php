<?php

namespace App\Http\Controllers;

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
        $equipos = Equipo::all();
        $data = [
            'mensaje' => 'Lista de equipos',
            'equipos' => $equipos,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
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
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $equipo = Equipo::create($request->all());
        $data = [
            'message' => 'Equipo creado',
            'equipo' => $equipo,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            $data = [
                "message" => "Equipo no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'mensaje' => 'Detalles del equipo',
            'equipo' => $equipo,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipo = Equipo::find($id);
        if(!$equipo){
            $data = [
                "message" => "Equipo no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $validate = Validator::make($request->all(), [
            'codigo' => 'sometimes|required|string|unique:equipos,codigo,' . $id,
            'nombre' => 'sometimes|required|string',
            'tipo' => 'sometimes|required|string',
            'marca' => 'sometimes|required|string',
            'organizacion' => 'sometimes|required|string',
            'sistema_operativo' => 'sometimes|required|string',
            'procesador' => 'sometimes|required|string',
            'memoria_ram' => 'sometimes|required|string',
            'almacenamiento' => 'sometimes|required|string',
            'estado' => 'sometimes|required|string',
        ]);
        if($validate->fails()) {
            $data = [
                "message" => "Error de validación",
                "errors" => $validate->errors()
            ];
            return response()->json($data,400);
        }
        $equipo->update($request->all());
        $data = [
            "message" => "Equipo actualizado",
            "equipo" => $equipo
        ];
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipo::find($id);
        if(!$equipo){
            $data = [
                "message" => "Equipo no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $equipo->delete();
        $data = [
            "message" => "Equipo eliminado"
        ];
        return response()->json($data,200);
    }
}
