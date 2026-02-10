<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Instructor
 * @package App\Models
 * @version October 26, 2024, 10:07 am -05
 *
 * @property \Illuminate\Database\Eloquent\Collection $tipoUsuarios
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
class Instructor extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        "tipo",
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
        'foto_perfil' => 'string|max:255',
        'username' => 'string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'nullable|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:255',
        'estado' => 'required|string',
        'email' => 'required|string|max:255|email|unique:users,email',
        'documento' => 'required|string|max:255|unique:users,documento',
        'email_verified_at' => 'nullable',
        'deleted_at' => 'nullable',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public static $rulesUpdate = [
        'foto_perfil' => 'string|max:255',
        'username' => 'string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'nullable|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:255',
        'estado' => 'required|string',
        'email_verified_at' => 'nullable',
        'deleted_at' => 'nullable',
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

    public function tipo_usuario()
    {
        return $this->hasMany(\App\Models\TipoUsuario::class, 'user_id');
    }
}
