<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnicos';

    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'especialidad',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
