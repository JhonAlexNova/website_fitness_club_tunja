<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Producto
 * @package App\Models
 * @version August 13, 2023, 4:55 am UTC
 *
 * @property \App\Models\Categoria $categoria
 * @property string $nombre
 * @property string $descripcion
 * @property integer $precio
 * @property integer $stock
 * @property string $icono
 * @property integer $categoria_id
 */
class Cierre extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cierre';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'fecha_inicio',
        'fecha_fin',
        'cierre_caja'
    ];


    protected $casts = [

    ];

   
    public static $rules = [
        
    ];


    
}
