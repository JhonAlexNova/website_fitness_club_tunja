<?php

namespace App\Repositories;

use App\Models\StockManilla;
use App\Repositories\BaseRepository;

/**
 * Class StockManillaRepository
 * @package App\Repositories
 * @version October 22, 2023, 2:16 pm -05
*/

class StockManillaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'manilla_id',
        'cantidad_actual',
        'cantidad_anterior',
        'cantidad'
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
        return StockManilla::class;
    }
}
