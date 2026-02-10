<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Caracteristica
 * @package App\Models
 * @version October 21, 2024, 10:54 am -05
 *
 * @property string $nombre
 */
class Caracteristica extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'caracteristicas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255'
    ];

    public function valores_caracteristica(){
        return $this->hasMany(ValorCaracteristica::class, "caracteristica_id");
    }

    
}
