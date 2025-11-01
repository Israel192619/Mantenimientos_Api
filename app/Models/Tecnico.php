<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
