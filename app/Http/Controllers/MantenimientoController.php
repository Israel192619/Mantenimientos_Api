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

    public function index()
    {
        $mantenimientos = Mantenimiento::with(['equipo', 'tecnico', 'tareas'])->get();
        $data = [
            'mensaje' => 'Lista de mantenimientos',
            'mantenimientos' => $mantenimientos,
        ];
        return response()->json($data, 200);
    }

    public function store(StoreMantenimientoRequest $request)
    {
        $mantenimiento = Mantenimiento::create($request->all());

        if ($request->filled('tareas')) {
            $mantenimiento->tareas()->attach($request->tareas);
        }
        $equipo = Equipo::find($mantenimiento->equipo_id);
        $equipo->proximo_mantenimiento = $mantenimiento->fecha_programada;
        $equipo->save();
        $data = [
            'message' => 'Mantenimiento creado',
            'mantenimiento' => $mantenimiento->load('tareas'),
        ];
        return response()->json($data, 201);
    }

    public function show(Mantenimiento $mantenimiento)
    {
        $data = [
            'mensaje' => 'Detalles del mantenimiento',
            'mantenimiento' => $mantenimiento->load('equipo', 'tecnico', 'tareas'),
        ];
        return response()->json($data, 200);
    }

    public function update(UpdateMantenimientoRequest $request, Mantenimiento $mantenimiento)
    {
        $mantenimiento->update($request->all());
        if ($request->filled('tareas')) {
            $mantenimiento->tareas()->sync($request->tareas);
        }
        $equipo = Equipo::find($mantenimiento->equipo_id);
        if ($mantenimiento->estado === 'completado') {
            $mantenimiento->fecha_real = Carbon::now();
            $mantenimiento->save();
            $equipo->ultimo_mantenimiento = $mantenimiento->fecha_real;
            $equipo->proximo_mantenimiento = Carbon::now()->addMonths(6);
            $equipo->save();

            Mantenimiento::create([
                'equipo_id' => $mantenimiento->equipo_id,
                'fecha_programada' => Carbon::now()->addMonths(6),
            ]);
        }else{
            $equipo->proximo_mantenimiento = $mantenimiento->fecha_programada;
            $equipo->save();
        }
        $data = [
            "message" => "Mantenimiento editado",
            "mantenimiento" => $mantenimiento->load('equipo', 'tecnico', 'tareas'),
        ];
        return response()->json($data, 200);
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();
        $data = [
            "message" => "Mantenimiento eliminado"
        ];
        return response()->json($data, 200);
    }
}
