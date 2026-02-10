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
class Producto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        "url",
        'nombre',
        'descripcion',
        'precio_venta',
        'icono',
        'categoria_id',
        'sku'
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
        'descripcion' => 'nullable|string',
        'icono' => 'nullable|string|max:255',
        'categoria_id' => 'required|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function historial_precio()
    {
        return $this->hasOne(HistorialPrecioProducto::class, 'producto_id','id')
        ->orderBy('id', 'desc')
        ->latest();
    }


    public function historial_producto()
    {
        return $this->hasOne(HistorialProducto::class, 'producto_id','id')
        ->orderBy('id', 'desc')
        ->latest();
    }

    public function caracteristicas_producto(){
        return $this->hasMany(CaracteristicaProducto::class, "producto_id");
    }


    public function portada()
    {
        return $this->hasOne(ImagenProducto::class, 'producto_id')->where('es_portada', true);
    }

    // Relación uno a muchos para la galería de imágenes
    public function galeria()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id')->where('es_portada', false);
    }

    
}
