<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserMembresia
 * @package App\Models
 * @version October 27, 2024, 6:05 pm -05
 *
 * @property integer $user_id
 * @property integer $membresia_id
 * @property string $fecha_inicio
 * @property string $fecha_vencimiento
 * @property string $estado
 */
class UserMembresia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'usuario_membresias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'membresia_id',
        'fecha_inicio',
        'fecha_vencimiento',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'membresia_id' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_vencimiento' => 'date',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'membresia_id' => 'required|integer',
        'fecha_inicio' => 'required',
        'fecha_vencimiento' => 'required',
        'estado' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function membresia(){
        return $this->belongsTo(Membresia::class, "membresia_id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    
}
