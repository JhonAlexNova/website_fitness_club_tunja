<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    public $table = 'permisos_modulos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'modulo_id',
        'roles_id',
        'estado'
    ];

    public function modulo(){
        return $this->belongsTo(ModuloApp::class, 'modulo_id');
    }
}
