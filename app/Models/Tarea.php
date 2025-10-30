<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function mantenimientos()
    {
        return $this->belongsToMany(Mantenimiento::class, 'mantenimiento_tarea')
            ->withPivot(['estado', 'observaciones'])
            ->withTimestamps();
    }
}
