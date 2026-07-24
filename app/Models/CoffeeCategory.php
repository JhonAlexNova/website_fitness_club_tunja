<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'orden',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function coffeeProducts()
    {
        return $this->hasMany(CoffeeProduct::class);
    }
}