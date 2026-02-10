<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PagoMembresia
 * @package App\Models
 * @version October 27, 2024, 6:09 pm -05
 *
 * @property integer $user_membresia_id
 * @property number $monto
 * @property string|\Carbon\Carbon $fecha_pago
 * @property string $metodo_pago
 * @property string $estado
 */
class PagoMembresia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'pagos_membresias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_membresia_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_membresia_id' => 'integer',
        'monto' => 'decimal:2',
        'fecha_pago' => 'datetime',
        'metodo_pago' => 'string',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_membresia_id' => 'required|integer',
        'monto' => 'required|numeric',
        'fecha_pago' => 'nullable',
        'metodo_pago' => 'required|string',
        'estado' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
