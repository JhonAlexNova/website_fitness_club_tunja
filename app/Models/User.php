<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use DB;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'celular',
        'documento',
        'email',
        'password',
        'foto_perfil',
        'tipo',
        'estado',
        'fecha_inscripcion',
        'talla',
        'peso',
        'perimetro_abdominal',
        'porcentaje_grasa',
        'porcentaje_musculo',
        'observaciones',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rol(){
        $rol = DB::table('tipo_usuario as tu')
        ->join('users as u','u.id','tu.user_id')
        ->join('rol as r','r.id','tu.rol_id')
        ->select('r.tipo')
        ->where('u.id',Auth::user()->id)->get()->last();

       //dd($rol, Auth::user()->id);

        if($rol->tipo=='Super Admin'){
            return 'SUPER_ADMIN';
        }else if($rol->tipo=='Admin'){
            return 'ADMIN';
        }else if($rol->tipo=='Empleado'){
            return 'EMPLEADO';
        }


       

        //$user = Auth::user();

    
        

        return $user->tipo;
    }


    public static function rol_id(){
        $rol = DB::table('tipo_usuario as tu')
        ->join('users as u','u.id','tu.user_id')
        ->join('rol as r','r.id','tu.rol_id')
        ->select('r.id')
        ->where('u.id',Auth::user()->id)->get()->last();
        return $rol->id;
    }

    public function puntos()
    {
        return $this->hasMany(Puntos::class, 'user_id');
    }
}
