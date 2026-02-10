<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rutina
 * @package App\Models
 * @version February 9, 2025, 2:31 pm -05
 *
 * @property string $nombre_rutina
 * @property string $descripcion
 * @property integer $duracion_semanas
 * @property integer $user_id
 */
class Rutina extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rutinas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    // En Rutina.php (modelo)
    protected $fillable = [
        'nombre_rutina',
        'descripcion',
        'duracion_semanas',
        'user_id',
        'es_general', // <-- nuevo campo
    ];

    protected $casts = [

    ];

    public static $rules = [
        'nombre_rutina' => 'required|string|max:100',
        'descripcion' => 'nullable|string',
        'duracion_semanas' => 'nullable|integer',
        'user_id' => 'nullable',
        'es_general' => 'nullable|boolean', // <-- nueva regla
    ];


    public function ejercicios_rutina()
    {
        return $this->hasMany(\App\Models\RutinaEjercicio::class, 'id_rutina');
    }

    
}
