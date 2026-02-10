<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VariacionProducto
 * @package App\Models
 * @version October 21, 2024, 11:34 am -05
 *
 * @property integer $producto_id
 * @property integer $valor_caracteristica_id
 * @property number $precio
 * @property integer $stock
 */
class VariacionProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'variaciones_productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'producto_id',
        'valor_caracteristica_id',
        'precio',
        'stock'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'producto_id' => 'integer',
        'valor_caracteristica_id' => 'integer',
        'precio' => 'decimal:2',
        'stock' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'producto_id' => 'required|integer',
        'valor_caracteristica_id' => 'required|integer',
        'precio' => 'required|numeric',
        'stock' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function valor_caracteristica(){
        return $this->belongsTo(ValorCaracteristica::class, "valor_caracteristica_id");
    }

    
}
