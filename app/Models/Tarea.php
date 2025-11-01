<?php

namespace App\Models;

use Carbon\Carbon;
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
            ->withTimestamps();
    }
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
