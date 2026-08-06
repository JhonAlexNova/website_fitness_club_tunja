<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuzonSugerencia extends Model
{
    protected $table = 'buzon_sugerencias';

    protected $fillable = [
        'user_id',
        'tipo',
        'mensaje',
        'estado',
        'respuesta',
        'respondido_at',
    ];

    protected $casts = [
        'respondido_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public static function tipos(): array
    {
        return [
            'problema'       => 'Problema',
            'sugerencia'     => 'Sugerencia',
            'recomendacion'  => 'Recomendación',
            'pregunta'       => 'Pregunta / Duda',
        ];
    }
}