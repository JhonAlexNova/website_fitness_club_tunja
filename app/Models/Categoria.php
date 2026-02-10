<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Categoria
 * @package App\Models
 * @version August 13, 2023, 4:43 am UTC
 *
 * @property string $nombre
 * @property string $descripcion
 * @property string $icono
 */
class Categoria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'categorias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        "parent_id",
        'nombre',
        'descripcion',
        'icono'
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
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string'
    ];

    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }

}
