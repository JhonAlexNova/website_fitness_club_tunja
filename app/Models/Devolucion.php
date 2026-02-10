<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Devolucion
 * @package App\Models
 * @version September 1, 2023, 8:34 pm -05
 *
 * @property string $tipo
 * @property string|\Carbon\Carbon $fecha
 */
class Devolucion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'devoluciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cierre_id',
        'tipo',
        'fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo' => 'string',
        'fecha' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo' => 'required|string',
        'fecha' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public static function get_tipos(){
        return collect([
            ['tipo'=>'X_DINERO'],
            ['tipo'=>'X_PRODUCTO']
        ]);
    }


    public function detalle_devolucion(){
        return $this->hasOne(DetalleDevolucion::class, 'devolucion_id');
    }

  

    
}
