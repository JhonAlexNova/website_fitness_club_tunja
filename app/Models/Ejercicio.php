<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ejercicio
 * @package App\Models
 * @version February 9, 2025, 2:10 pm -05
 *
 * @property string $nombre_ejercicio
 * @property string $musculo_objetivo
 * @property string $equipo
 * @property string $nivel_dificultad
 * @property string $video_url
 */
class Ejercicio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ejercicios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre_ejercicio',
        'musculo_objetivo',
        'equipo',
        'nivel_dificultad',
        'video_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre_ejercicio' => 'string',
        'musculo_objetivo' => 'string',
        'equipo' => 'string',
        'nivel_dificultad' => 'string',
        'video_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre_ejercicio' => 'required|string|max:100',
        'musculo_objetivo' => 'nullable|string|max:50',
        'equipo' => 'nullable|string|max:50',
        'nivel_dificultad' => 'nullable|string',
        'video_url' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function ejercicios_rutinas()
    {
        return $this->hasMany(RutinaEjercicio::class, 'id_ejercicio');
    }
    
    public function musculos()
    {
        return $this->belongsToMany(
            Musculo::class,
            'ejercicio_musculo'
        )->withPivot('es_principal')
        ->withTimestamps();
    }
    
}
