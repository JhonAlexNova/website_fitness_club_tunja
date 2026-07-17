<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'user_id',
        'titulo',
        'mensaje',
        'leida',
        'tipo',
        'referencia_tabla',
        'referencia_id',
        'enlace',
        'es_admin',
    ];

    protected $casts = [
        'leida'    => 'boolean',
        'es_admin' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Notificaciones dirigidas al panel de administración (no a un usuario de la app).
     */
    public function scopeAdmin($query)
    {
        return $query->where('es_admin', true);
    }

    public function scopeNoLeidas($query)
    {
        return $query->where('leida', false);
    }

    /**
     * Notificaciones no leídas relacionadas a una tabla específica (facturas, pagos, etc.)
     */
    public function scopeDeTabla($query, string $tabla)
    {
        return $query->where('referencia_tabla', $tabla);
    }
}