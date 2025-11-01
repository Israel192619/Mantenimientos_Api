<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tecnico\StoreTecnicoRequest;
use App\Http\Requests\Tecnico\UpdateTecnicoRequest;
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
    public function store(StoreTecnicoRequest $request)
    {
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
    public function show(Tecnico $tecnico)
    {
        $data = [
            'mensaje' => 'Detalles del técnico',
            'tecnico' => $tecnico,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTecnicoRequest $request, Tecnico $tecnico)
    {
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
    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        $data = [
            "message" => "Técnico eliminado",
        ];
        return response()->json($data, 200);
    }
}
