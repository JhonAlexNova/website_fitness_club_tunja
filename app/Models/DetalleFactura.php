<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleFactura extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'detalle_facturas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'factura_id',
        'precio_id',
        'producto_id',
        "servicio_id",
        "membresia_id",
        "pasadia_id",
        "clase_id",
        'cantidad',
        'total'
    ];

    protected $casts = [
        'id'         => 'integer',
        'factura_id' => 'integer',
        'precio_id'  => 'integer',
        'producto_id'=> 'integer',
        'cantidad'   => 'string',
        'total'      => 'string'
    ];

    public static $rules = [
        'factura_id' => 'required|integer',
        'cantidad'   => 'required|string|max:255',
        'total'      => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    // ── Relación agregada: necesaria para el whereHas() en ReservaController ──
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }

    public function pasadia()
    {
        return $this->belongsTo(Pasadia::class, 'pasadia_id');
    }
}