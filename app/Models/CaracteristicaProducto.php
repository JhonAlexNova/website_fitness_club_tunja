<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CaracteristicaProducto
 * @package App\Models
 * @version October 21, 2024, 3:32 pm -05
 *
 * @property integer $producto_id
 * @property integer $valor_caracteristica_id
 */
class CaracteristicaProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'caracteristicas_producto';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'caracteristica_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'producto_id' => 'integer',
        'valor_caracteristica_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'producto_id' => 'required|integer',
        'caracteristica_id' => 'required|integer'
    ];

    
}
