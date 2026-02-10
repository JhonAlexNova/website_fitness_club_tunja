<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Configuracion
 * @package App\Models
 * @version August 13, 2023, 4:07 am UTC
 *
 * @property string $logo
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property string $correo
 * @property string $nit
 * @property string $razon_social
 */
class Configuracion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'configuracion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tipo_negocio_id',
        'logo',
        'direccion',
        'telefono',
        'celular',
        'correo',
        'nit',
        'razon_social',
        'valor_chico',
        'politicas_de_privacidad',
        'portada_login',
        'acceso',
        "iva",
        'acceso'
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
        'direccion' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:255',
        'correo' => 'nullable|string|max:255',
        'nit' => 'nullable|string|max:255',
        'razon_social' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
