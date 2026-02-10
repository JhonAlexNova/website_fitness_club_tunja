<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Factura
 * @package App\Models
 * @version August 21, 2023, 3:56 pm UTC
 *
 * @property string $id
 * @property integer $empleado_id
 * @property string $total
 */
class Factura extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'facturas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        "referencia",
        "user_id",
        "tipo",
        "total",
        "estado",
        "cantidad_puntos",
        "valor_puntos",
        "comprobante"
    ];

    
    protected $casts = [
       
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    /* public function detalles_facturas(){
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function empleado(){
        return $this->belongsTo(User::class, 'empleado_id');
    } */

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
