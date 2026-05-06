<?php
// app/Models/RutinaDiariaElite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinaDiariaElite extends Model
{
    use HasFactory;

    protected $table = 'rutinas_diarias_elite';

    protected $fillable = [
        'titulo',
        'descripcion',
        'dia_semana',
        'fecha',
        'video_url',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function getVideoUrlAttribute($value): ?string
    {
        if (!$value) return null;
        return asset('storage/' . $value);
    }

    public static function diasSemana(): array
    {
        return ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    }
}