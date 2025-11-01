<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'marca',
        'organization_id',
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
        return $this->belongsTo(Organization::class);
    }
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
