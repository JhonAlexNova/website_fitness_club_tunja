<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ManillaEntrada
 * @package App\Models
 * @version October 19, 2023, 4:24 pm -05
 *
 * @property string $precio_full
 * @property string $precio_reducido
 * @property time $hora_corte
 */
class ManillaEntrada extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'manilla_entradas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'precio_full',
        'precio_reducido',
        'hora_corte'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'precio_full' => 'string',
        'precio_reducido' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'precio_full' => 'required|string|max:255',
        'precio_reducido' => 'required|string|max:255',
        'hora_corte' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    
    public function stock_manilla()
    {
        return $this->hasOne(StockManilla::class, 'manilla_id','id')
        ->orderBy('id', 'desc')
        ->latest();
    }

    
}
