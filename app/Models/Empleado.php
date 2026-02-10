<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Empleado
 * @package App\Models
 * @version August 13, 2023, 4:40 am UTC
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
class Empleado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'nullable|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:255',
        'estado' => 'required|string',
        'email' => 'required|string|max:255',
        'documento' => 'required|string|max:255'
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
