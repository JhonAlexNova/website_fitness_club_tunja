<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'coffee_category_id'
    ];

    public function coffeeCategory()
    {
        return $this->belongsTo(CoffeeCategory::class);
    }
}