<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AsistenciaEmpleado
 * @package App\Models
 * @version November 17, 2023, 10:00 pm -05
 *
 * @property integer $empleado_id
 */
class AsistenciaEmpleado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'asistencia_empleados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'empleado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'empleado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];


    public function empleado(){
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    
}
