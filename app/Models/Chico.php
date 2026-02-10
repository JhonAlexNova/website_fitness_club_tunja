<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Chico
 * @package App\Models
 * @version August 21, 2023, 5:56 pm UTC
 *
 * @property integer $empleado_id
 * @property string $cantidad
 * @property string $valor
 */
class Chico extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'chicos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cierre_id',
        'empleado_id',
        'cantidad',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'empleado_id' => 'integer',
        'cantidad' => 'string',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'empleado_id' => 'required|integer',
        'cantidad' => 'required|string|max:255',
        'valor' => 'required|string|max:255'
    ];


    public function empleado(){
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    
}
