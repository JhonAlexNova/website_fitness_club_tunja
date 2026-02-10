<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HorarioClaseUnica
 * @package App\Models
 * @version October 26, 2024, 10:19 am -05
 *
 * @property integer $clase_id
 * @property integer $instructor_id
 * @property string|\Carbon\Carbon $fecha_hora
 * @property integer $cupo_maximo
 * @property integer $cupos_disponibles
 */
class HorarioClaseUnica extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'horarios_clases_unicas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'clase_id',
        'instructor_id',
        'fecha_hora',
        'cupo_maximo',
        'cupos_disponibles'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clase_id' => 'integer',
        'instructor_id' => 'integer',
        'fecha_hora' => 'datetime',
        'cupo_maximo' => 'integer',
        'cupos_disponibles' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clase_id' => 'required|integer',
        'instructor_id' => 'required|integer',
        'fecha_hora' => 'required',
        'cupo_maximo' => 'nullable|integer',
        'cupos_disponibles' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    
}
