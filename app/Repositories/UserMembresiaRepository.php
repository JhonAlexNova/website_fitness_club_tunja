<?php

namespace App\Repositories;

use App\Models\UserMembresia;
use App\Repositories\BaseRepository;

/**
 * Class UserMembresiaRepository
 * @package App\Repositories
 * @version October 27, 2024, 6:05 pm -05
*/

class UserMembresiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'membresia_id',
        'fecha_inicio',
        'fecha_vencimiento',
        'estado'
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
        return UserMembresia::class;
    }

    public function withRelations(){
        $data = $this->model->with(["user","membresia"])->get();

        return $data;
    }
}
