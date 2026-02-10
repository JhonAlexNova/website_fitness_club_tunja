<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RutinaEjercicio
 * @package App\Models
 * @version February 9, 2025, 3:29 pm -05
 *
 * @property integer $id_rutina
 * @property integer $id_ejercicio
 * @property integer $repeticiones
 * @property integer $series
 * @property integer $descanso_segundos
 */
class RutinaEjercicio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rutina_ejercicios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_rutina',
        "volumen",
        "intensidad",
        "frecuencia",
        'id_ejercicio',
        'repeticiones',
        'series',
        'descanso_segundos'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_rutina_ejercicio' => 'integer',
        'id_rutina' => 'integer',
        'id_ejercicio' => 'integer',
        'repeticiones' => 'integer',
        'series' => 'integer',
        'descanso_segundos' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_rutina' => 'nullable|integer',
        'id_ejercicio' => 'nullable|integer',
        'repeticiones' => 'nullable|integer',
        'series' => 'nullable|integer',
        'descanso_segundos' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function ejercicio()
    {
        return $this->belongsTo(\App\Models\Ejercicio::class, 'id_ejercicio');
    }

    
}
