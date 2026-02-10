<?php

namespace App\Repositories;

use App\Models\HistorialProducto;
use App\Repositories\BaseRepository;

/**
 * Class HistorialProductoRepository
 * @package App\Repositories
 * @version August 20, 2023, 1:43 pm UTC
*/

class HistorialProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'cantidad',
        'cantidad_anterior',
        'cantidad_actual'
    ];


    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HistorialProducto::class;
    }


    public function updateStockProducto(){

    }
}
