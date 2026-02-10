<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DetalleFactura
 * @package App\Models
 * @version August 21, 2023, 4:47 pm UTC
 *
 * @property integer $factura_id
 * @property integer $precio_id
 * @property integer $producto_id
 * @property string $cantidad
 * @property string $total
 */
class DetalleFactura extends Model
{
    use SoftDeletes;

    use HasFactory;

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
        "clase_id",
        'cantidad',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'factura_id' => 'integer',
        'precio_id' => 'integer',
        'producto_id' => 'integer',
        'cantidad' => 'string',
        'total' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factura_id' => 'required|integer',
        'precio_id' => 'required|integer',
        'producto_id' => 'required|integer',
        'cantidad' => 'required|string|max:255',
        'total' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    
}
