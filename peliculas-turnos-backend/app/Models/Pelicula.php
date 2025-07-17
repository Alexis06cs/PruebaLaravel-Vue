<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
 
protected $fillable = ['titulo', 'descripcion', 'duracion', 'genero', 'fecha_estreno'];

    public function turnos()
    {
        return $this->hasMany(\App\Models\Turno::class);
    }


}
