<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Descuadre
 * @package App\Models
 * @version November 24, 2023, 4:15 pm -05
 *
 * @property integer $producto_id
 */
class Descuadre extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'descuadres';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'producto_id',
        'cantidad',
        'valor',
        'tipo'
    ];

    
    protected $casts = [
        'id' => 'integer',
        'producto_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'producto_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
