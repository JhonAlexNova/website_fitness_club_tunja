<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloApp extends Model
{
    use HasFactory;

    public $table = 'modulos_app';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre'
    ];


    public function modulos_tipo_negocio(){
        return $this->hasMany(ModuloTipoNegocio::class, 'tipo_negocio_id');
    }

    
}
