<?php

namespace App\Repositories;

use App\Models\ValorCaracteristica;
use App\Repositories\BaseRepository;

/**
 * Class ValorCaracteristicaRepository
 * @package App\Repositories
 * @version October 21, 2024, 11:00 am -05
*/

class ValorCaracteristicaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'caracteristica_id',
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
        return ValorCaracteristica::class;
    }

    public function withRelations(){
        return $this->model->get();
    }
}
