<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    public $table = 'tipo_usuario';

    public $fillable = [
        'rol_id',
        'user_id'
    ];
}
