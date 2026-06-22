<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasadia extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'pasadias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'costo',
        'imagen'
    ];

    protected $appends = ['imagen_url'];

    protected $casts = [
        'id'          => 'integer',
        'nombre'      => 'string',
        'descripcion' => 'string',
        'costo'       => 'integer',
        'imagen'      => 'string'
    ];

    public static $rules = [
        'nombre'      => 'required|string|max:50',
        'descripcion' => 'nullable|string',
        'costo'       => 'required|integer|min:0',
        'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:25000',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable'
    ];

    public function getImagenUrlAttribute(): ?string
    {
        return $this->imagen
            ? url('/storage/' . $this->imagen)
            : null;
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicios_pasadia');
    }
}