<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieCompletada extends Model
{
    protected $table = 'series_completadas';

    protected $fillable = [
        'id_sesion',
        'id_rutina_ejercicio',
        'numero_serie',
        'repeticiones_realizadas',
        'peso_utilizado',
        'completada',
    ];

    protected $casts = [
        'completada' => 'boolean',
    ];

    public function sesion()
    {
        return $this->belongsTo(SesionEntrenamiento::class, 'id_sesion');
    }

    public function rutinaEjercicio()
    {
        return $this->belongsTo(RutinaEjercicio::class, 'id_rutina_ejercicio');
    }
}