<?php

namespace App\Repositories;

use App\Models\Medicion;
use App\Repositories\BaseRepository;

/**
 * Class MedicionRepository
 * @package App\Repositories
 * @version March 24, 2025, 8:07 pm -05
*/

class MedicionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'fecha_medicion',
        'peso',
        'talla',
        'grasa',
        'musculo',
        'perimetro_abdominal'
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
        return Medicion::class;
    }
}
