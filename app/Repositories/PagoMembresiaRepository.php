<?php

namespace App\Repositories;

use App\Models\PagoMembresia;
use App\Repositories\BaseRepository;

/**
 * Class PagoMembresiaRepository
 * @package App\Repositories
 * @version October 27, 2024, 6:09 pm -05
*/

class PagoMembresiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_membresia_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
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
        return PagoMembresia::class;
    }
}
