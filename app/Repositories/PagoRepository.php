<?php

namespace App\Repositories;

use App\Models\Pago;
use App\Models\Cierre;
use App\Repositories\BaseRepository;

/**
 * Class PagoRepository
 * @package App\Repositories
 * @version September 6, 2023, 9:41 pm -05
*/

class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_id',
        'valor'
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
        return Pago::class;
    }

    public function withRelations()
    {
        $cierre = Cierre::get()->last();

        $data = [];

        if(is_null($cierre->fecha_fin)){
            $data = $this->model->with('metodo_pago')
            ->whereBetween('created_at',[$cierre->fecha_inicio, date('Y-m-d H:i:s')])
            ->get();
        }
        

        return $data;
    }
    
}
