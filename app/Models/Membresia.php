<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Membresia
 * @package App\Models
 * @version October 27, 2024, 6:02 pm -05
 *
 * @property string $nombre
 * @property string $descripcion
 * @property integer $costo
 * @property integer $duracion
 */
class Membresia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'membresias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'descripcion',
        'costo',
        'duracion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'costo' => 'integer',
        'duracion' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:50',
        'descripcion' => 'nullable|string',
        'costo' => 'required|integer',
        'duracion' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicios_membresia');
    }

    
}
