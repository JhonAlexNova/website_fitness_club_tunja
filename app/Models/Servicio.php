<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Servicio
 * @package App\Models
 * @version May 7, 2025, 2:44 pm -05
 *
 * @property string $nombre
 * @property integer $valor
 */
class Servicio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'servicios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'valor',
        "tipo"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'valor' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:64',
        'valor' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function membresias()
    {
        return $this->belongsToMany(Membresia::class, 'servicio_membresia');
    }

    
}
