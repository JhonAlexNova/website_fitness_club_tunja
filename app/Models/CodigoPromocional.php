<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoPromocional extends Model
{
    protected $table = 'codigos_promocionales';

    protected $fillable = [
        'codigo',
        'creador',
        'activo',
        'usos',
        'max_usos',
        'fecha_expiracion',
    ];

    protected $casts = [
        'activo'           => 'boolean',
        'fecha_expiracion' => 'date',
    ];

    public function esValido(): bool
    {
        if (!$this->activo) return false;
        if ($this->max_usos !== null && $this->usos >= $this->max_usos) return false;
        if ($this->fecha_expiracion && $this->fecha_expiracion->isPast()) return false;
        return true;
    }
}