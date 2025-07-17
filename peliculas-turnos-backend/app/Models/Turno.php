<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'sala',
        'estado',
        'pelicula_id',
    ];

    public function pelicula()
    {
        return $this->belongsTo(\App\Models\Pelicula::class);
    }
}
