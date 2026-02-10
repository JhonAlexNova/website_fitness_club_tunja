<?php

namespace App\Repositories;

use App\Models\Gasto;
use App\Repositories\BaseRepository;

/**
 * Class GastoRepository
 * @package App\Repositories
 * @version September 7, 2023, 11:19 pm -05
*/

class GastoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concepto',
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
        return Gasto::class;
    }
}
