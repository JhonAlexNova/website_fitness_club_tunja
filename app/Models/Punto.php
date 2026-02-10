<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Punto
 * @package App\Models
 * @version May 11, 2025, 7:51 pm -05
 *
 * @property integer $user_id
 * @property string $tipo_punto
 * @property string $descripcion
 * @property integer $puntos
 */
class Punto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'puntos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'tipo_punto',
        'descripcion',
        'puntos'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'tipo_punto' => 'string',
        'descripcion' => 'string',
        'puntos' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'tipo_punto' => 'nullable|string|max:20',
        'descripcion' => 'nullable|string',
        'puntos' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
