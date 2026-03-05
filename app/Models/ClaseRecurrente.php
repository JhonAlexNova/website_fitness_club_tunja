<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClaseRecurrente
 * @package App\Models
 * @version October 26, 2024, 10:20 am -05
 *
 * @property integer $clase_id
 * @property integer $instructor_id
 * @property boolean $dia_semana
 * @property time $hora
 * @property integer $duracion
 * @property integer $cupo_maximo
 */
class ClaseRecurrente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clases_recurrentes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'clase_id',
        'instructor_id',
        'dia_semana',
        'hora',
        'duracion',
        'cupo_maximo'
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
        'clase_id' => 'required|integer',
        'hora' => 'required',
        'duracion' => 'required|integer',
        'cupo_maximo' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function clase()
    {
        return $this->belongsTo(Clase::class)->withTrashed();
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    
}
