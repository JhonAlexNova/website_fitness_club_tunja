<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ImagenProducto
 * @package App\Models
 * @version November 3, 2024, 7:57 pm -05
 *
 * @property integer $producto_id
 * @property string $url
 * @property boolean $es_portada
 */
class ImagenProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'imagenes_productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'url',
        'es_portada'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'producto_id' => 'integer',
        'url' => 'string',
        'es_portada' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'producto_id' => 'required|integer',
        'url' => 'required|string|max:255',
        'es_portada' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
