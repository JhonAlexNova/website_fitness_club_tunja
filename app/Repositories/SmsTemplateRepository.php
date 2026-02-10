<?php

namespace App\Repositories;

use App\Models\SmsTemplate;
use App\Repositories\BaseRepository;

/**
 * Class SmsTemplateRepository
 * @package App\Repositories
 * @version May 6, 2025, 8:56 am -05
*/

class SmsTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'content'
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
        return SmsTemplate::class;
    }
}
