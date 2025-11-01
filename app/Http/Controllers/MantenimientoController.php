<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mantenimiento\StoreMantenimientoRequest;
use App\Http\Requests\Mantenimiento\UpdateMantenimientoRequest;
use App\Models\Equipo;
use App\Models\Mantenimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function store(StoreMantenimientoRequest $request)
    {
        $mantenimiento = Mantenimiento::create($request->all());

        if ($request->filled('tareas')) {
            $mantenimiento->tareas()->attach($request->tareas);
        }
        $data = [
            'message' => 'Mantenimiento creado',
            'mantenimiento' => $mantenimiento->load('tareas'),
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mantenimiento $mantenimiento)
    {
        $data = [
            'mensaje' => 'Detalles del mantenimiento',
            'mantenimiento' => $mantenimiento->load('equipo', 'tecnico', 'tareas'),
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMantenimientoRequest $request, Mantenimiento $mantenimiento)
    {
        $mantenimiento->update($request->all());
        if ($request->filled('tareas')) {
            $mantenimiento->tareas()->sync($request->tareas);
        }

        if ($mantenimiento->estado === 'completado') {
            $mantenimiento->fecha_real = Carbon::now();
            $mantenimiento->save();

            $equipo = Equipo::find($mantenimiento->equipo_id);
            $equipo->ultimo_mantenimiento = $mantenimiento->fecha_real;
            $equipo->proximo_mantenimiento = Carbon::now()->addMonths(6);
            $equipo->save();

            Mantenimiento::create([
                'equipo_id' => $mantenimiento->equipo_id,
                'fecha_programada' => Carbon::now()->addMonths(6),
            ]);
        }

        $data = [
            "message" => "Mantenimiento editado",
            "mantenimiento" => $mantenimiento->load('equipo', 'tecnico', 'tareas'),
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();
        $data = [
            "message" => "Mantenimiento eliminado"
        ];
        return response()->json($data, 200);
    }
}
