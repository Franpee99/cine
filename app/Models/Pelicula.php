<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

    public function proyecciones()
    {
        return $this->hasMany(Proyeccion::class);
    }

    protected $fillable = (['titulo']);
}
