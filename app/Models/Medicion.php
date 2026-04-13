<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Medicion
 * @package App\Models
 * @version March 24, 2025, 8:07 pm -05
 *
 * @property integer $user_id
 * @property string|\Carbon\Carbon $fecha_medicion
 * @property string $peso
 * @property string $talla
 * @property string $grasa
 * @property string $musculo
 * @property string $perimetro_abdominal
 */
class Medicion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'mediciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'fecha_medicion',
        'peso',
        'talla',
        'grasa',
        'musculo',
        'perimetro_abdominal',
        'ppm_maximo',
        'ppm_minimo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'fecha_medicion' => 'datetime',
        'peso' => 'string',
        'talla' => 'string',
        'grasa' => 'string',
        'musculo' => 'string',
        'perimetro_abdominal' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'fecha_medicion' => 'required',
        'peso' => 'nullable|string|max:255',
        'talla' => 'nullable|string|max:255',
        'grasa' => 'nullable|string|max:255',
        'musculo' => 'nullable|string|max:255',
        'perimetro_abdominal' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
