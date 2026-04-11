<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'facturas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        "referencia",
        "user_id",
        "tipo",
        "tipo_pago",
        "total",
        "estado",
        "comentario",
        "cantidad_puntos",
        "valor_puntos",
        "comprobante"
    ];

    public static $rules = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }
}