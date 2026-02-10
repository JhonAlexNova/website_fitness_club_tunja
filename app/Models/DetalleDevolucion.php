<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DetalleDevolucion
 * @package App\Models
 * @version September 3, 2023, 8:01 am -05
 *
 * @property integer $id
 * @property integer $devolucion_id
 * @property integer $producto_id
 * @property integer $cantidad_unidades_devolucion
 * @property integer $valor_unit_de_cambio
 * @property integer $total_devuelto
 * @property integer $total_ganancia
 * @property string|\Carbon\Carbon $createt_at
 */
class DetalleDevolucion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'detalle_devolucion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'devolucion_id',
        'producto_id',
        'producto_cambio_id',
        'cantidad_unidades_devolucion',
        'valor_unit_de_cambio',
        'total_devuelto',
        'dinero_adicional',
        'total_ganancia',
        'createt_at'
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
        'devolucion_id' => 'required|integer',
        'producto_id' => 'required|integer',
        'cantidad_unidades_devolucion' => 'required|integer',
        'valor_unit_de_cambio' => 'required|integer',
        'total_devuelto' => 'required|integer',
        'total_ganancia' => 'required|integer',
        'createt_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id','id');
    }

    public function producto_cambio(){
        return $this->belongsTo(Producto::class, 'producto_cambio_id');
    }

    
    
}
