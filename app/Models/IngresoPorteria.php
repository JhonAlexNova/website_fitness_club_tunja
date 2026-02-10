<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class IngresoPorteria
 * @package App\Models
 * @version October 20, 2023, 12:53 pm -05
 *
 * @property integer $cliente_id
 * @property integer $manilla_id
 * @property string $valor
 */
class IngresoPorteria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ingreso_porteria';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cliente_id',
        'manilla_id',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cliente_id' => 'integer',
        'manilla_id' => 'integer',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cliente_id' => 'required|integer',
        'manilla_id' => 'required|integer',
        'valor' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    
}
