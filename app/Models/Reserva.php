<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Reserva
 * @package App\Models
 * @version October 26, 2024, 10:06 am -05
 *
 * @property string $nombre
 * @property string $descripcion
 */
class Reserva extends Model
{
    protected $fillable = [
        'usuario_id',
        'horario_clase_id',
        'tipo_clase', // 'unica' o 'recurrente'
        "estado"
    ];

    public function horarioClaseUnica()
    {
        return $this->belongsTo(HorarioClaseUnica::class, 'horario_clase_id');
    }

    public function claseRecurrente()
    {
        return $this->belongsTo(ClaseRecurrente::class, 'horario_clase_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class); // Suponiendo que tienes un modelo Usuario
    }
}
