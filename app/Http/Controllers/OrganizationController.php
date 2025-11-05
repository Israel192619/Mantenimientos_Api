<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
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
    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create($request->all());
        $data = [
            'message' => 'Organización creada exitósamente',
            'organization' => $organization,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        $data = [
            'mensaje' => 'Detalles de la organización',
            'organization' => $organization,
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->all());
        $data = [
            'message' => 'Organización actualizada exitósamente',
            'organization' => $organization,
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        if ($organization->equipos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la organización porque tiene equipos asociados.'
            ], 400);
        }

        $organization->delete();

        return response()->json([
            'message' => 'Organización eliminada exitósamente',
        ], 200);
    }
}
