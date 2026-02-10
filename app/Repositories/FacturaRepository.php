<?php

namespace App\Repositories;

use App\Models\Factura;
use App\Repositories\BaseRepository;
use App\Repositories\ProductoRepository;



class FacturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'empleado_id',
        'total'
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
        return Factura::class;
    }

    public function withRelations()
    {
        $data = $this->model->with("detalles_facturas","empleado","detalles_facturas.producto")->get();
        return $data;
    }
}
