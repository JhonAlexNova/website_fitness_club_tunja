<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BaseEmpleado
 * @package App\Models
 * @version August 20, 2023, 3:29 pm UTC
 *
 * @property \App\Models\User $empleado
 * @property integer $empleado_id
 * @property string $valor
 */
class BaseEmpleado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'base_empleados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'empleado_id',
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
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'empleado_id' => 'required|integer',
        'valor' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empleado()
    {
        return $this->belongsTo(\App\Models\User::class, 'empleado_id');
    }
}
