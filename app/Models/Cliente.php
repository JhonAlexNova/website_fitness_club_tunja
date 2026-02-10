<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cliente
 * @package App\Models
 * @version October 27, 2024, 8:30 am -05
 *
 * @property \Illuminate\Database\Eloquent\Collection $tipoUsuarios
 * @property string $fecha_inscripcion
 * @property number $talla
 * @property string $correo
 * @property number $perimetro_abdominal
 * @property number $porcentaje_grasa
 * @property number $porcentaje_musculo
 * @property string $observaciones
 * @property string $tipo
 * @property string $foto_perfil
 * @property string $username
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $celular
 * @property string $estado
 * @property string $email
 * @property string $documento
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 */
class Cliente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at',"fecha_inscripcion"];



    public $fillable = [
        'fecha_inscripcion',
        "peso",
        'talla',
        'correo',
        'perimetro_abdominal',
        'porcentaje_grasa',
        'porcentaje_musculo',
        'observaciones',
        'tipo',
        'foto_perfil',
        'username',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'celular',
        'estado',
        'email',
        'documento',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha_inscripcion' => 'date',
        'talla' => 'decimal:1',
        'correo' => 'string',
        'perimetro_abdominal' => 'decimal:2',
        'porcentaje_grasa' => 'decimal:2',
        'porcentaje_musculo' => 'decimal:2',
        'observaciones' => 'string',
        'tipo' => 'string',
        'foto_perfil' => 'string',
        'username' => 'string',
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string',
        'segundo_apellido' => 'string',
        'celular' => 'string',
        'estado' => 'string',
        'email' => 'string',
        'documento' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha_inscripcion' => 'nullable',
        'talla' => 'nullable|numeric',
        'correo' => 'nullable|string|max:100',
        'perimetro_abdominal' => 'nullable|numeric',
        'porcentaje_grasa' => 'nullable|numeric',
        'porcentaje_musculo' => 'nullable|numeric',
        'observaciones' => 'nullable|string',
        'username' => 'nullable|string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'nullable|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:255',
        'estado' => 'required|string',
        'email' => 'required|string|max:255',
        'documento' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'deleted_at' => 'nullable',
        'password' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tipoUsuarios()
    {
        return $this->hasMany(\App\Models\TipoUsuario::class, 'user_id');
    }
}
