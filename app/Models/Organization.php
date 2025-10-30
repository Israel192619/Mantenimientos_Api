<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'nombre',
        'description',
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'organizacion_id');
    }
}
