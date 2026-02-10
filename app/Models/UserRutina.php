<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserRutina
 * @package App\Models
 * @version February 9, 2025, 3:36 pm -05
 *
 * @property integer $user_id
 * @property integer $id_rutina
 * @property string $fecha_inicio
 * @property string $fecha_fin
 */
class UserRutina extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'users_rutinas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'id_rutina',
        'fecha_inicio',
        'fecha_fin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'id_rutina' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'id_rutina' => 'nullable|integer',
        'fecha_inicio' => 'nullable',
        'fecha_fin' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
