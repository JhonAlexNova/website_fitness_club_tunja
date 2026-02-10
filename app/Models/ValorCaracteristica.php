<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ValorCaracteristica
 * @package App\Models
 * @version October 21, 2024, 11:00 am -05
 *
 * @property \App\Models\Caracteristica $caracteristica
 * @property integer $caracteristica_id
 * @property string $valor
 */
class ValorCaracteristica extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'valores_caracteristicas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'caracteristica_id',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'caracteristica_id' => 'integer',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'caracteristica_id' => 'required|integer',
        'valor' => 'required|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function caracteristica()
    {
        return $this->belongsTo(\App\Models\Caracteristica::class, 'caracteristica_id');
    }
}
