<?php

namespace App\Repositories;

use App\Models\MetodoPago;
use App\Repositories\BaseRepository;

/**
 * Class MetodoPagoRepository
 * @package App\Repositories
 * @version September 6, 2023, 9:36 pm -05
*/

class MetodoPagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo'
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
        return MetodoPago::class;
    }
}
