<?php

namespace App\Repositories;

use App\Models\Transaccion;
use App\Repositories\BaseRepository;

/**
 * Class TransaccionRepository
 * @package App\Repositories
 * @version May 13, 2025, 3:46 pm -05
*/

class TransaccionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amountInCents',
        'createdAt',
        'currency',
        'customerData_fullName',
        'customerData_phoneNumber',
        'customerEmail',
        'id_transaction',
        'paymentMethod_extra_brand',
        'paymentMethod_extra_externalIdentifier',
        'paymentMethod_extra_lastFour',
        'paymentMethod_extra_name',
        'paymentMethod_installments',
        'paymentMethod_type',
        'reference',
        'status'
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
        return Transaccion::class;
    }
}
