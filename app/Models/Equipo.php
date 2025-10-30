<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'marca',
        'organizacion_id',
        'sistema_operativo',
        'procesador',
        'memoria_ram',
        'almacenamiento',
        'ultimo_mantenimiento',
        'proximo_mantenimiento',
        'estado',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizacion_id');
    }
}
