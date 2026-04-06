<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membresia extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'membresias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'costo',
        'duracion',
        'tipo_duracion',
        'imagen'
    ];

    protected $appends = ['imagen_url'];

    protected $casts = [
        'id'             => 'integer',
        'nombre'         => 'string',
        'descripcion'    => 'string',
        'costo'          => 'integer',
        'duracion'       => 'integer',
        'tipo_duracion'  => 'string',
        'imagen'         => 'string'
    ];

    public static $rules = [
        'nombre'         => 'required|string|max:50',
        'descripcion'    => 'nullable|string',
        'costo'          => 'required|integer|min:0',
        'duracion'       => 'required|integer|min:1',
        'tipo_duracion'  => 'required|in:dias,meses',
        'imagen'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'created_at'     => 'nullable',
        'updated_at'     => 'nullable',
        'deleted_at'     => 'nullable'
    ];

    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return url('images/membresias/' . $this->imagen);
        }
        return null;
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicios_membresia');
    }

    public function getDuracionCompletaAttribute()
    {
        return $this->duracion . ' ' . $this->tipo_duracion;
    }
}