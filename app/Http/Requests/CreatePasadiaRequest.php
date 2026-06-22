<?php

namespace App\Http\Requests;

use App\Models\Pasadia;
use InfyOm\Generator\Request\APIRequest;

class CreatePasadiaRequest extends APIRequest
{
    public function rules()
    {
        return Pasadia::$rules;
    }
}