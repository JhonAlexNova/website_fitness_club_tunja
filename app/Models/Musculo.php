<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Musculo extends Model
{
    use SoftDeletes;

    protected $table = 'musculos';

    protected $fillable = ['nombre', 'categoria', 'imagen', 'modelo_3d'];


    public static $rules = [
        'nombre' => 'required|string|max:100|unique:musculos,nombre'
    ];

    public function ejercicios()
    {
        return $this->belongsToMany(
            Ejercicio::class,
            'ejercicio_musculo'
        )->withPivot('es_principal')
        ->withTimestamps();
    }
}
