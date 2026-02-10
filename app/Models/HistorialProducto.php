<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HistorialProducto
 * @package App\Models
 * @version August 20, 2023, 1:43 pm UTC
 *
 * @property \App\Models\Producto $producto
 * @property integer $producto_id
 * @property string $cantidad
 * @property string $cantidad_anterior
 * @property string $cantidad_actual
 */
class HistorialProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'historial_productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'cantidad',
        'cantidad_anterior',
        'cantidad_actual',
        'precio_entrada',
        "tipo",
        "cambio_producto_id",
        "traslado_producto_id"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
       
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'producto_id' => 'required|integer',
        'cantidad' => 'required|string|max:255',
        'cantidad_anterior' => 'required|string|max:255',
        'cantidad_actual' => 'required|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'producto_id');
    }
}
