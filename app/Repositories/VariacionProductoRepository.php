<?php

namespace App\Repositories;

use App\Models\VariacionProducto;
use App\Repositories\BaseRepository;

/**
 * Class VariacionProductoRepository
 * @package App\Repositories
 * @version October 21, 2024, 11:34 am -05
*/

class VariacionProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'valor_caracteristica_id',
        'precio',
        'stock'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return VariacionProducto::class;
    }


    public function withProductoAndCaracteristica($attributes){
        $data = $this->model->with("valor_caracteristica")->where("producto_id",$attributes["producto_id"])
        ->whereHas("valor_caracteristica",function($sql) use($attributes){
            $sql->where("caracteristica_id",$attributes["caracteristica_id"]);
        })
        ->get();

        return $data;
    }
}
