<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
