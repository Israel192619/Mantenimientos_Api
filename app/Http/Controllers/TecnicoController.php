<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tecnicos = Tecnico::all();
        $data = [
            'mensaje' => 'Lista de técnicos',
            'tecnicos' => $tecnicos,
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
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'nullable|string',
            'especialidad' => 'nullable|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $tecnico = Tecnico::create($request->all());
        $data = [
            'message' => 'Técnico creado',
            'tecnico' => $tecnico,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tecnico = Tecnico::find($id);
        if (!$tecnico) {
            $data = [
                "message" => "Técnico no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'mensaje' => 'Detalles del técnico',
            'tecnico' => $tecnico,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tecnico = Tecnico::find($id);
        if(!$tecnico){
            $data = [
                "message" => "Técnico no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $validate = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string',
            'primer_apellido' => 'sometimes|required|string',
            'segundo_apellido' => 'sometimes|nullable|string',
            'especialidad' => 'sometimes|nullable|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $tecnico->update($request->all());
        $data = [
            'message' => 'Técnico actualizado',
            'tecnico' => $tecnico,
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tecnico = Tecnico::find($id);
        if(!$tecnico){
            $data = [
                "message" => "Técnico no encontrado",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $tecnico->delete();
        $data = [
            "message" => "Técnico eliminado",
        ];
        return response()->json($data, 200);
    }
}
