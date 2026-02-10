<?php

namespace App\Repositories;

use App\Models\Clase;
use App\Repositories\BaseRepository;

/**
 * Class ClaseRepository
 * @package App\Repositories
 * @version October 26, 2024, 10:06 am -05
*/

class ClaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
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
        return Clase::class;
    }
}
