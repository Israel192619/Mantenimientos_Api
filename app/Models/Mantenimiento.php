<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $fillable = [
        'fecha_programada',
        'fecha_real',
        'equipo_id',
        'tecnico_id',
        'observaciones',
        'estado',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'mantenimiento_tarea')
            ->withTimestamps();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
