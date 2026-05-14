<?php
// ============================================================
// App\Models\SesionEntrenamiento
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SesionEntrenamiento extends Model
{
    use SoftDeletes;

    protected $table = 'sesiones_entrenamiento';

    protected $fillable = [
        'id_rutina',
        'id_user',
        'iniciada_at',
        'finalizada_at',
        'duracion_minutos',
        'notas',
    ];

    protected $casts = [
        'iniciada_at'   => 'datetime',
        'finalizada_at' => 'datetime',
    ];

    public function rutina()
    {
        return $this->belongsTo(Rutina::class, 'id_rutina');
    }

    public function series()
    {
        return $this->hasMany(SerieCompletada::class, 'id_sesion');
    }
}