<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Clase
 * @package App\Models
 * @version October 26, 2024, 10:06 am -05
 *
 * @property string $nombre
 * @property string $descripcion
 */
class Clase extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clases';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'descripcion',
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
        'nombre' => 'required|string|max:100',
        'descripcion' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function horariosUnicas()
    {
        return $this->hasMany(HorarioClaseUnica::class);
    }

    public function clasesRecurrentes()
    {
        return $this->hasMany(ClaseRecurrente::class);
    }

    
}
