<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HistorialPrecioProducto
 * @package App\Models
 * @version August 17, 2023, 2:54 am UTC
 *
 * @property integer $producto_id
 * @property string $precio
 * @property string $fecha_actualizacion
 */
class HistorialPrecioProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'historial_precio_producto';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'valor',
        'precio_venta',
        'fecha_actualizacion'
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
        'precio' => 'required|string|max:32',
        'fecha_actualizacion' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
