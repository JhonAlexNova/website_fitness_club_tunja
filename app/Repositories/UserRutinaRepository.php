<?php

namespace App\Repositories;

use App\Models\UserRutina;
use App\Repositories\BaseRepository;

/**
 * Class UserRutinaRepository
 * @package App\Repositories
 * @version February 9, 2025, 3:36 pm -05
*/

class UserRutinaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'id_rutina',
        'fecha_inicio',
        'fecha_fin'
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
        return UserRutina::class;
    }
}
