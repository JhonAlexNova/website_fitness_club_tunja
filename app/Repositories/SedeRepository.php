<?php

namespace App\Repositories;

use App\Models\Sede;
use App\Repositories\BaseRepository;

/**
 * Class SedeRepository
 * @package App\Repositories
 * @version August 14, 2023, 12:30 am UTC
*/

class SedeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'razon_social',
        'telefono',
        'direccion'
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
        return Sede::class;
    }
}
