<?php

namespace App\Repositories;

use App\Models\Descuadre;
use App\Repositories\BaseRepository;

/**
 * Class DescuadreRepository
 * @package App\Repositories
 * @version November 24, 2023, 4:15 pm -05
*/

class DescuadreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id'
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
        return Descuadre::class;
    }
}
