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
        'avatar',
        'estado',
        'fecha_inscripcion',
        'talla',
        'peso',
        'perimetro_abdominal',
        'porcentaje_grasa',
        'porcentaje_musculo',
        'observaciones',
        'fecha_inscripcion'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rol()
    {
        $rol = DB::table('tipo_usuario as tu')
            ->join('users as u', 'u.id', 'tu.user_id')
            ->join('rol as r', 'r.id', 'tu.rol_id')
            ->select('r.tipo')
            ->where('u.id', Auth::user()->id)
            ->get()
            ->last();

        if (!$rol) {
            return 'SIN_ROL';
        }

        if ($rol->tipo == 'Super Admin') {
            return 'SUPER_ADMIN';
        } else if ($rol->tipo == 'Admin') {
            return 'ADMIN';
        } else if ($rol->tipo == 'Empleado') {
            return 'EMPLEADO';
        }

        return 'SIN_ROL';
    }

    public static function rol_id()
    {
        $rol = DB::table('tipo_usuario as tu')
            ->join('users as u', 'u.id', 'tu.user_id')
            ->join('rol as r', 'r.id', 'tu.rol_id')
            ->select('r.id')
            ->where('u.id', Auth::user()->id)
            ->get()
            ->last();

        if (!$rol) {
            return null;
        }

        return $rol->id;
    }

    public function puntos()
    {
        return $this->hasMany(Puntos::class, 'user_id');
    }

    public function membresiaActiva()
    {
        return $this->hasOne(\App\Models\UserMembresia::class, 'user_id')
            ->where('estado', 'activa')
            ->latest();
    }
}