<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloTipoNegocio extends Model
{
    use HasFactory;

    public $table = 'modulos_tipo_negocio';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tipo_negocio_id',
        'modulo_id'
    ];

    
}
