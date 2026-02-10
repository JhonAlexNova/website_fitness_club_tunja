<?php

namespace App\Repositories;

use App\Models\Caracteristica;
use App\Repositories\BaseRepository;

/**
 * Class CaracteristicaRepository
 * @package App\Repositories
 * @version October 21, 2024, 10:54 am -05
*/

class CaracteristicaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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
        return Caracteristica::class;
    }

    public function withRelations($id=null){
        return $this->model->with("valores_caracteristica")->get();
    }
}
