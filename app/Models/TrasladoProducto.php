<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TrasladoProducto
 * @package App\Models
 * @version October 28, 2023, 8:25 pm -05
 *
 * @property string $negocio_origen_id
 * @property string $negocio_destino_id
 */
class TrasladoProducto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'traslado_productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'negocio_destino_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       
    ];

    
}
