<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'categorias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'parent_id',
        'nombre',
        'descripcion',
        'icono'
    ];

    protected $casts = [];

    public static $rules = [
        'nombre'      => 'required|string|max:255',
        'descripcion' => 'nullable|string'
    ];

    // Relación: esta categoría pertenece a una categoría padre
    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }

    // Relación: esta categoría tiene subcategorías hijas
    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'parent_id')->orderBy('nombre', 'ASC');
    }
}