<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StockManilla
 * @package App\Models
 * @version October 22, 2023, 2:16 pm -05
 *
 * @property string $manilla_id
 * @property integer $cantidad_actual
 * @property integer $cantidad_anterior
 * @property integer $cantidad
 */
class StockManilla extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stock_manillas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'manilla_id',
        'cantidad_actual',
        'cantidad_anterior',
        'cantidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'manilla_id' => 'string',
        'cantidad_actual' => 'integer',
        'cantidad_anterior' => 'integer',
        'cantidad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
