<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pago
 * @package App\Models
 * @version September 6, 2023, 9:41 pm -05
 *
 * @property integer $tipo_id
 * @property integer $valor
 */
class Pago extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'pagos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cierre_id',
        'tipo_id',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_id' => 'integer',
        'valor' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_id' => 'required|integer',
        'valor' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
    public function metodo_pago(){
        return $this->belongsTo(\App\Models\MetodoPago::class, 'tipo_id');
    }
    
}
