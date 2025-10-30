<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::all();
        $data = [
            'mensaje' => 'Lista de organizaciones',
            'organizations' => $organizations,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:organizations,nombre',
            'description' => 'nullable|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $organization = Organization::create($request->all());
        $data = [
            'message' => 'Organización creada',
            'organization' => $organization,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $organization = Organization::find($id);
        if (!$organization) {
            $data = [
                "message" => "Organización no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'mensaje' => 'Detalles de la organización',
            'organization' => $organization,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $organization = Organization::find($id);
        if(!$organization){
            $data = [
                "message" => "Organización no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $validate = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|unique:organizations,nombre,' . $id,
            'description' => 'sometimes|nullable|string',
        ]);
        if($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }
        $organization->update($request->all());
        $data = [
            'message' => 'Organización actualizada',
            'organization' => $organization,
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organization = Organization::find($id);
        if(!$organization){
            $data = [
                "message" => "Organización no encontrada",
                "status" => 404
            ];
            return response()->json($data,404);
        }
        $organization->delete();
        $data = [
            'message' => 'Organización eliminada',
        ];
        return response()->json($data, 200);
    }
}
